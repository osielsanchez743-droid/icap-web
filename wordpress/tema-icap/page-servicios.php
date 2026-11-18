<?php
declare(strict_types=1);
global $icap_contacto, $icap_sectores, $icap_servicios, $icap_plataformas, $icap_filosofia, $icap_galeria;

$pagina_actual      = 'servicios';
$titulo_pagina      = 'Servicios | ICAP IngenierÃ­a';
$descripcion_pagina = 'Especialidades de ICAP IngenierÃ­a: DiseÃ±o MecÃ¡nico, Manufactura, ElÃ©ctrico / NeumÃ¡tico y Control.';

get_header();
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">NUESTRAS ESPECIALIDADES</p>
        <h1 id="page-title">Soluciones para cada<br><em>etapa del proceso.</em></h1>
        <p class="page-hero-lead">Cuatro Ã¡reas de trabajo conectadas por un mismo objetivo: desarrollar soluciones prÃ¡cticas y precisas para la industria.</p>
        <nav class="subnav-pills" aria-label="Ãndice de especialidades">
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
          <a class="button button-orange button-sm" href="<?= esc_url(home_url('/contacto/')) ?>?area=<?= icap_esc($srv['id']) ?>">Solicitar informaciÃ³n <span aria-hidden="true">â†’</span></a>
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
              <p class="eyebrow">CONTROL Y PROGRAMACIÃ“N</p>
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
          <h2 id="cta-title">El siguiente paso<br><em>empieza aquÃ­.</em></h2>
          <p>CuÃ©ntanos quÃ© necesita tu operaciÃ³n. Estamos en El MarquÃ©s, QuerÃ©taro.</p>
        </div>
        <a class="button button-dark" href="<?= esc_url(home_url('/contacto/')) ?>">Ir a Contacto <span aria-hidden="true">â†’</span></a>
      </div>
    </section>
<?php
get_footer();
