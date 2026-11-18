<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/datos.php';

$pagina_actual      = 'servicios';
$titulo_pagina      = 'Servicios | ICAP Ingeniería';
$descripcion_pagina = 'Especialidades de ICAP Ingeniería: Diseño Mecánico, Manufactura, Eléctrico / Neumático y Control.';

require_once __DIR__ . '/includes/header.php';
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">NUESTRAS ESPECIALIDADES</p>
        <h1 id="page-title">Soluciones para cada<br><em>etapa del proceso.</em></h1>
        <p class="page-hero-lead">Cuatro áreas de trabajo conectadas por un mismo objetivo: desarrollar soluciones prácticas y precisas para la industria.</p>
        <nav class="subnav-pills" aria-label="Índice de especialidades">
          <?php foreach ($icap_servicios as $srv): ?>
            <a href="#<?= icap_esc($srv['id']) ?>"><?= icap_esc($srv['indice']) ?></a>
          <?php endforeach; ?>
        </nav>
      </div>
    </section>

    <?php foreach ($icap_servicios as $index => $srv):
      $es_par = ($index % 2 === 1);
      $es_control = ($srv['id'] === 'control');
    ?>
    <section class="section service-detail-section<?= $es_par ? ' is-alt' : '' ?>" id="<?= icap_esc($srv['id']) ?>" aria-labelledby="title-<?= icap_esc($srv['id']) ?>">
      <div class="shell service-detail-grid<?= $es_par ? ' is-reversed' : '' ?>">
        <div class="service-detail-copy">
          <span class="detail-badge"><?= icap_esc($srv['badge']) ?></span>
          <h2 id="title-<?= icap_esc($srv['id']) ?>"><?= icap_esc($srv['titulo']) ?></h2>
          <p><?= icap_esc($srv['descripcion']) ?></p>
          <ul class="service-specs">
            <?php foreach ($srv['especificaciones'] as $spec): ?>
              <li><?= icap_esc($spec) ?></li>
            <?php endforeach; ?>
          </ul>
          <a class="button button-orange button-sm" href="contacto.php?area=<?= icap_esc($srv['id']) ?>">Solicitar información <span aria-hidden="true">→</span></a>
        </div>
        <div class="service-detail-media">
          <img src="<?= icap_esc($srv['imagen']) ?>" width="1600" height="1200" loading="lazy" alt="<?= icap_esc($srv['alt']) ?>">
        </div>
      </div>

      <?php if ($es_control): ?>
      <div class="shell">
        <div class="capabilities-panel" aria-labelledby="capabilities-title">
          <div class="capabilities-intro">
            <div>
              <p class="eyebrow">CONTROL Y PROGRAMACIÓN</p>
              <h3 id="capabilities-title">Marcas que programamos e integramos</h3>
            </div>
          </div>
          <div class="capabilities-groups">
            <?php foreach ($icap_plataformas as $grupo): ?>
            <div class="capability-group">
              <h4><?= icap_esc($grupo['titulo']) ?></h4>
              <ul class="brand-tags">
                <?php foreach ($grupo['marcas'] as $nombre_marca): ?>
                  <li><?= icap_esc($nombre_marca) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </section>
    <?php endforeach; ?>

    <section class="cta-banner" aria-labelledby="cta-title">
      <div class="shell cta-banner-inner">
        <div>
          <p class="eyebrow">HABLEMOS DE TU PROYECTO</p>
          <h2 id="cta-title">El siguiente paso<br><em>empieza aquí.</em></h2>
          <p>Cuéntanos qué necesita tu operación. Estamos en El Marqués, Querétaro.</p>
        </div>
        <a class="button button-dark" href="contacto.php">Ir a Contacto <span aria-hidden="true">→</span></a>
      </div>
    </section>
<?php
require_once __DIR__ . '/includes/footer.php';
