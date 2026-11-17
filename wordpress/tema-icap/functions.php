<?php
/**
 * Funciones principales del tema ICAP Ingeniería Industrial
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/inc/datos-default.php';

/**
 * 1. CONFIGURACIÓN DEL TEMA
 */
function icap_theme_setup(): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);

    register_nav_menus([
        'menu-principal' => 'Navegación Principal ICAP'
    ]);
}
add_action('after_setup_theme', 'icap_theme_setup');

/**
 * 2. CARGA DE ESTILOS MODULARES Y SCRIPTS
 */
function icap_enqueue_assets(): void {
    $theme_version = wp_get_theme()->get('Version') ?: '1.0.0';
    $theme_uri     = get_template_directory_uri();

    wp_enqueue_style(
        'icap-main-style',
        get_stylesheet_uri(),
        [],
        $theme_version
    );

    wp_enqueue_script(
        'icap-main-script',
        $theme_uri . '/assets/js/script.js',
        [],
        $theme_version,
        true
    );

    // Pasar la URL base del tema y de contacto a JavaScript para la galería y el visor CAD
    wp_localize_script('icap-main-script', 'ICAP_WP_CONFIG', [
        'themeUri'   => trailingslashit($theme_uri),
        'contactUrl' => home_url('/contacto/'),
        'gallery'    => icap_obtener_galeria_js()
    ]);
}
add_action('wp_enqueue_scripts', 'icap_enqueue_assets');

/**
 * 3. CREACIÓN AUTOMÁTICA DE PÁGINAS BASE AL ACTIVAR EL TEMA
 */
function icap_crear_paginas_base(): void {
    $paginas = [
        'inicio'    => ['titulo' => 'Inicio',    'plantilla' => ''],
        'servicios' => ['titulo' => 'Servicios', 'plantilla' => 'page-servicios.php'],
        'nosotros'  => ['titulo' => 'Nosotros',  'plantilla' => 'page-nosotros.php'],
        'galeria'   => ['titulo' => 'Galería',   'plantilla' => 'page-galeria.php'],
        'contacto'  => ['titulo' => 'Contacto',  'plantilla' => 'page-contacto.php']
    ];

    $inicio_id = 0;
    foreach ($paginas as $slug => $info) {
        $existente = get_page_by_path($slug);
        if (!$existente) {
            $page_id = wp_insert_post([
                'post_title'   => $info['titulo'],
                'post_name'    => $slug,
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => ''
            ]);
        } else {
            $page_id = $existente->ID;
        }

        if ($info['plantilla'] !== '' && $page_id > 0) {
            update_post_meta($page_id, '_wp_page_template', $info['plantilla']);
        }
        if ($slug === 'inicio') {
            $inicio_id = (int) $page_id;
        }
    }

    if ($inicio_id > 0) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $inicio_id);
    }
}
add_action('after_switch_theme', 'icap_crear_paginas_base');

/**
 * 4. REDIRECCIONES 301 DE RUTAS HEREDADAS DEL SITIO ANTERIOR EN ASP.NET
 */
function icap_redirecciones_legado(): void {
    if (is_admin()) {
        return;
    }
    $path = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    $mapa_legado = [
        'Nosotros'             => '/nosotros/',
        'Servicios-Proyectos'  => '/servicios/',
        'Mecanico'             => '/servicios/#mecanico',
        'Manufactura'          => '/servicios/#manufactura',
        'Electrico'            => '/servicios/#electrico',
        'Control'              => '/servicios/#control',
        'contactanos/Contacto' => '/contacto/'
    ];

    foreach ($mapa_legado as $ruta_vieja => $destino) {
        if (strcasecmp($path, $ruta_vieja) === 0) {
            wp_safe_redirect(home_url($destino), 301);
            exit;
        }
    }
}
add_action('template_redirect', 'icap_redirecciones_legado');
