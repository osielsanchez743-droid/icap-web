<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/datos.php';

$pagina_actual      = 'inicio';
$titulo_pagina      = 'ICAP Ingeniería | Automatización e ingeniería industrial';
$descripcion_pagina = 'ICAP Ingeniería desarrolla soluciones de automatización e ingeniería industrial en Querétaro: diseño mecánico, manufactura, eléctrico y neumático, y control.';
$preload_hero       = true;

require_once __DIR__ . '/includes/header.php';
?>
    <section class="hero" id="inicio" aria-labelledby="hero-title">
      <div class="shell hero-grid-shell">
        <div class="hero-content">
          <p class="eyebrow">INGENIERÍA INDUSTRIAL · QUERÉTARO</p>
          <h1 id="hero-title">Ingeniería que<br>convierte ideas<br>en <em>movimiento.</em></h1>
          <p class="hero-lead">Soluciones a medida para automatización de procesos, diseño y manufactura industrial.</p>
          <div class="hero-actions">
            <a class="button button-orange" href="contacto.php">Hablemos de tu proyecto <span aria-hidden="true">↗</span></a>
            <a class="text-link" href="servicios.php">Explorar servicios <span aria-hidden="true">→</span></a>
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
            <img id="hero-viewport-img" src="assets/img/taller.webp" width="1599" height="899" fetchpriority="high" alt="Estaciones de trabajo y equipos de automatización de ICAP Ingeniería">
          </div>
        </div>
      </div>
    </section>

    <section class="intro-band" aria-label="Presentación">
      <div class="shell intro-band-inner">
        <span class="section-index">01 / LO QUE HACEMOS</span>
        <p>Integramos <strong>ingeniería, manufactura y control</strong> para responder a los retos reales de la industria.</p>
        <span class="intro-mark" aria-hidden="true">✳</span>
      </div>
    </section>

    <section class="section services" id="servicios" aria-labelledby="services-title">
      <div class="shell">
        <div class="section-heading">
          <div>
            <p class="eyebrow">NUESTRAS ESPECIALIDADES</p>
            <h2 id="services-title">Soluciones para cada<br><span>etapa del proceso.</span></h2>
          </div>
          <p>Cuatro áreas de trabajo conectadas por un mismo objetivo: desarrollar soluciones prácticas y precisas para la industria.</p>
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
              <a class="service-link" href="servicios.php#<?= icap_esc($servicio['id']) ?>" aria-label="Conoce <?= icap_esc($servicio['titulo']) ?>">
                <span>Ver más</span>
                <span class="card-arrow" aria-hidden="true">→</span>
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
          <img src="assets/img/IngenieriaAutomatizacion.webp" width="1600" height="1200" loading="lazy" alt="Área de maquinados de ICAP con equipo y personal en operación">
        </div>
        <div class="about-copy">
          <p class="eyebrow">SOBRE ICAP INGENIERÍA</p>
          <h2 id="about-title">Pensamos en<br>la solución.<br><em>Hacemos que suceda.</em></h2>
          <p>ICAP Ingeniería nació en Querétaro en <?= icap_esc($icap_contacto['fundacion']) ?> para ofrecer soluciones prácticas, concretas y eficientes a la industria. Su trabajo reúne automatización de procesos e innovación tecnológica.</p>
          <a class="text-link" href="nosotros.php">Conoce más sobre ICAP <span aria-hidden="true">→</span></a>
          <div class="about-detail" aria-hidden="true">
            <span class="detail-line"></span>
            <span>DISEÑO · INTEGRACIÓN · MANUFACTURA</span>
          </div>
        </div>
      </div>
    </section>

    <section class="section gallery" id="galeria" aria-labelledby="gallery-title">
      <div class="shell">
        <div class="section-heading gallery-heading">
          <div>
            <p class="eyebrow">TRABAJO EN IMÁGENES</p>
            <h2 id="gallery-title">Ingeniería<br><span>en acción.</span></h2>
          </div>
          <div>
            <p>Una selección de imágenes publicadas por ICAP que muestra equipos, instalaciones y trabajo industrial.</p>
            <a class="text-link" href="galeria.php">Ver galería completa <span aria-hidden="true">→</span></a>
          </div>
        </div>

        <div class="gallery-grid gallery-grid-preview">
          <?php
          $fotos_portada = array_slice($icap_galeria, 0, 4);
          foreach ($fotos_portada as $idx => $foto):
          ?>
          <figure class="gallery-item">
            <a href="galeria.php" class="gallery-trigger" aria-label="Ver en galería: <?= icap_esc($foto['titulo']) ?>">
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
          <h2 id="cta-title">El siguiente paso<br><em>empieza aquí.</em></h2>
          <p>Cuéntanos qué necesita tu operación. Estamos en El Marqués, Querétaro.</p>
        </div>
        <a class="button button-dark" href="contacto.php">Ir a Contacto <span aria-hidden="true">→</span></a>
      </div>
    </section>
<?php
require_once __DIR__ . '/includes/footer.php';
