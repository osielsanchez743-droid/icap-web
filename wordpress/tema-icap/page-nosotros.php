<?php
/* Template Name: ICAP Nosotros */
declare(strict_types=1);
global $icap_contacto, $icap_sectores, $icap_servicios, $icap_proceso, $icap_plataformas, $icap_filosofia, $icap_galeria, $icap_faqs;

$pagina_actual      = 'nosotros';
$titulo_pagina      = 'Nosotros | ICAP Ingeniería';
$descripcion_pagina = 'Conoce la historia, misión, visión, política de calidad e instalaciones de ICAP Ingeniería en El Marqués y Pedro Escobedo, Querétaro.';

get_header();
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">SOBRE ICAP INGENIERÍA</p>
        <h1 id="page-title">Pensamos en la solución.<br><em>Hacemos que suceda.</em></h1>
        <p class="page-hero-lead">Empresa 100% mexicana fundada en Querétaro en <?= icap_esc($icap_contacto['fundacion']) ?>, dedicada a la instrumentación, control y automatización de procesos industriales.</p>
      </div>
    </section>

    <section class="section" aria-labelledby="history-title">
      <div class="shell service-detail-grid">
        <div class="service-detail-copy">
          <p class="eyebrow">NUESTRA HISTORIA</p>
          <h2 id="history-title">Ingeniería práctica para los retos reales de planta.</h2>
          <p>ICAP Ingeniería nació en la ciudad de Querétaro en el año <?= icap_esc($icap_contacto['fundacion']) ?> con el propósito de ofrecer soluciones prácticas, concretas y eficientes a la industria en general, utilizando componentes de alta calidad para la automatización y la optimización de líneas de producción.</p>
          <p>Atendemos requerimientos de los sectores <strong>automotriz, aeronáutico, alimenticio, farmacéutico y de servicios</strong>, acompañando a cada cliente desde la ingeniería conceptual hasta la manufactura y puesta en marcha.</p>
        </div>
        <div class="service-detail-media">
          <img src="<?= esc_url(get_template_directory_uri() . '/assets/IngenieriaAutomatizacion.webp') ?>" width="1600" height="1200" loading="lazy" alt="Equipo técnico de ICAP Ingeniería en el área de maquinados">
        </div>
      </div>
    </section>

    <section class="about about-Philosophy" aria-labelledby="philosophy-title">
      <div class="shell">
        <div class="section-heading about-heading">
          <div>
            <p class="eyebrow">FILOSOFÍA CORPORATIVA</p>
            <h2 id="philosophy-title">Nuestro compromiso<br><em>con la industria.</em></h2>
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
            <p class="eyebrow">INFRAESTRUCTRUCTURA EN QUERÉTARO</p>
            <h2 id="locations-title">Nuestras<br><span>instalaciones.</span></h2>
          </div>
          <p>Dos ubicaciones estratégicas en el corredor industrial de Querétaro para separar el ensamble e integración del maquinado pesado.</p>
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
                <span>Ver ubicación en Google Maps ↗</span>
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
          <p class="eyebrow">TRABAJEMOS JUNTOS</p>
          <h2 id="cta-title">Conoce cómo podemos<br><em>apoyar a tu planta.</em></h2>
          <p>Agenda una llamada o visita técnica con nuestro equipo de ingeniería.</p>
        </div>
        <a class="button button-dark" href="<?= esc_url(home_url('/contacto/')) ?>">Contactar a ICAP <span aria-hidden="true">→</span></a>
      </div>
    </section>
<?php
get_footer();
