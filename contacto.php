<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/datos.php';

$pagina_actual      = 'contacto';
$titulo_pagina      = 'Contacto | ICAP Ingeniería';
$descripcion_pagina = 'Contacta a ICAP Ingeniería en Querétaro para cotizaciones de diseño mecánico, manufactura CNC, sistemas eléctricos/neumáticos y automatización industrial.';

/* Preselección de área por parámetro ?area= */
$mapa_areas = [
    'mecanico'    => 'Diseño Mecánico / Estaciones de trabajo',
    'manufactura' => 'Manufactura / Maquinado CNC',
    'electrico'   => 'Sistemas Eléctricos y Neumáticos',
    'control'     => 'Control, PLC y Robótica'
];
$area_query = isset($_GET['area']) ? trim((string) $_GET['area']) : '';
$area_preseleccionada = $mapa_areas[$area_query] ?? 'Proyecto Integral (Llave en mano)';

/* Procesamiento básico en servidor PHP (con honeypot antispam y validación) */
$estado_envio = null;
$mensaje_estado = '';
$enlace_mailto_generado = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $honeypot = trim((string) ($_POST['sitio_web_empresa'] ?? ''));
    $nombre   = trim((string) ($_POST['nombre'] ?? ''));
    $empresa  = trim((string) ($_POST['empresa'] ?? ''));
    $correo   = trim((string) ($_POST['correo'] ?? ''));
    $telefono = trim((string) ($_POST['telefono'] ?? ''));
    $area     = trim((string) ($_POST['area'] ?? ''));
    $planos   = trim((string) ($_POST['planos'] ?? 'Cuento con planos / modelos 3D (.STEP, .DXF, .PDF)'));
    $mensaje  = trim((string) ($_POST['mensaje'] ?? ''));

    if ($honeypot !== '') {
        $estado_envio = 'error';
        $mensaje_estado = 'Solicitud bloqueada por el filtro antispam.';
    } elseif ($nombre === '' || $empresa === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL) || $mensaje === '') {
        $estado_envio = 'error';
        $mensaje_estado = 'Por favor completa todos los campos obligatorios con un correo electrónico válido.';
    } else {
        $asunto = rawurlencode("Solicitud técnica [{$area}] - {$empresa}");
        $cuerpo = rawurlencode(
            "Hola equipo de ICAP Ingeniería,\n\n" .
            "Comparto los datos de nuestro requerimiento técnico:\n" .
            "- Nombre: {$nombre}\n" .
            "- Empresa / Planta: {$empresa}\n" .
            "- Correo: {$correo}\n" .
            "- Teléfono: " . ($telefono !== '' ? $telefono : 'No especificado') . "\n" .
            "- Especialidad requerida: {$area}\n" .
            "- Documentación / Planos: {$planos}\n\n" .
            "Descripción del proyecto:\n{$mensaje}"
        );
        $enlace_mailto_generado = "mailto:{$icap_contacto['correo']}?subject={$asunto}&body={$cuerpo}";
        $estado_envio = 'ok';
        $mensaje_estado = "Datos validados para {$empresa}. Puedes abrir tu correo prellenado con un clic a continuación.";
    }
}

require_once __DIR__ . '/includes/header.php';
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">CONTACTO Y COTIZACIONES</p>
        <h1 id="page-title">El siguiente paso<br><em>empieza aquí.</em></h1>
        <p class="page-hero-lead">Cuéntanos los requerimientos técnicos de tu operación. Nuestro equipo en El Marqués y Pedro Escobedo, Querétaro, te atenderá directamente.</p>
      </div>
    </section>

    <section class="contact contact-page-section" aria-label="Canales de contacto y formulario">
      <div class="shell contact-grid">
        <div class="contact-info">
          <div class="contact-channels">
            <!-- Correo con redirección directa a Webmail (Gmail / Outlook) y Mailto -->
            <div class="channel-card">
              <span class="channel-label">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                CORREO ELECTRÓNICO DIRECTO
              </span>
              <a class="channel-value" href="mailto:<?= icap_esc($icap_contacto['correo']) ?>?subject=Consulta%20de%20proyecto%20-%20ICAP%20Ingenier%C3%ADa"><?= icap_esc($icap_contacto['correo']) ?></a>
              <div class="channel-actions">
                <a class="button button-gmail button-sm" href="<?= icap_esc($icap_contacto['gmail_compose']) ?>" target="_blank" rel="noopener noreferrer" title="Redactar en Gmail desde tu navegador">
                  <span>Abrir en Gmail</span>
                  <span aria-hidden="true">↗</span>
                </a>
                <a class="button button-outlook button-sm" href="<?= icap_esc($icap_contacto['outlook_compose']) ?>" target="_blank" rel="noopener noreferrer" title="Redactar en Outlook Web">
                  <span>Outlook Web</span>
                  <span aria-hidden="true">↗</span>
                </a>
                <a class="button button-outline-light button-sm" href="mailto:<?= icap_esc($icap_contacto['correo']) ?>?subject=Consulta%20de%20proyecto%20-%20ICAP%20Ingenier%C3%ADa" title="Abrir en cliente de correo del sistema">App de correo</a>
                <button type="button" class="button button-outline-light button-sm" id="copy-email-btn" data-email="<?= icap_esc($icap_contacto['correo']) ?>">Copiar dirección</button>
                <span class="copy-feedback" id="copy-feedback" role="status" aria-live="polite"></span>
              </div>
            </div>

            <!-- WhatsApp Directo -->
            <div class="channel-card channel-card-wa">
              <span class="channel-label channel-label-wa">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor" aria-hidden="true"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2zm.01 1.67c2.2 0 4.26.86 5.82 2.42a8.23 8.23 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.44 0-2.85-.38-4.09-1.11l-.29-.17-3.12.82.83-3.04-.19-.3A8.2 8.2 0 0 1 3.8 11.9c0-4.54 3.7-8.23 8.25-8.23zm4.52 11.63c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.25-.75-.67-1.26-1.5-1.4-1.75-.15-.25-.02-.39.11-.51.11-.11.25-.29.38-.44.12-.14.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.12.17 1.77 2.7 4.29 3.79.6.26 1.07.41 1.43.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.22-.19-.47-.31z"/></svg>
                MENSAJE DIRECTO POR WHATSAPP
              </span>
              <a class="channel-value" href="<?= icap_esc($icap_contacto['whatsapp_enlace']) ?>" target="_blank" rel="noopener noreferrer">
                <?= icap_esc($icap_contacto['telefono_visible']) ?>
              </a>
              <div class="channel-actions">
                <a class="button button-wa button-sm" href="<?= icap_esc($icap_contacto['whatsapp_enlace']) ?>" target="_blank" rel="noopener noreferrer">
                  <span>Mandar mensaje por WhatsApp</span>
                  <span aria-hidden="true">↗</span>
                </a>
              </div>
              <p class="channel-note" style="margin-top:10px;">Atención inmediata para requerimientos urgentes, visitas técnicas y cotizaciones en planta.</p>
            </div>

            <!-- Teléfono -->
            <div class="channel-card">
              <span class="channel-label">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                ATENCIÓN TELEFÓNICA DIRECTA
              </span>
              <a class="channel-value" href="tel:<?= icap_esc($icap_contacto['telefono_enlace']) ?>"><?= icap_esc($icap_contacto['telefono_visible']) ?></a>
              <div class="channel-actions">
                <a class="button button-outline-light button-sm" href="tel:<?= icap_esc($icap_contacto['telefono_enlace']) ?>">
                  <span>Llamar por teléfono</span>
                  <span aria-hidden="true">↗</span>
                </a>
              </div>
            </div>

            <!-- Canales y redes oficiales -->
            <div class="social-channels-card">
              <span class="channel-label">REDES Y ENLACES OFICIALES // ICAP MX</span>
              <div class="social-channels-grid">
                <a href="<?= icap_esc($icap_contacto['redes']['linkedin']['url']) ?>" target="_blank" rel="noopener noreferrer" class="social-chip social-chip-li">
                  <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                  <span>LinkedIn</span>
                </a>
                <a href="<?= icap_esc($icap_contacto['redes']['youtube']['url']) ?>" target="_blank" rel="noopener noreferrer" class="social-chip social-chip-yt">
                  <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M21.58 7.19a2.5 2.5 0 0 0-1.76-1.77C18.26 5 12 5 12 5s-6.26 0-7.82.42A2.5 2.5 0 0 0 2.42 7.2 26.24 26.24 0 0 0 2 12a26.24 26.24 0 0 0 .42 4.81 2.5 2.5 0 0 0 1.76 1.77C5.74 19 12 19 12 19s6.26 0 7.82-.42a2.5 2.5 0 0 0 1.76-1.77c.28-1.57.42-3.19.42-4.81 0-1.62-.14-3.24-.42-4.81zM10 15V9l5.2 3-5.2 3z"/></svg>
                  <span>YouTube</span>
                </a>
                <a href="<?= icap_esc($icap_contacto['redes']['facebook']['url']) ?>" target="_blank" rel="noopener noreferrer" class="social-chip social-chip-fb">
                  <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
                  <span>Facebook</span>
                </a>
                <a href="<?= icap_esc($icap_contacto['maps_principal']) ?>" target="_blank" rel="noopener noreferrer" class="social-chip social-chip-maps">
                  <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  <span>Google Maps</span>
                </a>
              </div>
            </div>
          </div>

          <div class="locations-grid" aria-label="Ubicaciones de ICAP Ingeniería">
            <?php foreach ($icap_contacto['sedes'] as $sede): ?>
            <div class="location-item">
              <div>
                <h3><?= icap_esc($sede['titulo_corto']) ?></h3>
                <address><?= icap_esc($sede['direccion']) ?></address>
              </div>
              <a class="location-map-link" href="<?= icap_esc($sede['maps_url']) ?>" target="_blank" rel="noopener noreferrer">
                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <span>Ver en Google Maps ↗</span>
              </a>
            </div>
            <?php endforeach; ?>
          </div>

          <!-- Visor Cartográfico Interactivo -->
          <div class="map-viewer-card" aria-label="Mapa interactivo de plantas ICAP">
            <div class="map-viewer-header">
              <span class="map-viewer-title">
                <span class="viewport-led" aria-hidden="true"></span>
                VISOR DE UBICACIÓN // PLANTAS QUERÉTARO
              </span>
              <div class="map-tabs" role="tablist" aria-label="Seleccionar sede en el mapa">
                <?php foreach ($icap_contacto['sedes'] as $idx_sede => $sede): ?>
                <button
                  type="button"
                  class="map-tab-btn<?= $idx_sede === 0 ? ' is-active' : '' ?>"
                  role="tab"
                  aria-selected="<?= $idx_sede === 0 ? 'true' : 'false' ?>"
                  data-embed="<?= icap_esc($sede['embed_url']) ?>"
                  data-coords="<?= icap_esc($sede['coordenadas']) ?>"
                  data-maps="<?= icap_esc($sede['maps_url']) ?>">
                  <?= $idx_sede === 0 ? 'Sede 01 // El Marqués' : 'Sede 02 // P. Escobedo' ?>
                </button>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="map-frame-wrap">
              <iframe
                id="icap-map-iframe"
                src="<?= icap_esc($icap_contacto['sedes'][0]['embed_url']) ?>"
                title="Mapa de ubicación de ICAP Ingeniería en Querétaro"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen>
              </iframe>
            </div>
            <div class="map-viewer-footer">
              <span id="icap-map-coords"><?= icap_esc($icap_contacto['sedes'][0]['coordenadas']) ?></span>
              <a id="icap-map-external" class="location-map-link" href="<?= icap_esc($icap_contacto['sedes'][0]['maps_url']) ?>" target="_blank" rel="noopener noreferrer">Abrir ruta en Google Maps ↗</a>
            </div>
          </div>
        </div>

        <div class="contact-form-card">
          <h2>Preparar solicitud técnica</h2>
          <p class="form-intro">Completa los datos de tu requerimiento para generar tu mensaje de cotización con toda la información técnica lista.</p>

          <?php if ($estado_envio !== null): ?>
            <div class="channel-card" role="alert" style="margin-bottom: 20px;">
              <span class="channel-label"><?= $estado_envio === 'ok' ? 'SOLICITUD LISTA' : 'REVISAR CAMPOS' ?></span>
              <p class="channel-note" style="margin-bottom: 12px;"><?= icap_esc($mensaje_estado) ?></p>
              <?php if ($enlace_mailto_generado !== ''): ?>
                <a class="button button-orange button-sm" href="<?= icap_esc($enlace_mailto_generado) ?>">Enviar en mi cliente de correo <span aria-hidden="true">↗</span></a>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <form id="project-form" class="project-form" method="post" action="contacto.php">
            <div style="position:absolute;left:-9999px;" aria-hidden="true">
              <label for="f-honeypot">No llenar este campo</label>
              <input type="text" id="f-honeypot" name="sitio_web_empresa" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-row">
              <div class="form-field">
                <label for="f-nombre">Nombre completo <span aria-hidden="true">*</span></label>
                <input type="text" id="f-nombre" name="nombre" required autocomplete="name" placeholder="Ing. Nombre Apellido">
              </div>
              <div class="form-field">
                <label for="f-empresa">Empresa / Planta <span aria-hidden="true">*</span></label>
                <input type="text" id="f-empresa" name="empresa" required autocomplete="organization" placeholder="Nombre de la empresa">
              </div>
            </div>
            <div class="form-row">
              <div class="form-field">
                <label for="f-correo">Correo corporativo <span aria-hidden="true">*</span></label>
                <input type="email" id="f-correo" name="correo" required autocomplete="email" placeholder="nombre@empresa.com">
              </div>
              <div class="form-field">
                <label for="f-telefono">Teléfono de contacto</label>
                <input type="tel" id="f-telefono" name="telefono" autocomplete="tel" placeholder="+52 442 000 0000">
              </div>
            </div>
            <div class="form-field">
              <label for="f-area">Especialidad principal requerida <span aria-hidden="true">*</span></label>
              <select id="f-area" name="area" required>
                <?php
                $opciones_area = [
                    'Proyecto Integral (Llave en mano)',
                    'Diseño Mecánico / Estaciones de trabajo',
                    'Manufactura / Maquinado CNC',
                    'Sistemas Eléctricos y Neumáticos',
                    'Control, PLC y Robótica'
                ];
                foreach ($opciones_area as $opcion):
                ?>
                  <option value="<?= icap_esc($opcion) ?>"<?= $area_preseleccionada === $opcion ? ' selected' : '' ?>><?= icap_esc($opcion) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-field">
              <label>Documentación técnica / planos disponibles <span aria-hidden="true">*</span></label>
              <div class="cad-docs-options" role="radiogroup" aria-label="Disponibilidad de planos técnicos">
                <label class="cad-doc-option">
                  <input type="radio" name="planos" value="Cuento con planos / modelos 3D (.STEP, .DXF, .PDF)" checked>
                  <span class="cad-doc-box">
                    <strong>CON PLANOS CAD / 2D</strong>
                    <span>Archivos .STEP, .DXF, .IGES o .PDF listos</span>
                  </span>
                </label>
                <label class="cad-doc-option">
                  <input type="radio" name="planos" value="Requiero levantamiento y diseño desde cero en planta">
                  <span class="cad-doc-box">
                    <strong>DISEÑO DESDE CERO</strong>
                    <span>Requiero levantamiento e ingeniería en planta</span>
                  </span>
                </label>
                <label class="cad-doc-option">
                  <input type="radio" name="planos" value="Tengo pieza muestra o equipo existente para mejora">
                  <span class="cad-doc-box">
                    <strong>PIEZA MUESTRA / MEJORA</strong>
                    <span>Ingeniería inversa, réplica o integración</span>
                  </span>
                </label>
              </div>
            </div>
            <div class="form-field">
              <label for="f-mensaje">Descripción del proyecto o requerimiento <span aria-hidden="true">*</span></label>
              <textarea id="f-mensaje" name="mensaje" rows="4" required placeholder="Describe brevemente el proceso, pieza, estación o alcance que necesitas cotizar..."></textarea>
            </div>
            <div class="form-actions">
              <button type="submit" class="button button-orange button-full" id="btn-submit-quote">
                <span>Enviar solicitud de cotización</span>
                <span aria-hidden="true">↗</span>
              </button>
            </div>
            <p class="form-legal">Podrás enviarlo directamente por <strong>WhatsApp</strong>, <strong>Gmail</strong>, <strong>Outlook</strong> o en tu cliente de correo a <strong><?= icap_esc($icap_contacto['correo']) ?></strong>.</p>
          </form>
        </div>
      </div>
    </section>

    <section class="section faq-section" id="faq" aria-labelledby="faq-title">
      <div class="shell">
        <div class="section-heading">
          <div>
            <p class="eyebrow">INFORMACIÓN PARA COTIZACIONES</p>
            <h2 id="faq-title">Preguntas frecuentes<br><span>antes de cotizar.</span></h2>
          </div>
          <p>Resolvemos las dudas habituales de los equipos de ingeniería, mantenimiento y compras industriales.</p>
        </div>

        <div class="faq-list">
          <?php foreach ($icap_faqs as $idx_faq => $faq): ?>
          <details class="faq-item"<?= $idx_faq === 0 ? ' open' : '' ?>>
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

    <!-- Dialog para seleccionar método de envío garantizado -->
    <dialog id="quote-send-dialog" class="send-options-dialog" aria-labelledby="dialog-quote-title">
      <h3 id="dialog-quote-title">Tu solicitud técnica está lista</h3>
      <p>Selecciona por qué canal deseas enviar tu requerimiento para asegurar que llegue de inmediato al equipo de ICAP:</p>
      
      <div class="dialog-action-list">
        <a id="dialog-opt-wa" href="#" target="_blank" rel="noopener noreferrer" class="dialog-action-item dialog-action-item-wa">
          <span style="display:inline-flex;align-items:center;gap:10px;color:#25D366;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2zm.01 1.67c2.2 0 4.26.86 5.82 2.42a8.23 8.23 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.44 0-2.85-.38-4.09-1.11l-.29-.17-3.12.82.83-3.04-.19-.3A8.2 8.2 0 0 1 3.8 11.9c0-4.54 3.7-8.23 8.25-8.23zm4.52 11.63c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.25-.75-.67-1.26-1.5-1.4-1.75-.15-.25-.02-.39.11-.51.11-.11.25-.29.38-.44.12-.14.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.12.17 1.77 2.7 4.29 3.79.6.26 1.07.41 1.43.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.22-.19-.47-.31z"/></svg>
            <strong>Enviar por WhatsApp (+52 446 213 6128)</strong>
          </span>
          <span aria-hidden="true">↗</span>
        </a>

        <a id="dialog-opt-gmail" href="#" target="_blank" rel="noopener noreferrer" class="dialog-action-item dialog-action-item-gmail">
          <span style="display:inline-flex;align-items:center;gap:10px;color:#ea4335;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
            <strong>Abrir en Gmail (Navegador)</strong>
          </span>
          <span aria-hidden="true">↗</span>
        </a>

        <a id="dialog-opt-outlook" href="#" target="_blank" rel="noopener noreferrer" class="dialog-action-item dialog-action-item-outlook">
          <span style="display:inline-flex;align-items:center;gap:10px;color:#0078d4;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
            <strong>Abrir en Outlook Web</strong>
          </span>
          <span aria-hidden="true">↗</span>
        </a>

        <a id="dialog-opt-mailto" href="#" class="dialog-action-item">
          <span style="display:inline-flex;align-items:center;gap:10px;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            <span>App de correo predeterminada (Mailto)</span>
          </span>
          <span aria-hidden="true">↗</span>
        </a>

        <button type="button" id="dialog-opt-copy" class="dialog-action-item" style="text-align:left;">
          <span style="display:inline-flex;align-items:center;gap:10px;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
            <span id="dialog-copy-label">Copiar texto completo de la solicitud</span>
          </span>
          <span aria-hidden="true">📋</span>
        </button>
      </div>

      <button type="button" id="dialog-close-btn" class="button button-outline-light button-sm dialog-close-btn">Cerrar ventana</button>
    </dialog>
<?php
require_once __DIR__ . '/includes/footer.php';
