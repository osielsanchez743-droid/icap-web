<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/datos.php';

$pagina_actual      = 'contacto';
$titulo_pagina      = 'Contacto | ICAP Ingeniería';
$descripcion_pagina = 'Contacto de ICAP Ingeniería en El Marqués y Pedro Escobedo, Querétaro.';

/* Preselección de área por parámetro ?area= */
$mapa_areas = [
    'mecanico'    => 'Diseño Mecánico',
    'manufactura' => 'Manufactura',
    'electrico'   => 'Eléctrico / Neumático',
    'control'     => 'Control'
];
$area_query = isset($_GET['area']) ? trim((string) $_GET['area']) : '';
$area_preseleccionada = $mapa_areas[$area_query] ?? 'Diseño Mecánico';

/* Procesamiento básico en servidor PHP */
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
    $mensaje  = trim((string) ($_POST['mensaje'] ?? ''));

    if ($honeypot !== '') {
        $estado_envio = 'error';
        $mensaje_estado = 'Solicitud bloqueada por el filtro antispam.';
    } elseif ($nombre === '' || $empresa === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL) || $mensaje === '') {
        $estado_envio = 'error';
        $mensaje_estado = 'Por favor completa los campos obligatorios con un correo electrónico válido.';
    } else {
        $asunto = rawurlencode("Consulta [{$area}] - {$empresa}");
        $cuerpo = rawurlencode(
            "Hola ICAP Ingeniería,\n\n" .
            "- Nombre: {$nombre}\n" .
            "- Empresa: {$empresa}\n" .
            "- Correo: {$correo}\n" .
            "- Teléfono: " . ($telefono !== '' ? $telefono : 'No especificado') . "\n" .
            "- Área: {$area}\n\n" .
            "Mensaje:\n{$mensaje}"
        );
        $enlace_mailto_generado = "mailto:{$icap_contacto['correo']}?subject={$asunto}&body={$cuerpo}";
        $estado_envio = 'ok';
        $mensaje_estado = "Datos listos para {$empresa}. Puedes abrir tu correo a continuación.";
    }
}

require_once __DIR__ . '/includes/header.php';
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">HABLEMOS DE TU PROYECTO</p>
        <h1 id="page-title">El siguiente paso<br><em>empieza aquí.</em></h1>
        <p class="page-hero-lead">Cuéntanos qué necesita tu operación. Estamos en El Marqués y Pedro Escobedo, Querétaro.</p>
      </div>
    </section>

    <section class="contact contact-page-section" aria-label="Canales de contacto y formulario">
      <div class="shell contact-grid">
        <div class="contact-info">
          <div class="contact-channels">
            <!-- Correo -->
            <div class="channel-card">
              <span class="channel-label">CORREO ELECTRÓNICO</span>
              <a class="channel-value" href="mailto:<?= icap_esc($icap_contacto['correo']) ?>?subject=Consulta%20-%20ICAP%20Ingenier%C3%ADa"><?= icap_esc($icap_contacto['correo']) ?></a>
              <div class="channel-actions">
                <a class="button button-gmail button-sm" href="<?= icap_esc($icap_contacto['gmail_compose']) ?>" target="_blank" rel="noopener noreferrer">Abrir en Gmail ↗</a>
                <a class="button button-outlook button-sm" href="<?= icap_esc($icap_contacto['outlook_compose']) ?>" target="_blank" rel="noopener noreferrer">Outlook Web ↗</a>
                <button type="button" class="button button-outline-light button-sm" id="copy-email-btn" data-email="<?= icap_esc($icap_contacto['correo']) ?>">Copiar correo</button>
                <span class="copy-feedback" id="copy-feedback" role="status" aria-live="polite"></span>
              </div>
            </div>

            <!-- Teléfono y WhatsApp -->
            <div class="channel-card">
              <span class="channel-label">TELÉFONO Y WHATSAPP</span>
              <a class="channel-value" href="tel:<?= icap_esc($icap_contacto['telefono_enlace']) ?>"><?= icap_esc($icap_contacto['telefono_visible']) ?></a>
              <div class="channel-actions">
                <a class="button button-wa button-sm" href="<?= icap_esc($icap_contacto['whatsapp_enlace']) ?>" target="_blank" rel="noopener noreferrer">WhatsApp ↗</a>
                <a class="button button-outline-light button-sm" href="tel:<?= icap_esc($icap_contacto['telefono_enlace']) ?>">Llamar ↗</a>
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
                <span>Ver en Google Maps ↗</span>
              </a>
            </div>
            <?php endforeach; ?>
          </div>

          <!-- Mapa -->
          <div class="map-viewer-card" aria-label="Mapa de ubicación de ICAP">
            <div class="map-viewer-header">
              <span class="map-viewer-title">UBICACIÓN EN QUERÉTARO</span>
              <div class="map-tabs" role="tablist" aria-label="Seleccionar ubicación en el mapa">
                <?php foreach ($icap_contacto['sedes'] as $idx_sede => $sede): ?>
                <button
                  type="button"
                  class="map-tab-btn<?= $idx_sede === 0 ? ' is-active' : '' ?>"
                  role="tab"
                  aria-selected="<?= $idx_sede === 0 ? 'true' : 'false' ?>"
                  data-embed="<?= icap_esc($sede['embed_url']) ?>"
                  data-coords="<?= icap_esc($sede['coordenadas']) ?>"
                  data-maps="<?= icap_esc($sede['maps_url']) ?>">
                  <?= $idx_sede === 0 ? 'El Marqués' : 'Pedro Escobedo' ?>
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
              <a id="icap-map-external" class="location-map-link" href="<?= icap_esc($icap_contacto['sedes'][0]['maps_url']) ?>" target="_blank" rel="noopener noreferrer">Abrir en Google Maps ↗</a>
            </div>
          </div>
        </div>

        <div class="contact-form-card">
          <h2>Envíanos un mensaje</h2>
          <p class="form-intro">Completa tus datos para ponernos en contacto contigo.</p>

          <?php if ($estado_envio !== null): ?>
            <div class="channel-card" role="alert" style="margin-bottom: 20px;">
              <span class="channel-label"><?= $estado_envio === 'ok' ? 'MENSAJE LISTO' : 'REVISAR CAMPOS' ?></span>
              <p class="channel-note" style="margin-bottom: 12px;"><?= icap_esc($mensaje_estado) ?></p>
              <?php if ($enlace_mailto_generado !== ''): ?>
                <a class="button button-orange button-sm" href="<?= icap_esc($enlace_mailto_generado) ?>">Abrir correo <span aria-hidden="true">↗</span></a>
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
                <label for="f-correo">Correo electrónico <span aria-hidden="true">*</span></label>
                <input type="email" id="f-correo" name="correo" required autocomplete="email" placeholder="correo@empresa.com">
              </div>
              <div class="form-field">
                <label for="f-telefono">Teléfono</label>
                <input type="tel" id="f-telefono" name="telefono" autocomplete="tel" placeholder="+52 442 000 0000">
              </div>
            </div>
            <div class="form-field">
              <label for="f-area">Área de interés <span aria-hidden="true">*</span></label>
              <select id="f-area" name="area" required>
                <?php
                $opciones_area = [
                    'Diseño Mecánico',
                    'Manufactura',
                    'Eléctrico / Neumático',
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
              <textarea id="f-mensaje" name="mensaje" rows="4" required placeholder="Cuéntanos sobre tu requerimiento..."></textarea>
            </div>
            <div class="form-actions">
              <button type="submit" class="button button-orange button-full" id="btn-submit-quote">
                <span>Enviar mensaje</span>
                <span aria-hidden="true">↗</span>
              </button>
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

    <!-- Dialog para seleccionar método de envío -->
    <dialog id="quote-send-dialog" class="send-options-dialog" aria-labelledby="dialog-quote-title">
      <h3 id="dialog-quote-title">Enviar mensaje</h3>
      <p>Elige cómo deseas enviar tu consulta a ICAP Ingeniería:</p>
      
      <div class="dialog-action-list">
        <a id="dialog-opt-wa" href="#" target="_blank" rel="noopener noreferrer" class="dialog-action-item dialog-action-item-wa">
          <span style="display:inline-flex;align-items:center;gap:10px;color:#25D366;">
            <strong>Enviar por WhatsApp (+52 446 213 6128)</strong>
          </span>
          <span aria-hidden="true">↗</span>
        </a>

        <a id="dialog-opt-gmail" href="#" target="_blank" rel="noopener noreferrer" class="dialog-action-item dialog-action-item-gmail">
          <span style="display:inline-flex;align-items:center;gap:10px;color:#ea4335;">
            <strong>Abrir en Gmail</strong>
          </span>
          <span aria-hidden="true">↗</span>
        </a>

        <a id="dialog-opt-outlook" href="#" target="_blank" rel="noopener noreferrer" class="dialog-action-item dialog-action-item-outlook">
          <span style="display:inline-flex;align-items:center;gap:10px;color:#0078d4;">
            <strong>Abrir en Outlook Web</strong>
          </span>
          <span aria-hidden="true">↗</span>
        </a>

        <a id="dialog-opt-mailto" href="#" class="dialog-action-item">
          <span>App de correo predeterminada</span>
          <span aria-hidden="true">↗</span>
        </a>
      </div>

      <button type="button" id="dialog-close-btn" class="button button-outline-light button-sm dialog-close-btn">Cerrar</button>
    </dialog>
<?php
require_once __DIR__ . '/includes/footer.php';
