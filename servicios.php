<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/datos.php';

$pagina_actual      = 'servicios';
$titulo_pagina      = 'Servicios y Especialidades | ICAP Ingeniería';
$descripcion_pagina = 'Especialidades de ICAP Ingeniería: Diseño Mecánico, Manufactura CNC, Sistemas Eléctricos y Neumáticos, y Control con programación de PLC y robots industriales.';

require_once __DIR__ . '/includes/header.php';
?>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="shell">
        <p class="eyebrow">ESPECIALIDADES E INGENIERÍA</p>
        <h1 id="page-title">Soluciones integrales para<br><em>cada etapa del proceso.</em></h1>
        <p class="page-hero-lead">Integramos cuatro áreas de ingeniería bajo un mismo estándar de calidad para fabricar desde componentes de precisión hasta líneas y estaciones automatizadas.</p>
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
          <a class="button button-orange button-sm" href="contacto.php?area=<?= icap_esc($srv['id']) ?>">Cotizar <?= icap_esc($srv['titulo']) ?> <span aria-hidden="true">→</span></a>
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
              <p class="eyebrow">MATRIZ DE COMPATIBILIDAD INDUSTRIAL</p>
              <h3 id="capabilities-title">Plataformas que programamos e integramos</h3>
            </div>
            <p>Nos adaptamos a los estándares instalados en tu planta trabajando con las arquitecturas líderes en automatización, visión y robótica industrial.</p>
          </div>
          <div class="capabilities-groups">
            <?php foreach ($icap_plataformas as $grupo): ?>
            <div class="capability-group">
              <div class="capability-group-header">
                <h4><?= icap_esc($grupo['titulo']) ?></h4>
                <span class="gallery-count"><?= count($grupo['detalle']) ?> MARCAS</span>
              </div>
              <p class="capability-group-sub"><?= icap_esc($grupo['subtitulo']) ?></p>
              <ul class="brand-matrix-grid">
                <?php foreach ($grupo['detalle'] as $item_marca): ?>
                  <li class="brand-matrix-card">
                    <div class="brand-matrix-top">
                      <span class="brand-matrix-name"><?= icap_esc($item_marca['nombre']) ?></span>
                      <span class="brand-matrix-tag"><?= icap_esc($item_marca['tag']) ?></span>
                    </div>
                    <span class="brand-matrix-role"><?= icap_esc($item_marca['rol']) ?></span>
                  </li>
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

    <section class="section process-section" id="proceso" aria-labelledby="process-title">
      <div class="shell">
        <div class="section-heading">
          <div>
            <p class="eyebrow">FLUJO DE TRABAJO INTEGRAL</p>
            <h2 id="process-title">Cómo ejecutamos<br><span>cada proyecto.</span></h2>
          </div>
          <p>Controlamos internamente desde la ingeniería conceptual hasta el maquinado y la puesta en marcha para garantizar tiempos y calidad.</p>
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

    <section class="section faq-section" id="faq" aria-labelledby="faq-title">
      <div class="shell">
        <div class="section-heading">
          <div>
            <p class="eyebrow">DUDAS FRECUENTES DE INGENIERÍA Y COMPRAS</p>
            <h2 id="faq-title">Preguntas<br><span>frecuentes.</span></h2>
          </div>
          <p>Respuestas claras sobre nuestros alcances de diseño CAD, maquinado en taller propio e integración en planta.</p>
        </div>

        <div class="faq-list">
          <?php foreach ($icap_faqs as $idx_faq => $faq): ?>
          <details class="faq-item"<?= $idx_faq === 0 ? ' open' : '' ?>>
            <summary class="faq-summary">
              <span class="faq-summary-left">
                <span class="faq-code"><?= icap_esc($faq['codigo']) ?></span>
                <span class="faq-question"><?= icap_esc($faq['pregunta']) ?></span>
              </span>
              <span class="faq-indicator" aria-hidden="true">+</span>
            </summary>
            <div class="faq-answer">
              <?= icap_esc($faq['respuesta']) ?>
            </div>
          </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="cta-banner" aria-labelledby="cta-title">
      <div class="shell cta-banner-inner">
        <div>
          <p class="eyebrow"><?= icap_esc(strtoupper(implode(' · ', $icap_sectores))) ?></p>
          <h2 id="cta-title">¿Tienes un requerimiento<br><em>en puerta?</em></h2>
          <p>Comparte tus planos o especificaciones con nuestro equipo en Querétaro.</p>
        </div>
        <a class="button button-dark" href="contacto.php">Solicitar cotización <span aria-hidden="true">→</span></a>
      </div>
    </section>
<?php
require_once __DIR__ . '/includes/footer.php';
