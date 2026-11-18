<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/datos.php';

$pagina_actual      = 'galeria';
$titulo_pagina      = 'Galería | ICAP Ingeniería';
$descripcion_pagina = 'Galería de imágenes de ICAP Ingeniería: equipos, instalaciones y trabajo industrial en Querétaro.';

require_once __DIR__ . '/includes/header.php';
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">TRABAJO EN IMÁGENES</p>
        <h1 id="page-title">Ingeniería<br><em>en acción.</em></h1>
        <p class="page-hero-lead">Una selección de imágenes publicadas por ICAP que muestra equipos, instalaciones y trabajo industrial.</p>
      </div>
    </section>

    <section class="section gallery" aria-label="Galería fotográfica">
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
          <h2 id="cta-title">El siguiente paso<br><em>empieza aquí.</em></h2>
          <p>Cuéntanos qué necesita tu operación. Estamos en El Marqués, Querétaro.</p>
        </div>
        <a class="button button-dark" href="contacto.php">Ir a Contacto <span aria-hidden="true">→</span></a>
      </div>
    </section>

    <dialog class="lightbox" id="gallery-lightbox" aria-label="Vista ampliada de imagen">
      <div class="lightbox-inner">
        <div class="lightbox-topbar">
          <span class="lightbox-counter" id="lightbox-counter">01 / 06</span>
          <button type="button" class="lightbox-close" id="lightbox-close" aria-label="Cerrar vista ampliada">Cerrar ✕</button>
        </div>
        <div class="lightbox-stage">
          <button type="button" class="lightbox-nav lightbox-prev" id="lightbox-prev" aria-label="Imagen anterior">←</button>
          <figure class="lightbox-figure">
            <img id="lightbox-img" src="assets/img/taller.webp" alt="">
            <figcaption class="lightbox-simple-caption">
              <strong id="lightbox-title"></strong>
            </figcaption>
          </figure>
          <button type="button" class="lightbox-nav lightbox-next" id="lightbox-next" aria-label="Imagen siguiente">→</button>
        </div>
      </div>
    </dialog>
<?php
require_once __DIR__ . '/includes/footer.php';
