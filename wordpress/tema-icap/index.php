<?php
declare(strict_types=1);
global $icap_contacto, $icap_sectores, $icap_servicios, $icap_plataformas, $icap_filosofia, $icap_galeria;

$pagina_actual      = 'inicio';
$titulo_pagina      = 'ICAP IngenierÃ­a | AutomatizaciÃ³n e ingenierÃ­a industrial';
$descripcion_pagina = 'ICAP IngenierÃ­a desarrolla soluciones de automatizaciÃ³n e ingenierÃ­a industrial en QuerÃ©taro: diseÃ±o mecÃ¡nico, manufactura, elÃ©ctrico y neumÃ¡tico, y control.';
$preload_hero       = true;

get_header();
?>
    <section class="hero" id="inicio" aria-labelledby="hero-title">
      <div class="shell hero-grid-shell">
        <div class="hero-content">
          <p class="eyebrow">INGENIERÃA INDUSTRIAL Â· QUERÃ‰TARO</p>
          <h1 id="hero-title">IngenierÃ­a que<br>convierte ideas<br>en <em>movimiento.</em></h1>
          <p class="hero-lead">Soluciones a medida para automatizaciÃ³n de procesos, diseÃ±o y manufactura industrial.</p>
          <div class="hero-actions">
            <a class="button button-orange" href="<?= esc_url(home_url('/contacto/')) ?>">Hablemos de tu proyecto <span aria-hidden="true">â†—</span></a>
            <a class="text-link" href="<?= esc_url(home_url('/servicios/')) ?>">Explorar servicios <span aria-hidden="true">â†’</span></a>
          </div>
          <div class="hero-sector-chips" aria-label="Sectores industriales atendidos">
            <span>SECTORES:</span>
            <?php foreach ($icap_sectores as $sector): ?>
              <strong class="sector-chip"><?= icap_esc($sector) ?></strong>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="hero-viewport">
          <div class="viewport-frame">
            <img id="hero-viewport-img" src="<?= esc_url(get_template_directory_uri()) ?>/assets/taller.webp" width="1599" height="899" fetchpriority="high" alt="Estaciones de trabajo y equipos de automatizaciÃ³n de ICAP IngenierÃ­a">
          </div>
        </div>
      </div>
    </section>

    <section class="intro-band" aria-label="PresentaciÃ³n">
      <div class="shell intro-band-inner">
        <span class="section-index">01 / LO QUE HACEMOS</span>
        <p>Integramos <strong>ingenierÃ­a, manufactura y control</strong> para responder a los retos reales de la industria.</p>
        <span class="intro-mark" aria-hidden="true">âœ³</span>
      </div>
    </section>

    <section class="section services" id="servicios" aria-labelledby="services-title">
      <div class="shell">
        <div class="section-heading">
          <div>
            <p class="eyebrow">NUESTRAS ESPECIALIDADES</p>
            <h2 id="services-title">Soluciones para cada<br><span>etapa del proceso.</span></h2>
          </div>
          <p>Cuatro Ã¡reas de trabajo conectadas por un mismo objetivo: desarrollar soluciones prÃ¡cticas y precisas para la industria.</p>
        </div>

        <div class="service-grid">
          <?php foreach ($icap_servicios as $servicio): ?>
          <article class="service-card">
            <div class="service-card-body">
              <div class="service-card-top">
                <span class="service-number"><?= icap_esc($servicio['codigo']) ?></span>
                <span class="service-icon" aria-hidden="true">
                  <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <?= $servicio['svg'] ?>
                  </svg>
                </span>
              </div>
              <h3><?= icap_esc($servicio['titulo']) ?></h3>
              <p><?= icap_esc($servicio['resumen']) ?></p>
              <a class="service-link" href="<?= esc_url(home_url('/servicios/')) ?>#<?= icap_esc($servicio['id']) ?>" aria-label="Conoce <?= icap_esc($servicio['titulo']) ?>">
                <span>Ver mÃ¡s</span>
                <span class="card-arrow" aria-hidden="true">â†’</span>
              </a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="about" id="nosotros" aria-labelledby="about-title">
      <div class="shell about-top">
        <div class="about-photo">
          <img src="<?= esc_url(get_template_directory_uri()) ?>/assets/IngenieriaAutomatizacion.webp" width="1600" height="1200" loading="lazy" alt="Ãrea de maquinados de ICAP con equipo y personal en operaciÃ³n">
        </div>
        <div class="about-copy">
          <p class="eyebrow">SOBRE ICAP INGENIERÃA</p>
          <h2 id="about-title">Pensamos en<br>la soluciÃ³n.<br><em>Hacemos que suceda.</em></h2>
          <p>ICAP IngenierÃ­a naciÃ³ en QuerÃ©taro en <?= icap_esc($icap_contacto['fundacion']) ?> para ofrecer soluciones prÃ¡cticas, concretas y eficientes a la industria. Su trabajo reÃºne automatizaciÃ³n de procesos e innovaciÃ³n tecnolÃ³gica.</p>
          <a class="text-link" href="<?= esc_url(home_url('/nosotros/')) ?>">Conoce mÃ¡s sobre ICAP <span aria-hidden="true">â†’</span></a>
          <div class="about-detail" aria-hidden="true">
            <span class="detail-line"></span>
            <span>DISEÃ‘O Â· INTEGRACIÃ“N Â· MANUFACTURA</span>
          </div>
        </div>
      </div>
    </section>

    <section class="section gallery" id="galeria" aria-labelledby="gallery-title">
      <div class="shell">
        <div class="section-heading gallery-heading">
          <div>
            <p class="eyebrow">TRABAJO EN IMÃGENES</p>
            <h2 id="gallery-title">IngenierÃ­a<br><span>en acciÃ³n.</span></h2>
          </div>
          <div>
            <p>Una selecciÃ³n de imÃ¡genes publicadas por ICAP que muestra equipos, instalaciones y trabajo industrial.</p>
            <a class="text-link" href="<?= esc_url(home_url('/galeria/')) ?>">Ver galerÃ­a completa <span aria-hidden="true">â†’</span></a>
          </div>
        </div>

        <div class="gallery-grid gallery-grid-preview">
          <?php
          $fotos_portada = array_slice($icap_galeria, 0, 4);
          foreach ($fotos_portada as $idx => $foto):
          ?>
          <figure class="gallery-item">
            <a href="<?= esc_url(home_url('/galeria/')) ?>" class="gallery-trigger" aria-label="Ver en galerÃ­a: <?= icap_esc($foto['titulo']) ?>">
              <img src="<?= icap_esc($foto['src']) ?>" width="1600" height="1200" loading="lazy" alt="<?= icap_esc($foto['alt']) ?>">
            </a>
            <figcaption>
              <div class="gallery-caption-top">
                <strong><?= icap_esc($foto['titulo']) ?></strong>
                <span class="gallery-count">0<?= $idx + 1 ?> / 04</span>
              </div>
            </figcaption>
          </figure>
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
