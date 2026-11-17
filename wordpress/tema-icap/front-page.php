<?php
declare(strict_types=1);
global $icap_contacto, $icap_sectores, $icap_servicios, $icap_proceso, $icap_plataformas, $icap_filosofia, $icap_galeria, $icap_faqs;

$pagina_actual      = 'inicio';
$titulo_pagina      = 'ICAP Ingeniería | Automatización e ingeniería industrial';
$descripcion_pagina = 'ICAP Ingeniería desarrolla soluciones de automatización e ingeniería industrial en Querétaro: diseño mecánico, manufactura, eléctrico y neumático, y control.';
$preload_hero       = true;

get_header();
?>
    <section class="hero" id="inicio" aria-labelledby="hero-title">
      <div class="shell hero-grid-shell">
        <div class="hero-content">
          <div class="hero-meta-bar" aria-hidden="true">
            <span>SISTEMA // <strong>ICAP-MX</strong></span>
            <span>QUERÉTARO · EST. <?= icap_esc($icap_contacto['fundacion']) ?></span>
          </div>
          <p class="eyebrow">AUTOMATIZACIÓN E INGENIERÍA INDUSTRIAL</p>
          <h1 id="hero-title">Ingeniería que<br>convierte ideas<br>en <em>movimiento.</em></h1>
          <p class="hero-lead">Desarrollamos estaciones de trabajo, maquinados de precisión e integración de control a la medida de las líneas de producción en México.</p>
          <div class="hero-actions">
            <a class="button button-orange" href="<?= esc_url(home_url('/contacto/')) ?>">Cotizar proyecto <span aria-hidden="true">↗</span></a>
            <a class="text-link" href="<?= esc_url(home_url('/servicios/')) ?>">Ver las 4 especialidades <span aria-hidden="true">→</span></a>
          </div>
          <div class="hero-sector-chips" aria-label="Sectores industriales atendidos">
            <span>SECTORES:</span>
            <?php foreach ($icap_sectores as $sector): ?>
              <strong class="sector-chip"><?= icap_esc($sector) ?></strong>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="hero-viewport">
          <div class="viewport-header" aria-hidden="true">
            <span class="viewport-status">MONITOR DE PLANTA // SELECCIONA VISTA</span>
            <span>ESC 1:1 · QRO</span>
          </div>
          <div class="viewport-frame">
            <img id="hero-viewport-img" src="<?= esc_url(get_template_directory_uri() . '/assets/taller.webp') ?>" width="1599" height="899" fetchpriority="high" alt="Línea de estaciones de trabajo automatizadas desarrolladas por ICAP Ingeniería">
            <div class="viewport-overlay-tag" aria-hidden="true">
              <span id="hero-viewport-caption">INTEGRACIÓN MECÁNICA, NEUMÁTICA Y CONTROL</span>
              <span id="hero-viewport-code">[CAM 01]</span>
            </div>
          </div>
          <div class="viewport-specs" role="tablist" aria-label="Cambiar fotografía del visor principal">
            <button type="button" class="viewport-spec-item is-active" data-hero-src="<?= esc_url(get_template_directory_uri() . '/assets/taller.webp') ?>" data-hero-caption="INTEGRACIÓN MECÁNICA, NEUMÁTICA Y CONTROL" data-hero-code="[CAM 01]">
              <span>CAM 01 // ENSAMBLE</span>
              <strong>Estaciones Automatizadas</strong>
            </button>
            <button type="button" class="viewport-spec-item" data-hero-src="<?= esc_url(get_template_directory_uri() . '/assets/IngenieriaAutomatizacion.webp') ?>" data-hero-caption="TALLER DE MAQUINADOS CNC Y CONVENCIONAL" data-hero-code="[CAM 02]">
              <span>CAM 02 // MANUFACTURA</span>
              <strong>Maquinado CNC y Taller</strong>
            </button>
            <button type="button" class="viewport-spec-item" data-hero-src="<?= esc_url(get_template_directory_uri() . '/assets/IngenieriaManufactura.webp') ?>" data-hero-caption="UNIDADES DE MANTENIMIENTO Y PRUEBAS NEUMÁTICAS" data-hero-code="[CAM 03]">
              <span>CAM 03 // POTENCIA</span>
              <strong>Integración Neumática</strong>
            </button>
          </div>
        </div>
      </div>
    </section>

    <section class="intro-band" aria-label="Presentación">
      <div class="shell intro-band-inner">
        <span class="section-index">01 // CAPACIDAD</span>
        <p>Integramos <strong>diseño mecánico, manufactura, sistemas eléctricos/neumáticos y control</strong> para responder a los retos reales de la industria.</p>
        <span class="intro-mark" aria-hidden="true">[+]</span>
      </div>
    </section>

    <section class="section services" id="servicios" aria-labelledby="services-title">
      <div class="shell">
        <div class="section-heading">
          <div>
            <p class="eyebrow">ESPECIALIDADES TÉCNICAS</p>
            <h2 id="services-title">Soluciones para cada<br><span>etapa del proceso.</span></h2>
          </div>
          <p>Cuatro áreas de ingeniería conectadas bajo un mismo estándar técnico para desarrollar soluciones prácticas y precisas.</p>
        </div>

        <div class="service-grid">
          <?php foreach ($icap_servicios as $servicio): ?>
          <article class="service-card">
            <div class="service-card-thumb">
              <img src="<?= icap_esc($servicio['imagen']) ?>" width="800" height="450" loading="lazy" alt="<?= icap_esc($servicio['alt']) ?>">
            </div>
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
              <a class="service-link" href="<?= esc_url(home_url('/servicios/')) ?>#<?= icap_esc($servicio['id']) ?>" aria-label="Ver detalles de <?= icap_esc($servicio['titulo']) ?>">
                <span>Especificaciones</span>
                <span class="card-arrow" aria-hidden="true">→</span>
              </a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="section process-section" id="proceso" aria-labelledby="process-title">
      <div class="shell">
        <div class="section-heading">
          <div>
            <p class="eyebrow">METODOLOGÍA LLAVE EN MANO</p>
            <h2 id="process-title">De la idea en plano a<br><span>puesta en marcha en línea.</span></h2>
          </div>
          <p>Ejecutamos todo el ciclo de ingeniería en Querétaro: desde el levantamiento y modelado CAD hasta el maquinado propio y programación en planta.</p>
        </div>

        <div class="process-timeline">
          <?php foreach ($icap_proceso as $idx_paso => $etapa): ?>
          <article class="process-step">
            <div>
              <div class="process-step-meta">
                <span class="process-step-num"><?= icap_esc($etapa['paso']) ?></span>
                <span class="process-step-code"><?= icap_esc($etapa['codigo']) ?></span>
              </div>
              <h3><?= icap_esc($etapa['titulo']) ?></h3>
              <p><?= icap_esc($etapa['descripcion']) ?></p>
            </div>
            <div class="process-step-connector" aria-hidden="true">
              <span>ETAPA 0<?= $idx_paso + 1 ?> / 05</span>
              <span><?= $idx_paso < 4 ? '───►' : '● OK' ?></span>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="about" id="nosotros" aria-labelledby="about-title">
      <div class="shell about-top">
        <div class="about-photo">
          <img src="<?= esc_url(get_template_directory_uri() . '/assets/IngenieriaAutomatizacion.webp') ?>" width="1600" height="1200" loading="lazy" alt="Área de maquinados de ICAP con equipo y personal en operación">
        </div>
        <div class="about-copy">
          <p class="eyebrow">SOBRE ICAP INGENIERÍA</p>
          <h2 id="about-title">Pensamos en<br>la solución.<br><em>Hacemos que suceda.</em></h2>
          <p>ICAP Ingeniería nació en Querétaro en <?= icap_esc($icap_contacto['fundacion']) ?> para ofrecer soluciones prácticas, concretas y eficientes a la industria. Nuestro trabajo reúne automatización de procesos e innovación tecnológica.</p>
          <a class="text-link" href="<?= esc_url(home_url('/nosotros/')) ?>">Conoce nuestra historia, misión y calidad <span aria-hidden="true">→</span></a>
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
            <p class="eyebrow">EVIDENCIA EN PLANTA</p>
            <h2 id="gallery-title">Ingeniería<br><span>en acción.</span></h2>
          </div>
          <div>
            <p>Un vistazo a nuestras estaciones automatizadas, equipos de proceso e instalaciones en Querétaro.</p>
            <a class="text-link" href="<?= esc_url(home_url('/galeria/')) ?>">Ver galería completa (<?= count($icap_galeria) ?> fotos) <span aria-hidden="true">→</span></a>
          </div>
        </div>

        <div class="gallery-grid gallery-grid-preview">
          <?php
          $fotos_destacadas = array_slice($icap_galeria, 0, 3);
          foreach ($fotos_destacadas as $idx => $foto):
          ?>
          <figure class="gallery-item<?= $idx === 0 ? ' gallery-feature' : '' ?>">
            <a href="<?= esc_url(home_url('/galeria/')) ?>" class="gallery-trigger" aria-label="Ver en galería: <?= icap_esc($foto['titulo']) ?>">
              <img src="<?= icap_esc($foto['src']) ?>" width="1600" height="1200" loading="lazy" alt="<?= icap_esc($foto['alt']) ?>">
              <span class="gallery-zoom-badge" aria-hidden="true">ABRIR GALERÍA →</span>
            </a>
            <figcaption>
              <div class="gallery-caption-top">
                <div>
                  <strong><?= icap_esc($foto['titulo']) ?></strong>
                  <span><?= icap_esc($foto['subtitulo']) ?></span>
                </div>
                <span class="gallery-count"><?= icap_esc($foto['fig']) ?></span>
              </div>
              <?php if (!empty($foto['tags'])): ?>
              <div class="gallery-tags" aria-label="Especialidades aplicadas">
                <?php foreach ($foto['tags'] as $tag): ?>
                  <span class="gallery-tag">[<?= icap_esc($tag) ?>]</span>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
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
          <p>Cuéntanos qué necesita tu operación. Estamos en El Marqués y Pedro Escobedo, Querétaro.</p>
        </div>
        <a class="button button-dark" href="<?= esc_url(home_url('/contacto/')) ?>">Ir a Contacto y Cotizaciones <span aria-hidden="true">→</span></a>
      </div>
    </section>
<?php
get_footer();
