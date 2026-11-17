#!/usr/bin/env python3
"""Analizador offline de capturas JSONL de MonitorOEE / haas-live-diagnostics.

Solo lee archivos .jsonl ya existentes. No importa módulos de red, no abre sockets,
no se conecta a Haas ni MySQL y escribe reportes solo en --salida.

Uso:
    py analizar_haas_mdc.py --carpeta "C:\\Users\\osiel\\AppData\\Local\\MonitorOEE\\haas-live-diagnostics\\sesiones"
    py analizar_haas_mdc.py --carpeta "...\\sesiones\\ID" --salida "C:\\Reportes\\Haas"
"""
from __future__ import annotations

import argparse
import collections
import datetime as dt
import json
import pathlib
import re
import sys
from typing import Any

MAX_EVENTS_DISPLAY = 70
MAX_VALUE_LEN = 250
SENSITIVE_RE = re.compile(r"(?i)(password|passwd|contraseñ|pwd|token|secret|credential|connectionstring|cadena.?conexion|api.?key|authorization)")
STATE_RE = re.compile(r"(?i)(?<![A-Z])(BUSY|IDLE|ALARM|UNKNOWN|DESCONOCIDO)(?![A-Z])")
STATUS_SPACE_RE = re.compile(r"(?i)(?:^|[>\s])STATUS\s+(BUSY|IDLE|ALARM)(?:\s|$)")
STATUS_COMMA_RE = re.compile(r"(?i)(?:^|[>\s])STATUS\s*,\s*(BUSY|IDLE|ALARM)(?:\s|$|,)")
PROGRAM_RE = re.compile(r"(?i)(?:^|[>\s])PROGRAM\s*,.*?,\s*(BUSY|IDLE)(?:\s*,|\s|$)")
LINE_RE = re.compile(r"(?i)(?:^|[>\s])(Q500|Q104|Q301|Q600|MACRO|MODE|PROGRAM|STATUS|PARTS)(?:\b|\s|,)")
CONNECTION_RE = re.compile(r"(?i)tcp[._ -]?(connect|disconnect|error|receive|send|read|write|close)|eof|timeout|socket|reconnect|connection|conexion|conexi[oó]n")
TIME_HINTS = ("utc", "timestamp", "fecha", "time", "hora", "occurred", "when", "instante")
RAW_HINTS = ("raw", "response", "respuesta", "line", "linea", "payload", "recib", "received", "data", "texto", "content", "message", "mensaje")
EVENT_HINTS = ("event", "evento", "type", "tipo", "category", "categoria", "kind", "name", "nombre")
CONN_HINTS = ("connection", "conexion", "conn", "socket", "generation", "generacion")


def shorten(value: Any, n: int = MAX_VALUE_LEN) -> str:
    text = str(value).replace("\r", "\\r").replace("\n", "\\n")
    return text if len(text) <= n else text[: n - 1] + "…"


def flatten(value: Any, prefix: str = "", depth: int = 0):
    if depth > 6:
        return
    if isinstance(value, dict):
        for k, v in value.items():
            key = f"{prefix}.{k}" if prefix else str(k)
            if SENSITIVE_RE.search(str(k)):
                continue
            yield from flatten(v, key, depth + 1)
    elif isinstance(value, list):
        for i, v in enumerate(value[:12]):
            yield from flatten(v, f"{prefix}[{i}]", depth + 1)
    elif value is not None:
        yield prefix, value


def preferred(pairs, hints, require_text=True):
    options = []
    for key, val in pairs:
        if require_text and not isinstance(val, (str, int, float)):
            continue
        leaf = re.sub(r"\[\d+\]", "", key).lower().split(".")[-1]
        for idx, hint in enumerate(hints):
            if leaf == hint:
                options.append((idx, len(key), key, val))
                break
            if hint in leaf:
                options.append((len(hints) + idx, len(key), key, val))
                break
    if not options:
        return None
    options.sort()
    return options[0][3]


def parse_timestamp(value):
    if not isinstance(value, (str, int, float)):
        return None
    if isinstance(value, (int, float)):
        if 1_000_000_000 < value < 100_000_000_000:
            try:
                return dt.datetime.fromtimestamp(value, dt.timezone.utc)
            except (OverflowError, ValueError, OSError):
                return None
        return None
    s = value.strip()
    if not s:
        return None
    try:
        parsed = dt.datetime.fromisoformat(s.replace("Z", "+00:00"))
        if parsed.tzinfo is None:
            parsed = parsed.replace(tzinfo=dt.timezone.utc)
        return parsed.astimezone(dt.timezone.utc)
    except ValueError:
        return None


def read_events(folder, limit):
    files = sorted(folder.rglob("*.jsonl")) if folder.is_dir() else ([folder] if folder.suffix.lower() == ".jsonl" else [])
    events, errors = [], []
    count = 0
    for file in files:
        try:
            with file.open("r", encoding="utf-8-sig", errors="replace") as stream:
                for number, raw in enumerate(stream, 1):
                    if not raw.strip():
                        continue
                    count += 1
                    if count > limit:
                        errors.append(f"Límite de {limit:,} eventos alcanzado; análisis truncado")
                        return files, events, errors
                    try:
                        parsed = json.loads(raw)
                        if not isinstance(parsed, dict):
                            errors.append(f"{file.name}:{number}: evento JSON no es objeto")
                            continue
                        pairs = list(flatten(parsed))
                        stamp = None
                        for k, v in pairs:
                            leaf = k.lower().split(".")[-1]
                            if any(h in leaf for h in TIME_HINTS):
                                stamp = parse_timestamp(v)
                                if stamp:
                                    break
                        typ = preferred(pairs, EVENT_HINTS)
                        rawlines = []
                        for k, v in pairs:
                            leaf = k.lower().split(".")[-1]
                            if isinstance(v, str) and any(h in leaf for h in RAW_HINTS) and not SENSITIVE_RE.search(k):
                                if re.search(r"(?i)\b(Q500|Q104|Q301|Q600|MACRO|MODE|PROGRAM|STATUS|BUSY|IDLE|ALARM|\?A|\?Q3025)\b", v) or v.startswith(">"):
                                    rawlines.append(v)
                        connection = preferred(pairs, CONN_HINTS)
                        # Reduce strings: only fields matching event, protocol or error topics.
                        searchable = " ".join(str(v)[:500] for k, v in pairs if isinstance(v, str) and (re.search(r"(?i)event|tipo|message|mensaje|error|incident|incidencia|reason|razon|command|comando|state|estado|response|respuesta|raw|payload|line|texto", k)))
                        events.append({"ts": stamp, "type": shorten(typ, 70) if typ is not None else "SIN_TIPO", "raw": rawlines[:4], "conn": shorten(connection, 60) if connection is not None else "", "text": searchable[:1800], "source": file.name, "line": number})
                    except json.JSONDecodeError as exc:
                        errors.append(f"{file.name}:{number}: JSON inválido ({exc.msg})")
        except (PermissionError, OSError) as exc:
            errors.append(f"No se pudo leer {file}: {type(exc).__name__}: {exc}")
    return files, events, errors


def detect(events, silence_threshold):
    types = collections.Counter()
    protocol = collections.Counter()
    state = collections.Counter()
    issues = collections.Counter()
    timeline = []
    last_valid = None
    gaps = []
    timestamps = [e["ts"] for e in events if e["ts"]]
    for e in events:
        types[e["type"]] += 1
        fields = [x.strip() for x in e["raw"]]
        txt = e["text"]
        proto = None
        for line in fields:
            if ">?" in line or re.search(r"(?i)(?:^|\s)\?,\s*\?(?:A|Q\d+)", line):
                protocol["RECHAZO / respuesta no reconocida"] += 1
                proto = "rechazo"
            if PROGRAM_RE.search(line):
                protocol["PROGRAM con BUSY/IDLE"] += 1
                proto = "operativo-program"
            elif STATUS_COMMA_RE.search(line):
                protocol["STATUS, BUSY/IDLE/ALARM"] += 1
                proto = "operativo-status"
            elif STATUS_SPACE_RE.search(line):
                protocol["STATUS BUSY/IDLE/ALARM sin coma (ambiguo)"] += 1
                proto = "status-sin-coma"
            elif re.search(r"(?i)\b(MACRO|MODE|C\.S\. TIME)\b", line):
                protocol["Auxiliar MACRO/MODE/tiempo"] += 1
            elif LINE_RE.search(line):
                protocol["Otros mensajes MDC"] += 1
        if proto in ("operativo-program", "operativo-status"):
            candidates = [PROGRAM_RE.search(x) or STATUS_COMMA_RE.search(x) for x in fields]
            candidates = [x for x in candidates if x]
            if candidates:
                st = candidates[-1].group(1).upper()
                state[st] += 1
                if e["ts"]:
                    last_valid = e["ts"]
        if proto == "status-sin-coma":
            issues["STATUS sin coma: interpretación no confirmada"] += 1
        if re.search(r"(?i)NO_VALID_STATE_OBSERVED", txt + " " + e["type"]):
            issues["Sin estado operativo válido"] += 1
        if re.search(r"(?i)UNVALIDATED_STATE", txt + " " + e["type"]):
            issues["Respuesta inválida clasificada como estado"] += 1
        if re.search(r"(?i)tcp\.error|exception|timeout|connection.*(lost|closed)|eof", txt + " " + e["type"]):
            issues["Evento de error/cierre/silencio TCP"] += 1
        if e["ts"] and last_valid and (e["ts"] - last_valid).total_seconds() >= silence_threshold:
            gaps.append((last_valid, e["ts"], (e["ts"] - last_valid).total_seconds()))
            last_valid = None  # one gap per observed-valid interval
        if (proto or CONNECTION_RE.search(txt + " " + e["type"]) or "NO_VALID_STATE_OBSERVED" in txt) and len(timeline) < 10000:
            timeline.append({"time": e["ts"].isoformat() if e["ts"] else "sin fecha", "event": e["type"], "protocol": proto or "", "raw": [shorten(x, 180) for x in fields[:2]], "details": shorten(txt, 220), "source": f"{e['source']}:{e['line']}"})
    # Choose representative points spread across timeline, rather than first-only
    if len(timeline) > MAX_EVENTS_DISPLAY:
        every = (len(timeline) - 1) / (MAX_EVENTS_DISPLAY - 1)
        timeline = [timeline[round(i * every)] for i in range(MAX_EVENTS_DISPLAY)]
    return {"events": len(events), "types": dict(types.most_common(25)), "protocol": dict(protocol.most_common()), "confirmed_operational_formats": dict(state), "issues": dict(issues.most_common()), "observed_time_range": {"start": min(timestamps).isoformat() if timestamps else None, "end": max(timestamps).isoformat() if timestamps else None}, "gaps_after_known_valid_state": [{"last_valid": a.isoformat(), "next_event": b.isoformat(), "seconds": c} for a,b,c in gaps[:30]], "timeline_sample": timeline}


def report_text(folder, files, result, errors, threshold):
    lines = ["DIAGNÓSTICO OFFLINE DE HAAS-LIVE-DIAGNOSTICS", "=" * 55, f"Origen: {folder}", f"Archivos JSONL: {len(files)}", f"Eventos analizados: {result['events']}", f"Periodo UTC: {result['observed_time_range']['start']} → {result['observed_time_range']['end']}", "", "TIPOS DE EVENTO"]
    lines += [f"  {k}: {v}" for k,v in result["types"].items()] or ["  No identificados"]
    lines += ["", "RESPUESTAS DEL PROTOCOLO OBSERVADAS"]
    lines += [f"  {k}: {v}" for k,v in result["protocol"].items()] or ["  No se pudieron extraer líneas MDC de los campos JSONL"]
    lines += ["", "ESTADOS EXTRAÍDOS DE FORMATOS RECONOCIBLES (NO EQUIVALEN A SEGMENTOS CONFIRMADOS)"]
    lines += [f"  {k}: {v}" for k,v in result["confirmed_operational_formats"].items()] or ["  Ninguno detectado"]
    lines += ["", "ANOMALÍAS (indicadores de eventos, no diagnósticos de causa)"]
    lines += [f"  {k}: {v}" for k,v in result["issues"].items()] or ["  Ninguna encontrada mediante heurísticas"]
    lines += ["", f"HUECOS ≥ {threshold:g} SEGUNDOS DESPUÉS DE ESTADO VÁLIDO (heurística)"]
    lines += [f"  {x['last_valid']} → {x['next_event']}: {x['seconds']:.1f} s" for x in result["gaps_after_known_valid_state"]] or ["  Ninguno detectado"]
    lines += ["", "MUESTRA CRONOLÓGICA"]
    for e in result["timeline_sample"]:
        lines.append(f"  {e['time']} | {e['event']} | {e['protocol']} | {e['source']}")
        if e["raw"]: lines.append("    MDC: " + " || ".join(e["raw"]))
        if e["details"]: lines.append("    Info: " + e["details"])
    if errors:
        lines += ["", "ADVERTENCIAS DE LECTURA"] + ["  " + e for e in errors[:80]]
    lines += ["", "LIMITACIONES", "- El JSONL debe incluir campos con líneas MDC para analizar el protocolo.", "- Los nombres de campos se detectan por heurísticas: inspeccionar si los resultados aparecen vacíos.", "- STATUS BUSY sin coma no se convierte en estado operativo válido.", "- Los gaps en JSONL no prueban desconexión del socket; son indicios temporales.", "- No se consulta la CNC, no se escriben datos en MySQL ni se cambia MonitorOEE.", "- No se pueden demostrar errores de red ni causas únicas sin observar el contexto de la aplicación."]
    return "\n".join(lines) + "\n"


def main():
    p = argparse.ArgumentParser(description="Diagnóstico offline de archivos JSONL de MonitorOEE (sin red ni MySQL)")
    p.add_argument("--carpeta", required=True, type=pathlib.Path, help="Carpeta de sesiones, una sesión, o archivo JSONL")
    p.add_argument("--salida", type=pathlib.Path, default=None, help="Carpeta para informes. Por defecto, ./reporte-haas-mcd")
    p.add_argument("--silencio", type=float, default=30.0, help="Umbral temporal orientativo en segundos (por defecto: 30)")
    p.add_argument("--max-eventos", type=int, default=500000, help="Máximo de eventos a procesar")
    args = p.parse_args()
    folder = args.carpeta.expanduser()
    if not folder.exists():
        p.error(f"No existe la ruta: {folder}")
    if args.silencio <= 0 or args.max_eventos < 1:
        p.error("--silencio debe ser > 0 y --max-eventos >= 1")
    files, events, errors = read_events(folder, args.max_eventos)
    if not files:
        print("No se encontraron archivos .jsonl en la ruta indicada.", file=sys.stderr)
        return 2
    result = detect(events, args.silencio)
    result.update({"origin": str(folder), "jsonl_files": len(files), "read_warnings": errors[:80], "offline_only": True})
    output = args.salida or (pathlib.Path.cwd() / "reporte-haas-mdc")
    output.mkdir(parents=True, exist_ok=True)
    jsonfile = output / "diagnostico_haas.json"
    txtfile = output / "diagnostico_haas.txt"
    jsonfile.write_text(json.dumps(result, indent=2, ensure_ascii=False), encoding="utf-8")
    txtfile.write_text(report_text(folder, files, result, errors, args.silencio), encoding="utf-8")
    print(f"Archivos JSONL: {len(files)} | Eventos: {len(events)} | Advertencias: {len(errors)}")
    print(f"Reporte TXT: {txtfile.resolve()}")
    print(f"Reporte JSON: {jsonfile.resolve()}")
    return 0


if __name__ == "__main__":
    sys.exit(main())
