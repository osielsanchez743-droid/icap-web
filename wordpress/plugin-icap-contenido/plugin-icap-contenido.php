<?php
/**
 * Plugin Name: ICAP Contenido y Permisos Editoriales
 * Plugin URI:  https://icapmx.com/
 * Description: Registra los tipos de contenido editables de ICAP Ingeniería (Servicios, Galería de Planta y Proyectos), el panel de Datos Globales de Contacto y el rol restringido "Gestor de contenido ICAP".
 * Version:     1.0.0
 * Author:      ICAP Ingeniería
 * Text Domain: icap-contenido
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 1. REGISTRO DE TIPOS DE CONTENIDO PERSONALIZADOS (CPT)
 * Separados del tema para preservar los datos aunque se actualice el diseño.
 */
function icap_registrar_cpts(): void {
    // 1.1 Especialidades / Servicios (Las 4 áreas verificadas)
    register_post_type('icap_servicio', [
        'labels' => [
            'name'               => 'Especialidades ICAP',
            'singular_name'      => 'Especialidad',
            'edit_item'          => 'Editar Especialidad',
            'view_item'          => 'Ver Especialidad',
            'search_items'       => 'Buscar Especialidades',
            'not_found'          => 'No se encontraron especialidades'
        ],
        'public'              => true,
        'has_archive'         => false,
        'menu_icon'           => 'dashicons-hammer',
        'supports'            => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'],
        'show_in_rest'        => true,
        'rewrite'             => ['slug' => 'especialidad']
    ]);

    // 1.2 Elementos de Galería en Planta
    register_post_type('icap_galeria', [
        'labels' => [
            'name'               => 'Galería en Planta',
            'singular_name'      => 'Fotografía de Galería',
            'add_new'            => 'Añadir Fotografía',
            'add_new_item'       => 'Añadir Nueva Fotografía a la Galería',
            'edit_item'          => 'Editar Fotografía de Galería',
            'all_items'          => 'Todas las Fotografías'
        ],
        'public'              => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'menu_icon'           => 'dashicons-format-gallery',
        'supports'            => ['title', 'excerpt', 'thumbnail', 'page-attributes'],
        'show_in_rest'        => true
    ]);

    // 1.3 Proyectos / Casos de Éxito Autorizados
    register_post_type('icap_proyecto', [
        'labels' => [
            'name'               => 'Proyectos ICAP',
            'singular_name'      => 'Proyecto',
            'add_new'            => 'Añadir Proyecto',
            'add_new_item'       => 'Añadir Ficha de Proyecto Autorizado',
            'edit_item'          => 'Editar Proyecto'
        ],
        'public'              => true,
        'has_archive'         => false,
        'menu_icon'           => 'dashicons-portfolio',
        'supports'            => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'],
        'show_in_rest'        => true,
        'rewrite'             => ['slug' => 'proyecto']
    ]);
}
add_action('init', 'icap_registrar_cpts');

/**
 * 2. METABOXES PARA GALERÍA Y SERVICIOS (Sin depender de plugins de terceros)
 */
function icap_agregar_metaboxes(): void {
    add_meta_box(
        'icap_galeria_meta',
        'Ficha Técnica de la Fotografía (Lightbox y Filtros)',
        'icap_render_galeria_metabox',
        'icap_galeria',
        'normal',
        'high'
    );

    add_meta_box(
        'icap_servicio_meta',
        'Especificaciones Técnicas de la Especialidad',
        'icap_render_servicio_metabox',
        'icap_servicio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'icap_agregar_metaboxes');

function icap_render_galeria_metabox(\WP_Post $post): void {
    wp_nonce_field('icap_guardar_galeria_meta', 'icap_galeria_nonce');
    $categoria = get_post_meta($post->ID, '_icap_gal_categoria', true) ?: 'estaciones';
    $area      = get_post_meta($post->ID, '_icap_gal_area', true) ?: 'mecanico';
    $fig       = get_post_meta($post->ID, '_icap_gal_fig', true) ?: 'FIG 01';
    $tags      = get_post_meta($post->ID, '_icap_gal_tags', true) ?: 'MECÁNICO, CONTROL';
    $specs     = get_post_meta($post->ID, '_icap_gal_specs', true) ?: '';
    ?>
    <p>
        <label for="icap_gal_fig"><strong>Código de figura (ej. FIG 01):</strong></label><br>
        <input type="text" id="icap_gal_fig" name="icap_gal_fig" value="<?php echo esc_attr($fig); ?>" class="regular-text">
    </p>
    <p>
        <label for="icap_gal_categoria"><strong>Categoría de filtro en Galería:</strong></label><br>
        <select id="icap_gal_categoria" name="icap_gal_categoria">
            <option value="estaciones" <?php selected($categoria, 'estaciones'); ?>>Estaciones y Ensamble</option>
            <option value="neumatica" <?php selected($categoria, 'neumatica'); ?>>Neumática y Control</option>
            <option value="manufactura" <?php selected($categoria, 'manufactura'); ?>>Manufactura y Planta</option>
        </select>
    </p>
    <p>
        <label for="icap_gal_area"><strong>Área preseleccionada al hacer clic en «Cotizar proyecto similar»:</strong></label><br>
        <select id="icap_gal_area" name="icap_gal_area">
            <option value="mecanico" <?php selected($area, 'mecanico'); ?>>Diseño Mecánico</option>
            <option value="manufactura" <?php selected($area, 'manufactura'); ?>>Manufactura CNC</option>
            <option value="electrico" <?php selected($area, 'electrico'); ?>>Eléctrico / Neumático</option>
            <option value="control" <?php selected($area, 'control'); ?>>Control y Robótica</option>
        </select>
    </p>
    <p>
        <label for="icap_gal_tags"><strong>Etiquetas técnicas separadas por coma (ej. MECÁNICO, ELÉCTRICO, CONTROL):</strong></label><br>
        <input type="text" id="icap_gal_tags" name="icap_gal_tags" value="<?php echo esc_attr($tags); ?>" class="large-text">
    </p>
    <p>
        <label for="icap_gal_specs"><strong>Elementos técnicos observados (1 punto por renglón):</strong></label><br>
        <textarea id="icap_gal_specs" name="icap_gal_specs" rows="4" class="large-text"><?php echo esc_textarea($specs); ?></textarea>
    </p>
    <?php
}

function icap_render_servicio_metabox(\WP_Post $post): void {
    wp_nonce_field('icap_guardar_servicio_meta', 'icap_servicio_nonce');
    $codigo = get_post_meta($post->ID, '_icap_srv_codigo', true) ?: 'MOD-01 // MEC';
    $specs  = get_post_meta($post->ID, '_icap_srv_specs', true) ?: '';
    ?>
    <p>
        <label for="icap_srv_codigo"><strong>Código Técnico (ej. MOD-01 // MEC):</strong></label><br>
        <input type="text" id="icap_srv_codigo" name="icap_srv_codigo" value="<?php echo esc_attr($codigo); ?>" class="regular-text">
    </p>
    <p>
        <label for="icap_srv_specs"><strong>Lista de especificaciones verificadas (1 por renglón):</strong></label><br>
        <textarea id="icap_srv_specs" name="icap_srv_specs" rows="5" class="large-text"><?php echo esc_textarea($specs); ?></textarea>
    </p>
    <?php
}

function icap_guardar_metaboxes(int $post_id): void {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['icap_galeria_nonce']) && wp_verify_nonce((string) $_POST['icap_galeria_nonce'], 'icap_guardar_galeria_meta')) {
        if (current_user_can('edit_post', $post_id)) {
            update_post_meta($post_id, '_icap_gal_fig', sanitize_text_field((string) ($_POST['icap_gal_fig'] ?? 'FIG 01')));
            update_post_meta($post_id, '_icap_gal_categoria', sanitize_key((string) ($_POST['icap_gal_categoria'] ?? 'estaciones')));
            update_post_meta($post_id, '_icap_gal_area', sanitize_key((string) ($_POST['icap_gal_area'] ?? 'mecanico')));
            update_post_meta($post_id, '_icap_gal_tags', sanitize_text_field((string) ($_POST['icap_gal_tags'] ?? '')));
            update_post_meta($post_id, '_icap_gal_specs', sanitize_textarea_field((string) ($_POST['icap_gal_specs'] ?? '')));
        }
    }
    if (isset($_POST['icap_servicio_nonce']) && wp_verify_nonce((string) $_POST['icap_servicio_nonce'], 'icap_guardar_servicio_meta')) {
        if (current_user_can('edit_post', $post_id)) {
            update_post_meta($post_id, '_icap_srv_codigo', sanitize_text_field((string) ($_POST['icap_srv_codigo'] ?? '')));
            update_post_meta($post_id, '_icap_srv_specs', sanitize_textarea_field((string) ($_POST['icap_srv_specs'] ?? '')));
        }
    }
}
add_action('save_post', 'icap_guardar_metaboxes');

/**
 * 3. PANEL DE DATOS GLOBALES DE CONTACTO ICAP (Correo, Teléfono, WhatsApp, Sedes y Redes)
 */
function icap_registrar_menu_contacto(): void {
    add_menu_page(
        'Datos Globales ICAP',
        'Datos ICAP',
        'edit_pages',
        'icap-datos-globales',
        'icap_render_pagina_datos_globales',
        'dashicons-building',
        25
    );
}
add_action('admin_menu', 'icap_registrar_menu_contacto');

function icap_render_pagina_datos_globales(): void {
    if (!current_user_can('edit_pages')) {
        return;
    }

    if (isset($_POST['icap_datos_nonce']) && wp_verify_nonce((string) $_POST['icap_datos_nonce'], 'icap_guardar_datos_globales')) {
        update_option('icap_correo', sanitize_email((string) ($_POST['icap_correo'] ?? 'julio.dejesus@icapmx.com')));
        update_option('icap_telefono_visible', sanitize_text_field((string) ($_POST['icap_telefono_visible'] ?? '+52 (446) 213 6128')));
        update_option('icap_telefono_enlace', sanitize_text_field((string) ($_POST['icap_telefono_enlace'] ?? '+524462136128')));
        update_option('icap_whatsapp_numero', preg_replace('/\D+/', '', (string) ($_POST['icap_whatsapp_numero'] ?? '524462136128')));
        update_option('icap_direccion_marques', sanitize_textarea_field((string) ($_POST['icap_direccion_marques'] ?? '')));
        update_option('icap_direccion_escobedo', sanitize_textarea_field((string) ($_POST['icap_direccion_escobedo'] ?? '')));
        update_option('icap_url_linkedin', esc_url_raw((string) ($_POST['icap_url_linkedin'] ?? '')));
        update_option('icap_url_youtube', esc_url_raw((string) ($_POST['icap_url_youtube'] ?? '')));
        update_option('icap_url_facebook', esc_url_raw((string) ($_POST['icap_url_facebook'] ?? '')));
        echo '<div class="notice notice-success is-dismissible"><p><strong>✓ Datos globales de ICAP actualizados correctamente.</strong></p></div>';
    }

    $correo       = get_option('icap_correo', 'julio.dejesus@icapmx.com');
    $tel_visible  = get_option('icap_telefono_visible', '+52 (446) 213 6128');
    $tel_enlace   = get_option('icap_telefono_enlace', '+524462136128');
    $wa_num       = get_option('icap_whatsapp_numero', '524462136128');
    $dir_marques  = get_option('icap_direccion_marques', 'Carretera Estatal 431, El Colorado-Galindo, Km 1.9. Condominio Industrial EUROPARK II, Bodega 5A, C.P. 76246, El Marqués, Qro.');
    $dir_escobedo = get_option('icap_direccion_escobedo', 'Planta de manufactura, maquinado CNC y convencional. Pedro Escobedo, Querétaro, México (20.490902, -100.185883).');
    $linkedin     = get_option('icap_url_linkedin', 'https://mx.linkedin.com/company/icap-ingenier%C3%ADa-mx');
    $youtube      = get_option('icap_url_youtube', 'https://www.youtube.com/@icapmx9679');
    $facebook     = get_option('icap_url_facebook', 'https://www.facebook.com/ICAP.Queretaro/');
    ?>
    <div class="wrap">
        <h1>Datos Globales de Contacto y Sedes — ICAP Ingeniería</h1>
        <p>Los datos modificados aquí se actualizan automáticamente en la cabecera, página de Contacto, botones de WhatsApp y pie de página de todo el sitio.</p>
        <form method="post">
            <?php wp_nonce_field('icap_guardar_datos_globales', 'icap_datos_nonce'); ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="icap_correo">Correo electrónico oficial</label></th>
                    <td><input type="email" id="icap_correo" name="icap_correo" value="<?php echo esc_attr($correo); ?>" class="regular-text" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="icap_telefono_visible">Teléfono visible</label></th>
                    <td><input type="text" id="icap_telefono_visible" name="icap_telefono_visible" value="<?php echo esc_attr($tel_visible); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="icap_telefono_enlace">Teléfono para llamadas (formato +52...)</label></th>
                    <td><input type="text" id="icap_telefono_enlace" name="icap_telefono_enlace" value="<?php echo esc_attr($tel_enlace); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="icap_whatsapp_numero">Número de WhatsApp (solo dígitos con lada 52)</label></th>
                    <td><input type="text" id="icap_whatsapp_numero" name="icap_whatsapp_numero" value="<?php echo esc_attr($wa_num); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="icap_direccion_marques">Dirección Sede 01 (El Marqués — EUROPARK II)</label></th>
                    <td><textarea id="icap_direccion_marques" name="icap_direccion_marques" rows="3" class="large-text"><?php echo esc_textarea($dir_marques); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="icap_direccion_escobedo">Dirección Sede 02 (Pedro Escobedo — Maquinados)</label></th>
                    <td><textarea id="icap_direccion_escobedo" name="icap_direccion_escobedo" rows="3" class="large-text"><?php echo esc_textarea($dir_escobedo); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="icap_url_linkedin">Enlace oficial de LinkedIn</label></th>
                    <td><input type="url" id="icap_url_linkedin" name="icap_url_linkedin" value="<?php echo esc_url($linkedin); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="icap_url_youtube">Enlace oficial de YouTube</label></th>
                    <td><input type="url" id="icap_url_youtube" name="icap_url_youtube" value="<?php echo esc_url($youtube); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="icap_url_facebook">Enlace oficial de Facebook</label></th>
                    <td><input type="url" id="icap_url_facebook" name="icap_url_facebook" value="<?php echo esc_url($facebook); ?>" class="large-text"></td>
                </tr>
            </table>
            <?php submit_button('Guardar Datos de ICAP'); ?>
        </form>
    </div>
    <?php
}

/**
 * 4. ROL RESTRINGIDO: "Gestor de contenido ICAP" (gestor_icap)
 * Permite editar textos, fotografías, galería y servicios sin tocar temas, plugins ni código.
 */
function icap_activar_rol_gestor(): void {
    remove_role('gestor_icap');
    add_role('gestor_icap', 'Gestor de contenido ICAP', [
        'read'                   => true,
        'upload_files'           => true,
        'edit_posts'             => true,
        'edit_others_posts'      => true,
        'edit_published_posts'   => true,
        'publish_posts'          => true,
        'delete_posts'           => true,
        'delete_published_posts' => true,
        'edit_pages'             => true,
        'edit_others_pages'      => true,
        'edit_published_pages'   => true,
        // Explícitamente sin permisos de arquitectura ni código:
        'switch_themes'          => false,
        'edit_theme_options'     => false,
        'install_themes'         => false,
        'activate_plugins'       => false,
        'install_plugins'        => false,
        'edit_files'             => false,
        'manage_options'         => false,
        'create_users'           => false
    ]);
}
register_activation_hook(__FILE__, 'icap_activar_rol_gestor');
add_action('init', function (): void {
    if (!get_role('gestor_icap')) {
        icap_activar_rol_gestor();
    }
});

/**
 * Limpiar menús innecesarios cuando ingresa el rol "Gestor de contenido ICAP"
 */
function icap_limpiar_menu_gestor(): void {
    $user = wp_get_current_user();
    if (in_array('gestor_icap', (array) $user->roles, true)) {
        remove_menu_page('edit.php');          // Entradas de blog no usadas
        remove_menu_page('edit-comments.php'); // Comentarios desactivados
        remove_menu_page('tools.php');         // Herramientas técnicas
    }
}
add_action('admin_menu', 'icap_limpiar_menu_gestor', 999);
