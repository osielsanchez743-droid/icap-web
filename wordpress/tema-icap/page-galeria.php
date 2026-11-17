<?php
/* Template Name: ICAP Galería */
declare(strict_types=1);
global $icap_contacto, $icap_sectores, $icap_servicios, $icap_proceso, $icap_plataformas, $icap_filosofia, $icap_galeria, $icap_faqs;

$pagina_actual      = 'galeria';
$titulo_pagina      = 'Galería | ICAP Ingeniería';
$descripcion_pagina = 'Galería fotográfica de ICAP Ingeniería: estaciones de trabajo automatizadas, integración neumática, equipos de transporte e instalaciones en Querétaro.';

get_header();
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">EVIDENCIA EN PLANTA</p>
        <h1 id="page-title">Ingeniería<br><em>en acción.</em></h1>
        <p class="page-hero-lead">Selección de fotografías de estaciones automatizadas, integración neumática, equipos de proceso e instalaciones operativas de ICAP Ingeniería. Haz clic en cualquier imagen para ampliarla.</p>
      </div>
    </section>

    <section class="section gallery" aria-label="Galería fotográfica">
      <div class="shell">
        <div class="gallery-filters" role="toolbar" aria-label="Filtrar fotografías por área">
          <button type="button" class="filter-btn is-active" data-filter="all">Todas (<?= count($icap_galeria) ?>)</button>
          <button type="button" class="filter-btn" data-filter="estaciones">Estaciones y Ensamble</button>
          <button type="button" class="filter-btn" data-filter="neumatica">Neumática y Control</button>
          <button type="button" class="filter-btn" data-filter="manufactura">Manufactura y Planta</button>
        </div>

        <div class="gallery-grid gallery-grid-full">
          <?php foreach ($icap_galeria as $idx => $foto): ?>
          <figure class="gallery-item" data-category="<?= icap_esc($foto['categoria']) ?>">
            <button type="button" class="gallery-trigger" data-index="<?= $idx ?>" aria-label="Ampliar fotografía <?= icap_esc($foto['contador']) ?>: <?= icap_esc($foto['titulo']) ?>">
              <img src="<?= icap_esc($foto['src']) ?>" width="1600" height="1200" loading="lazy" alt="<?= icap_esc($foto['alt']) ?>">
              <span class="gallery-zoom-badge" aria-hidden="true">AMPLIAR ↗</span>
            </button>
            <figcaption>
              <div class="gallery-caption-top">
                <div>
                  <strong><?= icap_esc($foto['titulo']) ?></strong>
                  <span><?= icap_esc($foto['subtitulo']) ?></span>
                </div>
                <span class="gallery-count"><?= icap_esc($foto['contador']) ?></span>
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
          <p class="eyebrow">PROYECTOS A MEDIDA</p>
          <h2 id="cta-title">Diseñamos la estación que<br><em>tu línea necesita.</em></h2>
          <p>Platícanos sobre tu proceso y desarrollemos juntos la solución.</p>
        </div>
        <a class="button button-dark" href="<?= esc_url(home_url('/contacto/')) ?>">Iniciar conversación <span aria-hidden="true">→</span></a>
      </div>
    </section>

    <dialog class="lightbox" id="gallery-lightbox" aria-label="Visor de imágenes de ingeniería">
      <div class="lightbox-inner">
        <div class="lightbox-topbar">
          <span class="lightbox-counter" id="lightbox-counter">01 / 06</span>
          <button type="button" class="lightbox-close" id="lightbox-close" aria-label="Cerrar vista ampliada">Cerrar ✕</button>
        </div>
        <div class="lightbox-stage">
          <button type="button" class="lightbox-nav lightbox-prev" id="lightbox-prev" aria-label="Fotografía anterior">←</button>
          <div class="lightbox-content-split">
            <figure class="lightbox-figure">
              <img id="lightbox-img" src="<?= esc_url(get_template_directory_uri() . '/assets/taller.webp') ?>" alt="">
            </figure>
            <div class="lightbox-spec-panel">
              <div>
                <p class="lightbox-spec-eyebrow">INSPECCIÓN TÉCNICA // ICAP MX</p>
                <div class="lightbox-caption">
                  <strong id="lightbox-title"></strong>
                  <span id="lightbox-desc"></span>
                </div>
                <div class="lightbox-tags" id="lightbox-tags" aria-label="Especialidades involucradas"></div>
                <p class="lightbox-specs-title">Elementos observados en estación</p>
                <ul class="lightbox-specs-list" id="lightbox-specs"></ul>
              </div>
              <div class="lightbox-spec-footer">
                <a class="button button-orange button-sm button-full" id="lightbox-quote-link" href="<?= esc_url(home_url('/contacto/')) ?>">
                  <span>Cotizar un proyecto similar</span>
                  <span aria-hidden="true">→</span>
                </a>
              </div>
            </div>
          </div>
          <button type="button" class="lightbox-nav lightbox-next" id="lightbox-next" aria-label="Fotografía siguiente">→</button>
        </div>
      </div>
    </dialog>
<?php
get_footer();
