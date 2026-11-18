<?php
declare(strict_types=1);
global $icap_contacto, $icap_sectores, $icap_servicios, $icap_plataformas, $icap_filosofia, $icap_galeria;

$pagina_actual      = 'galeria';
$titulo_pagina      = 'GalerÃ­a | ICAP IngenierÃ­a';
$descripcion_pagina = 'GalerÃ­a de imÃ¡genes de ICAP IngenierÃ­a: equipos, instalaciones y trabajo industrial en QuerÃ©taro.';

get_header();
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">TRABAJO EN IMÃGENES</p>
        <h1 id="page-title">IngenierÃ­a<br><em>en acciÃ³n.</em></h1>
        <p class="page-hero-lead">Una selecciÃ³n de imÃ¡genes publicadas por ICAP que muestra equipos, instalaciones y trabajo industrial.</p>
      </div>
    </section>

    <section class="section gallery" aria-label="GalerÃ­a fotogrÃ¡fica">
      <div class="shell">
        <div class="gallery-grid gallery-grid-full">
          <?php foreach ($icap_galeria as $idx => $foto): ?>
          <figure class="gallery-item" data-category="<?= icap_esc($foto['categoria']) ?>">
            <button type="button" class="gallery-trigger" data-index="<?= $idx ?>" aria-label="Ampliar imagen <?= icap_esc($foto['contador']) ?>: <?= icap_esc($foto['titulo']) ?>">
              <img src="<?= icap_esc($foto['src']) ?>" width="1600" height="1200" loading="lazy" alt="<?= icap_esc($foto['alt']) ?>">
            </button>
            <figcaption>
              <div class="gallery-caption-top">
                <strong><?= icap_esc($foto['titulo']) ?></strong>
                <span class="gallery-count"><?= icap_esc($foto['contador']) ?></span>
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

    <dialog class="lightbox" id="gallery-lightbox" aria-label="Vista ampliada de imagen">
      <div class="lightbox-inner">
        <div class="lightbox-topbar">
          <span class="lightbox-counter" id="lightbox-counter">01 / 06</span>
          <button type="button" class="lightbox-close" id="lightbox-close" aria-label="Cerrar vista ampliada">Cerrar âœ•</button>
        </div>
        <div class="lightbox-stage">
          <button type="button" class="lightbox-nav lightbox-prev" id="lightbox-prev" aria-label="Imagen anterior">â†</button>
          <figure class="lightbox-figure">
            <img id="lightbox-img" src="<?= esc_url(get_template_directory_uri()) ?>/assets/taller.webp" alt="">
            <figcaption class="lightbox-simple-caption">
              <strong id="lightbox-title"></strong>
            </figcaption>
          </figure>
          <button type="button" class="lightbox-nav lightbox-next" id="lightbox-next" aria-label="Imagen siguiente">â†’</button>
        </div>
      </div>
    </dialog>
<?php
get_footer();
