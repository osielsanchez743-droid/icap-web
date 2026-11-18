<?php
declare(strict_types=1);
global $icap_contacto, $icap_sectores, $icap_servicios, $icap_plataformas, $icap_filosofia, $icap_galeria;

$pagina_actual      = 'nosotros';
$titulo_pagina      = 'Nosotros | ICAP IngenierÃ­a';
$descripcion_pagina = 'Conoce la historia, misiÃ³n, visiÃ³n, polÃ­tica de calidad e instalaciones de ICAP IngenierÃ­a en QuerÃ©taro.';

get_header();
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">SOBRE ICAP INGENIERÃA</p>
        <h1 id="page-title">Pensamos en la soluciÃ³n.<br><em>Hacemos que suceda.</em></h1>
        <p class="page-hero-lead">Empresa 100% mexicana fundada en la ciudad de QuerÃ©taro en <?= icap_esc($icap_contacto['fundacion']) ?>.</p>
      </div>
    </section>

    <section class="section" aria-labelledby="history-title">
      <div class="shell service-detail-grid">
        <div class="service-detail-copy">
          <p class="eyebrow">QUIÃ‰NES SOMOS</p>
          <h2 id="history-title">Soluciones prÃ¡cticas, concretas y eficientes para la industria.</h2>
          <p>ICAP IngenierÃ­a naciÃ³ en la ciudad de QuerÃ©taro en el aÃ±o <?= icap_esc($icap_contacto['fundacion']) ?> con el propÃ³sito de ofrecer soluciones prÃ¡cticas, concretas y eficientes a la industria en general, utilizando componentes de alta calidad para la automatizaciÃ³n y la optimizaciÃ³n de lÃ­neas de producciÃ³n.</p>
          <p>Nos especializamos en estaciones de trabajo manuales, semiautomÃ¡ticas y automÃ¡ticas para los sectores <strong>automotriz, aeronÃ¡utico, alimenticio, farmacÃ©utico y de servicios</strong>.</p>
        </div>
        <div class="service-detail-media">
          <img src="<?= esc_url(get_template_directory_uri()) ?>/assets/IngenieriaAutomatizacion.webp" width="1600" height="1200" loading="lazy" alt="Ãrea de maquinados de ICAP IngenierÃ­a">
        </div>
      </div>
    </section>

    <section class="about about-Philosophy" aria-labelledby="philosophy-title">
      <div class="shell">
        <div class="section-heading about-heading">
          <div>
            <p class="eyebrow">IDENTIDAD CORPORATIVA</p>
            <h2 id="philosophy-title">MisiÃ³n, VisiÃ³n y<br><em>PolÃ­tica de Calidad.</em></h2>
          </div>
        </div>
        <div class="about-pillars">
          <?php foreach ($icap_filosofia as $pilar): ?>
          <article class="pillar-card">
            <span class="pillar-index"><?= icap_esc($pilar['indice']) ?></span>
            <h3><?= icap_esc($pilar['titulo']) ?></h3>
            <p><?= icap_esc($pilar['texto']) ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="section" aria-labelledby="locations-title">
      <div class="shell">
        <div class="section-heading">
          <div>
            <p class="eyebrow">UBICACIONES</p>
            <h2 id="locations-title">Nuestras<br><span>instalaciones.</span></h2>
          </div>
          <p>Contamos con oficinas principales y Ã¡rea de ensamble en El MarquÃ©s, asÃ­ como taller de maquinados en Pedro Escobedo, QuerÃ©taro.</p>
        </div>

        <div class="facilities-grid">
          <?php foreach ($icap_contacto['sedes'] as $sede): ?>
          <article class="facility-card">
            <img src="<?= icap_esc($sede['imagen']) ?>" width="1600" height="1200" loading="lazy" alt="<?= icap_esc($sede['alt']) ?>">
            <div class="facility-body">
              <span class="detail-badge"><?= icap_esc($sede['codigo']) ?></span>
              <h3><?= icap_esc($sede['titulo']) ?></h3>
              <p><?= icap_esc($sede['descripcion']) ?></p>
              <address><?= icap_esc($sede['direccion']) ?></address>
              <a class="location-map-link" href="<?= icap_esc($sede['maps_url']) ?>" target="_blank" rel="noopener noreferrer">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <span>Ver ubicaciÃ³n en Google Maps â†—</span>
              </a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

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
