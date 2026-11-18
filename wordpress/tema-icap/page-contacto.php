<?php
declare(strict_types=1);
global $icap_contacto, $icap_sectores, $icap_servicios, $icap_plataformas, $icap_filosofia, $icap_galeria, $icap_faqs;

$pagina_actual      = 'contacto';
$titulo_pagina      = 'Contacto | ICAP IngenierÃ­a';
$descripcion_pagina = 'Contacto de ICAP IngenierÃ­a en El MarquÃ©s y Pedro Escobedo, QuerÃ©taro.';

/* PreselecciÃ³n de Ã¡rea por parÃ¡metro ?area= */
$mapa_areas = [
    'mecanico'    => 'DiseÃ±o MecÃ¡nico',
    'manufactura' => 'Manufactura',
    'electrico'   => 'ElÃ©ctrico / NeumÃ¡tico',
    'control'     => 'Control'
];
$area_query = isset($_GET['area']) ? trim((string) $_GET['area']) : '';
$area_preseleccionada = $mapa_areas[$area_query] ?? 'DiseÃ±o MecÃ¡nico';

/* Procesamiento bÃ¡sico en servidor PHP */
$estado_envio = null;
$mensaje_estado = '';
$enlace_mailto_generado = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $honeypot = trim((string) ($_POST['icap_hp_field'] ?? ''));
    $form_ts  = (int) ($_POST['form_ts'] ?? 0);
    $nombre   = trim((string) ($_POST['nombre'] ?? ''));
    $empresa  = trim((string) ($_POST['empresa'] ?? ''));
    $correo   = trim((string) ($_POST['correo'] ?? ''));
    $telefono = trim((string) ($_POST['telefono'] ?? ''));
    $area     = trim((string) ($_POST['area'] ?? ''));
    $mensaje  = trim((string) ($_POST['mensaje'] ?? ''));

    $elapsed_sec = $form_ts > 0 ? (time() - $form_ts) : 99;
    $url_count   = preg_match_all('/https?:\/\/|www\./i', $mensaje);

    if ($honeypot !== '' || $elapsed_sec < 1 || $url_count > 1) {
        $estado_envio = 'error';
        $mensaje_estado = 'Solicitud bloqueada por el filtro antispam.';
    } elseif ($nombre === '' || $empresa === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL) || $mensaje === '') {
        $estado_envio = 'error';
        $mensaje_estado = 'Por favor completa los campos obligatorios con un correo electrÃ³nico vÃ¡lido.';
    } else {
        $asunto = rawurlencode("Consulta [{$area}] - {$empresa}");
        $cuerpo = rawurlencode(
            "Hola ICAP IngenierÃ­a,\n\n" .
            "- Nombre: {$nombre}\n" .
            "- Empresa: {$empresa}\n" .
            "- Correo: {$correo}\n" .
            "- TelÃ©fono: " . ($telefono !== '' ? $telefono : 'No especificado') . "\n" .
            "- Ãrea: {$area}\n\n" .
            "Mensaje:\n{$mensaje}"
        );
        $enlace_mailto_generado = "mailto:{$icap_contacto['correo']}?subject={$asunto}&body={$cuerpo}";
        $estado_envio = 'ok';
        $mensaje_estado = "Datos listos para {$empresa}. Puedes abrir tu correo a continuaciÃ³n.";
    }
}

get_header();
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">HABLEMOS DE TU PROYECTO</p>
        <h1 id="page-title">El siguiente paso<br><em>empieza aquÃ­.</em></h1>
        <p class="page-hero-lead">CuÃ©ntanos quÃ© necesita tu operaciÃ³n. Estamos en El MarquÃ©s y Pedro Escobedo, QuerÃ©taro.</p>
      </div>
    </section>

    <section class="contact contact-page-section" aria-label="Canales de contacto y formulario">
      <div class="shell contact-grid">
        <div class="contact-info">
          <div class="contact-channels">
            <!-- Correo protegido contra bots recolectores -->
            <div class="channel-card">
              <span class="channel-label">CORREO ELECTRÃ“NICO</span>
              <a class="channel-value js-protected-email" href="#contacto-correo" data-antispam="mailto">julio.dejesus [en] icapmx.com</a>
              <div class="channel-actions">
                <a class="button button-gmail button-sm" href="#contacto-gmail" data-antispam="gmail" target="_blank" rel="noopener noreferrer">Abrir en Gmail â†—</a>
                <a class="button button-outlook button-sm" href="#contacto-outlook" data-antispam="outlook" target="_blank" rel="noopener noreferrer">Outlook Web â†—</a>
                <button type="button" class="button button-outline-light button-sm" id="copy-email-btn">Copiar correo</button>
                <span class="copy-feedback" id="copy-feedback" role="status" aria-live="polite"></span>
              </div>
            </div>

            <!-- TelÃ©fono y WhatsApp protegidos contra bots recolectores -->
            <div class="channel-card">
              <span class="channel-label">TELÃ‰FONO Y WHATSAPP</span>
              <a class="channel-value" href="#contacto-tel" data-antispam="tel"><?= icap_esc($icap_contacto['telefono_visible']) ?></a>
              <div class="channel-actions">
                <a class="button button-wa button-sm" href="#contacto-wa" data-antispam="wa" target="_blank" rel="noopener noreferrer">WhatsApp â†—</a>
                <a class="button button-outline-light button-sm" href="#contacto-tel" data-antispam="tel">Llamar â†—</a>
              </div>
            </div>
          </div>

          <div class="locations-grid" aria-label="Ubicaciones de ICAP IngenierÃ­a">
            <?php foreach ($icap_contacto['sedes'] as $sede): ?>
            <div class="location-item">
              <div>
                <h3><?= icap_esc($sede['titulo_corto']) ?></h3>
                <address><?= icap_esc($sede['direccion']) ?></address>
              </div>
              <a class="location-map-link" href="<?= icap_esc($sede['maps_url']) ?>" target="_blank" rel="noopener noreferrer">
                <span>Ver en Google Maps â†—</span>
              </a>
            </div>
            <?php endforeach; ?>
          </div>

          <!-- Mapa -->
          <div class="map-viewer-card" aria-label="Mapa de ubicaciÃ³n de ICAP">
            <div class="map-viewer-header">
              <span class="map-viewer-title">UBICACIÃ“N EN QUERÃ‰TARO</span>
              <div class="map-tabs" role="tablist" aria-label="Seleccionar ubicaciÃ³n en el mapa">
                <?php foreach ($icap_contacto['sedes'] as $idx_sede => $sede): ?>
                <button
                  type="button"
                  class="map-tab-btn<?= $idx_sede === 0 ? ' is-active' : '' ?>"
                  role="tab"
                  aria-selected="<?= $idx_sede === 0 ? 'true' : 'false' ?>"
                  data-embed="<?= icap_esc($sede['embed_url']) ?>"
                  data-coords="<?= icap_esc($sede['coordenadas']) ?>"
                  data-maps="<?= icap_esc($sede['maps_url']) ?>">
                  <?= $idx_sede === 0 ? 'El MarquÃ©s' : 'Pedro Escobedo' ?>
                </button>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="map-frame-wrap">
              <iframe
                id="icap-map-iframe"
                src="<?= icap_esc($icap_contacto['sedes'][0]['embed_url']) ?>"
                title="Mapa de ubicaciÃ³n de ICAP IngenierÃ­a en QuerÃ©taro"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen>
              </iframe>
            </div>
            <div class="map-viewer-footer">
              <span id="icap-map-coords"><?= icap_esc($icap_contacto['sedes'][0]['coordenadas']) ?></span>
              <a id="icap-map-external" class="location-map-link" href="<?= icap_esc($icap_contacto['sedes'][0]['maps_url']) ?>" target="_blank" rel="noopener noreferrer">Abrir en Google Maps â†—</a>
            </div>
          </div>
        </div>

        <div class="contact-form-card">
          <h2>EnvÃ­anos un mensaje</h2>
          <p class="form-intro">Completa tus datos para ponernos en contacto contigo.</p>

          <?php if ($estado_envio !== null): ?>
            <div class="channel-card" role="alert" style="margin-bottom: 20px;">
              <span class="channel-label"><?= $estado_envio === 'ok' ? 'MENSAJE LISTO' : 'REVISAR CAMPOS' ?></span>
              <p class="channel-note" style="margin-bottom: 12px;"><?= icap_esc($mensaje_estado) ?></p>
              <?php if ($enlace_mailto_generado !== ''): ?>
                <a class="button button-orange button-sm" href="<?= icap_esc($enlace_mailto_generado) ?>">Abrir correo <span aria-hidden="true">â†—</span></a>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <form id="project-form" class="project-form" method="post" action="<?= esc_url(home_url('/contacto/')) ?>">
            <div style="position:absolute;left:-9999px;width:0;height:0;overflow:hidden;opacity:0;pointer-events:none;" aria-hidden="true">
              <label for="f-honeypot">Dejar vacÃ­o</label>
              <input type="text" id="f-honeypot" name="icap_hp_field" tabindex="-1" autocomplete="new-password" data-lpignore="true">
              <input type="hidden" id="f-timestamp" name="form_ts" value="<?= time() ?>">
            </div>

            <div class="form-row">
              <div class="form-field">
                <label for="f-nombre">Nombre <span aria-hidden="true">*</span></label>
                <input type="text" id="f-nombre" name="nombre" required autocomplete="name" placeholder="Tu nombre">
              </div>
              <div class="form-field">
                <label for="f-empresa">Empresa <span aria-hidden="true">*</span></label>
                <input type="text" id="f-empresa" name="empresa" required autocomplete="organization" placeholder="Nombre de la empresa">
              </div>
            </div>
            <div class="form-row">
              <div class="form-field">
                <label for="f-correo">Correo electrÃ³nico <span aria-hidden="true">*</span></label>
                <input type="email" id="f-correo" name="correo" required autocomplete="email" placeholder="correo@empresa.com">
              </div>
              <div class="form-field">
                <label for="f-telefono">TelÃ©fono</label>
                <input type="tel" id="f-telefono" name="telefono" autocomplete="tel" placeholder="+52 442 000 0000">
              </div>
            </div>
            <div class="form-field">
              <label for="f-area">Ãrea de interÃ©s <span aria-hidden="true">*</span></label>
              <select id="f-area" name="area" required>
                <?php
                $opciones_area = [
                    'DiseÃ±o MecÃ¡nico',
                    'Manufactura',
                    'ElÃ©ctrico / NeumÃ¡tico',
                    'Control'
                ];
                foreach ($opciones_area as $opcion):
                ?>
                  <option value="<?= icap_esc($opcion) ?>"<?= $area_preseleccionada === $opcion ? ' selected' : '' ?>><?= icap_esc($opcion) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-field">
              <label for="f-mensaje">Mensaje <span aria-hidden="true">*</span></label>
              <textarea id="f-mensaje" name="mensaje" rows="4" required placeholder="CuÃ©ntanos sobre tu requerimiento..."></textarea>
            </div>
            <div class="form-actions">
              <button type="submit" class="button button-orange button-full" id="btn-submit-quote">
                <span>Enviar mensaje</span>
                <span aria-hidden="true">â†—</span>
              </button>
              <p id="form-spam-feedback" class="copy-feedback" role="status" aria-live="polite" style="margin-top:8px;"></p>
            </div>
          </form>
        </div>
      </div>
    </section>

    <section class="section faq-section" id="faq" aria-labelledby="faq-title">
      <div class="shell">
        <div class="section-heading">
          <div>
            <p class="eyebrow">DUDAS FRECUENTES</p>
            <h2 id="faq-title">Preguntas<br><span>frecuentes.</span></h2>
          </div>
        </div>

        <div class="faq-list">
          <?php foreach ($icap_faqs as $faq): ?>
          <details class="faq-item">
            <summary class="faq-summary">
              <span class="faq-summary-left">
                <span class="faq-code"><?= icap_esc($faq['codigo']) ?></span>
                <span class="faq-question"><?= icap_esc($faq['pregunta']) ?></span>
              </span>
              <span class="faq-indicator" aria-hidden="true">+</span>
            </summary>
            <div class="faq-answer">
              <?= icap_esc($faq['respuesta']) ?>
            </div>
          </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Dialog para seleccionar mÃ©todo de envÃ­o -->
    <dialog id="quote-send-dialog" class="send-options-dialog" aria-labelledby="dialog-quote-title">
      <h3 id="dialog-quote-title">Enviar mensaje</h3>
      <p>Elige cÃ³mo deseas enviar tu consulta a ICAP IngenierÃ­a:</p>
      
      <div class="dialog-action-list">
        <a id="dialog-opt-wa" href="#" target="_blank" rel="noopener noreferrer" class="dialog-action-item dialog-action-item-wa">
          <span style="display:inline-flex;align-items:center;gap:10px;color:#25D366;">
            <strong>Enviar por WhatsApp (+52 446 213 6128)</strong>
          </span>
          <span aria-hidden="true">â†—</span>
        </a>

        <a id="dialog-opt-gmail" href="#" target="_blank" rel="noopener noreferrer" class="dialog-action-item dialog-action-item-gmail">
          <span style="display:inline-flex;align-items:center;gap:10px;color:#ea4335;">
            <strong>Abrir en Gmail</strong>
          </span>
          <span aria-hidden="true">â†—</span>
        </a>

        <a id="dialog-opt-outlook" href="#" target="_blank" rel="noopener noreferrer" class="dialog-action-item dialog-action-item-outlook">
          <span style="display:inline-flex;align-items:center;gap:10px;color:#0078d4;">
            <strong>Abrir en Outlook Web</strong>
          </span>
          <span aria-hidden="true">â†—</span>
        </a>

        <a id="dialog-opt-mailto" href="#" class="dialog-action-item">
          <span>App de correo predeterminada</span>
          <span aria-hidden="true">â†—</span>
        </a>
      </div>

      <button type="button" id="dialog-close-btn" class="button button-outline-light button-sm dialog-close-btn">Cerrar</button>
    </dialog>
<?php
get_footer();
