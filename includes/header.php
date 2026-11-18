<?php
declare(strict_types=1);

$pagina_actual      = $pagina_actual ?? 'inicio';
$titulo_pagina      = $titulo_pagina ?? 'ICAP Ingeniería | Automatización e ingeniería industrial';
$descripcion_pagina = $descripcion_pagina ?? 'ICAP Ingeniería desarrolla soluciones de automatización e ingeniería industrial en Querétaro: diseño mecánico, manufactura, eléctrico y neumático, y control.';
$preload_hero       = $preload_hero ?? false;
?>
<!doctype html>
<html lang="es-MX" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#f2f3ef">
  <meta name="description" content="<?= icap_esc($descripcion_pagina) ?>">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="es_MX">
  <meta property="og:title" content="<?= icap_esc($titulo_pagina) ?>">
  <meta property="og:description" content="<?= icap_esc($descripcion_pagina) ?>">
  <meta property="og:image" content="assets/img/taller.webp">
  <title><?= icap_esc($titulo_pagina) ?></title>
  <link rel="icon" type="image/png" sizes="128x128" href="assets/img/favicon.png?v=2">
  <link rel="shortcut icon" href="assets/img/favicon.ico?v=2">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png?v=2">
  <?php if ($preload_hero): ?>
  <link rel="preload" as="image" href="assets/img/taller.webp">
  <?php endif; ?>
  <script>
    (function () {
      try {
        var saved = localStorage.getItem('icap-theme');
        var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        var theme = saved === 'dark' || saved === 'light' ? saved : (prefersDark ? 'dark' : 'light');
        document.documentElement.setAttribute('data-theme', theme);
      } catch (e) {}
    })();
  </script>
  <link rel="stylesheet" href="assets/css/styles.css">
  <script src="assets/js/script.js" defer></script>
  <?php
  $schema_graph = [
      [
          '@type'            => 'ProfessionalService',
          '@id'              => 'https://icapmx.com/#organization',
          'name'             => 'ICAP Ingeniería S.A. DE C.V.',
          'alternateName'    => 'ICAP Instrumentación, Control y Automatización de Procesos',
          'url'              => 'https://icapmx.com/',
          'logo'             => 'https://icapmx.com/assets/img/ICAP_LOGO_clean.png',
          'image'            => 'https://icapmx.com/assets/img/taller.webp',
          'foundingDate'     => '2016',
          'email'            => $icap_contacto['correo'],
          'telephone'        => $icap_contacto['telefono_enlace'],
          'address'          => [
              '@type'           => 'PostalAddress',
              'streetAddress'   => 'Carretera Estatal 431, El Colorado-Galindo, Km 1.9, Condominio Industrial EUROPARK II, Bodega 5A',
              'addressLocality' => 'El Marqués',
              'addressRegion'   => 'Querétaro',
              'postalCode'      => '76246',
              'addressCountry'  => 'MX'
          ],
          'geo'              => [
              '@type'     => 'GeoCoordinates',
              'latitude'  => 20.5585749,
              'longitude' => -100.2688614
          ],
          'department'       => [
              [
                  '@type'     => 'LocalBusiness',
                  'name'      => 'ICAP Ingeniería — Taller de Maquinados Pedro Escobedo',
                  'telephone' => $icap_contacto['telefono_enlace'],
                  'address'   => [
                      '@type'           => 'PostalAddress',
                      'addressLocality' => 'Pedro Escobedo',
                      'addressRegion'   => 'Querétaro',
                      'addressCountry'  => 'MX'
                  ],
                  'geo'       => [
                      '@type'     => 'GeoCoordinates',
                      'latitude'  => 20.490902,
                      'longitude' => -100.185883
                  ]
              ]
          ],
          'sameAs'           => [
              $icap_contacto['redes']['linkedin']['url'],
              $icap_contacto['redes']['youtube']['url'],
              $icap_contacto['redes']['facebook']['url']
          ],
          'knowsAbout'       => [
              'Diseño Mecánico',
              'Manufactura',
              'Eléctrico / Neumático',
              'Control'
          ]
      ]
  ];
  ?>
  <script type="application/ld+json"><?= json_encode(['@context' => 'https://schema.org', '@graph' => $schema_graph], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
</head>
<body>
  <a class="skip-link" href="#contenido">Ir al contenido principal</a>

  <header class="site-header" id="site-header">
    <div class="shell header-inner">
      <a class="brand" href="index.php" aria-label="ICAP Ingeniería, ir al inicio">
        <img src="assets/img/ICAP_LOGO_clean.png" width="389" height="95" alt="ICAP">
        <span>INGENIERÍA</span>
      </a>
      <div class="header-controls">
        <nav class="main-nav" id="nav-principal" aria-label="Navegación principal">
          <a href="index.php"<?= $pagina_actual === 'inicio' ? ' aria-current="page"' : '' ?>>Inicio</a>
          <a href="servicios.php"<?= $pagina_actual === 'servicios' ? ' aria-current="page"' : '' ?>>Servicios</a>
          <a href="nosotros.php"<?= $pagina_actual === 'nosotros' ? ' aria-current="page"' : '' ?>>Nosotros</a>
          <a href="galeria.php"<?= $pagina_actual === 'galeria' ? ' aria-current="page"' : '' ?>>Galería</a>
          <a class="nav-contact" href="contacto.php"<?= $pagina_actual === 'contacto' ? ' aria-current="page"' : '' ?>>Hablemos <span aria-hidden="true">↗</span></a>
        </nav>
        <button class="theme-toggle" id="theme-toggle" type="button" aria-label="Cambiar modo de color" aria-pressed="false">
          <svg class="theme-icon-sun" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
          </svg>
          <svg class="theme-icon-moon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
          </svg>
          <span id="theme-label">Oscuro</span>
        </button>
        <button class="menu-toggle" type="button" aria-controls="nav-principal" aria-expanded="false" aria-label="Abrir menú de navegación">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </header>

  <main id="contenido">
