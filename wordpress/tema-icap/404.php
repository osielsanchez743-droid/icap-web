<?php
declare(strict_types=1);
global $icap_contacto, $icap_sectores, $icap_servicios, $icap_proceso, $icap_plataformas, $icap_filosofia, $icap_galeria, $icap_faqs;

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
}

$pagina_actual      = '404';
$titulo_pagina      = 'Ruta no encontrada (404) | ICAP Ingeniería';
$descripcion_pagina = 'La página solicitada no existe o cambió de ubicación. Explora las especialidades de automatización e ingeniería industrial de ICAP.';

get_header();
?>
    <section class="section" aria-labelledby="error-title">
      <div class="shell">
        <div class="error-404-panel">
          <span class="error-404-code">
            <span class="viewport-led" aria-hidden="true"></span>
            ESTADO DEL SISTEMA // CÓDIGO 404
          </span>
          <h1 id="error-title" style="max-width: 18ch; margin-bottom: 14px;">Ruta no encontrada<br><em>en el directorio.</em></h1>
          <p class="hero-lead" style="max-width: 60ch;">El enlace al que intentaste acceder no existe o pertenece a la versión anterior del sitio. Selecciona una de las secciones activas de <strong>ICAP Ingeniería</strong> para continuar:</p>

          <div class="hero-actions" style="margin-bottom: 24px;">
            <a class="button button-orange" href="<?= esc_url(home_url('/')) ?>">
              <span>Volver al Inicio</span>
              <span aria-hidden="true">→</span>
            </a>
            <a class="button button-wa" href="<?= icap_esc($icap_contacto['whatsapp_enlace']) ?>" target="_blank" rel="noopener noreferrer">
              <span>Contactar por WhatsApp</span>
              <span aria-hidden="true">↗</span>
            </a>
          </div>

          <div class="error-404-grid" aria-label="Accesos directos a especialidades">
            <?php foreach ($icap_servicios as $srv): ?>
            <article class="location-item">
              <div>
                <h3><?= icap_esc($srv['codigo']) ?></h3>
                <strong style="display:block; font-size:16px; margin-bottom:6px;"><?= icap_esc($srv['titulo']) ?></strong>
                <p class="channel-note"><?= icap_esc($srv['resumen']) ?></p>
              </div>
              <a class="location-map-link" href="<?= esc_url(home_url('/servicios/')) ?>#<?= icap_esc($srv['id']) ?>">
                <span>Ir a <?= icap_esc($srv['titulo']) ?> →</span>
              </a>
            </article>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
<?php
get_footer();
