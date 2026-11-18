<?php
declare(strict_types=1);

/**
 * FunciÃ³n auxiliar para escapar salidas HTML de forma segura.
 * Equivalente en WordPress: esc_html() / esc_attr()
 */
function icap_esc(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

/**
 * Datos oficiales verificados de ICAP IngenierÃ­a (https://icapmx.com/)
 */
$icap_contacto = [
    'nombre_marca'     => 'ICAP IngenierÃ­a',
    'razon_descriptiva'=> 'InstrumentaciÃ³n, Control y AutomatizaciÃ³n de Procesos.',
    'fundacion'        => '2016',
    'correo'           => 'julio.dejesus@icapmx.com',
    'gmail_compose'    => 'https://mail.google.com/mail/?view=cm&fs=1&to=julio.dejesus@icapmx.com&su=Consulta%20-%20ICAP%20Ingenier%C3%ADa',
    'outlook_compose'  => 'https://outlook.office.com/mail/deeplink/compose?to=julio.dejesus@icapmx.com&subject=Consulta%20-%20ICAP%20Ingenier%C3%ADa',
    'telefono_visible' => '+52 (446) 213 6128',
    'telefono_enlace'  => '+524462136128',
    'whatsapp_numero'  => '524462136128',
    'whatsapp_enlace'  => 'https://wa.me/524462136128?text=Hola%20ICAP%20Ingenier%C3%ADa%2C%20me%20gustar%C3%ADa%20solicitar%20informaci%C3%B3n.',
    'maps_principal'   => 'https://www.google.com.mx/maps/place/ICAP+Ingenier%C3%ADa+S.A.+DE+C.V./@20.5585749,-100.2714363,17z/data=!3m1!4b1!4m6!3m5!1s0x85d3436eb595a12f:0x61336c6be2883009!8m2!3d20.5585749!4d-100.2688614!16s%2Fg%2F11tf3g4ls_?entry=ttu',
    'redes'            => [
        'linkedin' => [
            'nombre' => 'LinkedIn',
            'handle' => 'ICAP IngenierÃ­a MX',
            'url'    => 'https://mx.linkedin.com/company/icap-ingenier%C3%ADa-mx'
        ],
        'youtube'  => [
            'nombre' => 'YouTube',
            'handle' => '@icapmx9679',
            'url'    => 'https://www.youtube.com/@icapmx9679'
        ],
        'facebook' => [
            'nombre' => 'Facebook',
            'handle' => 'ICAP.Queretaro',
            'url'    => 'https://www.facebook.com/ICAP.Queretaro/'
        ],
        'whatsapp' => [
            'nombre' => 'WhatsApp',
            'handle' => '+52 (446) 213 6128',
            'url'    => 'https://wa.me/524462136128?text=Hola%20ICAP%20Ingenier%C3%ADa%2C%20me%20gustar%C3%ADa%20solicitar%20informaci%C3%B3n.'
        ]
    ],
    'sedes'            => [
        [
            'id'          => 'sede-marques',
            'codigo'      => 'EL MARQUÃ‰S, QRO.',
            'titulo_corto'=> 'Oficinas Principales y Ãrea de Ensamble',
            'titulo'      => 'Oficinas Principales y Ãrea de Ensamble',
            'descripcion' => 'Oficinas principales y Ã¡rea de ensamble de estaciones de trabajo.',
            'direccion'   => 'Carretera Estatal 431, El Colorado-Galindo, Km 1.9. Condominio Industrial EUROPARK II, Bodega 5A, C.P. 76246, El MarquÃ©s, Qro.',
            'coordenadas' => 'El MarquÃ©s, QuerÃ©taro Â· EUROPARK II, Bodega 5A',
            'maps_url'    => 'https://www.google.com.mx/maps/place/ICAP+Ingenier%C3%ADa+S.A.+DE+C.V./@20.5585749,-100.2714363,17z/data=!3m1!4b1!4m6!3m5!1s0x85d3436eb595a12f:0x61336c6be2883009!8m2!3d20.5585749!4d-100.2688614!16s%2Fg%2F11tf3g4ls_?entry=ttu',
            'embed_url'   => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3736.1357!2d-100.2688614!3d20.5585749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d3436eb595a12f%3A0x61336c6be2883009!2sICAP%20Ingenier%C3%ADa%20S.A.%20DE%20C.V.!5e0!3m2!1ses-419!2smx',
            'imagen'      => get_template_directory_uri() . '/assets/IngenieriaMecanica.webp',
            'alt'         => 'Oficinas y nave de ensamble de ICAP en El MarquÃ©s'
        ],
        [
            'id'          => 'sede-escobedo',
            'codigo'      => 'PEDRO ESCOBEDO, QRO.',
            'titulo_corto'=> 'Taller de Maquinados',
            'titulo'      => 'Taller de Maquinados',
            'descripcion' => 'Taller de maquinados para procesamiento de materias primas y fabricaciÃ³n de piezas.',
            'direccion'   => 'Pedro Escobedo, QuerÃ©taro, MÃ©xico.',
            'coordenadas' => 'Pedro Escobedo, QuerÃ©taro',
            'maps_url'    => 'https://maps.app.goo.gl/5oitKRzF3EB1td4q7',
            'embed_url'   => 'https://maps.google.com/maps?q=20.490902,-100.185883&t=&z=17&ie=UTF8&iwloc=&output=embed',
            'imagen'      => get_template_directory_uri() . '/assets/IngenieriaAutomatizacion.webp',
            'alt'         => 'Taller de maquinados de ICAP en Pedro Escobedo'
        ]
    ]
];

$icap_sectores = [
    'Automotriz',
    'AeronÃ¡utico',
    'Alimenticio',
    'FarmacÃ©utico',
    'Servicios'
];

$icap_servicios = [
    [
        'id'          => 'mecanico',
        'codigo'      => '01',
        'badge'       => '01 Â· ESPECIALIDAD',
        'indice'      => '01 Â· DiseÃ±o MecÃ¡nico',
        'titulo'      => 'DiseÃ±o MecÃ¡nico',
        'resumen'     => 'DiseÃ±o de piezas, componentes y sistemas de naturaleza mecÃ¡nica.',
        'descripcion' => 'CreaciÃ³n y desarrollo de estaciones de trabajo manuales, semiautomÃ¡ticas y automÃ¡ticas, asÃ­ como manufactura de piezas metÃ¡licas y plÃ¡sticas.',
        'especificaciones' => [
            'DiseÃ±o de elemento finito',
            'DiseÃ±o de estaciones de trabajo',
            'SelecciÃ³n de materiales',
            'Modelo matemÃ¡tico 3D'
        ],
        'imagen'      => get_template_directory_uri() . '/assets/IngenieriaMecanica.webp',
        'alt'         => 'Ãrea de diseÃ±o mecÃ¡nico y estaciones de trabajo en ICAP',
        'svg'         => '<path d="M12 2L3 7l9 5 9-5-9-5z"/><path d="M3 17l9 5 9-5"/><path d="M3 12l9 5 9-5"/>'
    ],
    [
        'id'          => 'manufactura',
        'codigo'      => '02',
        'badge'       => '02 Â· ESPECIALIDAD',
        'indice'      => '02 Â· Manufactura',
        'titulo'      => 'Manufactura',
        'resumen'     => 'FabricaciÃ³n y desarrollo de soluciones para procesos industriales.',
        'descripcion' => 'Procesamiento de materias primas y fabricaciÃ³n de piezas metÃ¡licas y no metÃ¡licas.',
        'especificaciones' => [
            'Torno y fresa convencional',
            'Maquinado CNC',
            'Soldadura (MIG y Arco)',
            'Rectificado plano y cilÃ­ndrico'
        ],
        'imagen'      => get_template_directory_uri() . '/assets/IngenieriaAutomatizacion.webp',
        'alt'         => 'Taller de maquinados de ICAP',
        'svg'         => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c.26.6.77 1.05 1.51 1H21a2 2 0 1 1 0 4h-.09c-.74.05-1.25.4-1.51 1z"/>'
    ],
    [
        'id'          => 'electrico',
        'codigo'      => '03',
        'badge'       => '03 Â· ESPECIALIDAD',
        'indice'      => '03 Â· ElÃ©ctrico / NeumÃ¡tico',
        'titulo'      => 'ElÃ©ctrico / NeumÃ¡tico',
        'resumen'     => 'IntegraciÃ³n elÃ©ctrica y neumÃ¡tica para equipos y estaciones de trabajo.',
        'descripcion' => 'DiseÃ±o, planificaciÃ³n e integraciÃ³n de sistemas elÃ©ctricos y neumÃ¡ticos para la industria.',
        'especificaciones' => [
            'DiseÃ±o elÃ©ctrico',
            'Armado de gabinetes de control',
            'DiseÃ±o neumÃ¡tico',
            'SelecciÃ³n de pruebas neumÃ¡ticas'
        ],
        'imagen'      => get_template_directory_uri() . '/assets/IngenieriaManufactura.webp',
        'alt'         => 'IntegraciÃ³n neumÃ¡tica y elÃ©ctrica en equipo ICAP',
        'svg'         => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M9 8h6"/><path d="M9 12h6"/><path d="M11 16h2"/>'
    ],
    [
        'id'          => 'control',
        'codigo'      => '04',
        'badge'       => '04 Â· ESPECIALIDAD',
        'indice'      => '04 Â· Control',
        'titulo'      => 'Control',
        'resumen'     => 'Soluciones de control para la automatizaciÃ³n de procesos.',
        'descripcion' => 'IntegraciÃ³n de sistemas de hardware y software para la automatizaciÃ³n de procesos industriales.',
        'especificaciones' => [
            'IntegraciÃ³n de sistemas de hardware y software',
            'ProgramaciÃ³n de PLC',
            'ProgramaciÃ³n de Cobot y Robot'
        ],
        'imagen'      => get_template_directory_uri() . '/assets/taller.webp',
        'alt'         => 'Estaciones automatizadas y control en ICAP',
        'svg'         => '<rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><path d="M10 17.5h4a2 2 0 0 0 2-2V10"/><circle cx="6.5" cy="7.5" r="2.5"/><path d="M6.5 10v4"/>'
    ]
];

$icap_plataformas = [
    'plc' => [
        'titulo' => 'ProgramaciÃ³n de PLC',
        'marcas' => ['Allen-Bradley', 'Siemens', 'Mitsubishi', 'Schneider', 'Omron', 'Keyence']
    ],
    'robots' => [
        'titulo' => 'ProgramaciÃ³n de Cobot y Robot',
        'marcas' => ['StÃ¤ubli', 'Fanuc', 'Doosan', 'Universal Robots', 'Yaskawa', 'ABB']
    ]
];

$icap_filosofia = [
    [
        'indice' => '01 Â· MISIÃ“N',
        'titulo' => 'MisiÃ³n',
        'texto'  => 'Desarrollar soluciones a la medida de cada cliente, reconociendo que cada necesidad es diferente, e integrar nuestras fortalezas tÃ©cnicas para encontrar las mejores respuestas a los problemas de la industria.'
    ],
    [
        'indice' => '02 Â· VISIÃ“N',
        'titulo' => 'VisiÃ³n',
        'texto'  => 'Ser una empresa 100% mexicana lÃ­der en el Ã¡rea de automatizaciÃ³n de procesos e innovaciÃ³n tecnolÃ³gica, ofreciendo soluciones integrales a nivel nacional e internacional.'
    ],
    [
        'indice' => '03 Â· POLÃTICA DE CALIDAD',
        'titulo' => 'PolÃ­tica de Calidad',
        'texto'  => 'Operar en estricto cumplimiento de los requisitos de nuestros clientes, estÃ¡ndares de calidad y normativas legales a lo largo de nuestra cadena de valor, buscando satisfacer las necesidades de nuestras partes interesadas mediante la mejora continua, la seguridad y el bienestar de nuestro equipo humano.'
    ]
];

$icap_galeria = [
    [
        'src'       => get_template_directory_uri() . '/assets/taller.webp',
        'alt'       => 'LÃ­nea de estaciones automatizadas con estructuras de aluminio y paneles de control',
        'titulo'    => 'Estaciones de trabajo',
        'categoria' => 'estaciones',
        'contador'  => '01 / 06',
        'destacada' => true
    ],
    [
        'src'       => get_template_directory_uri() . '/assets/IngenieriaManufactura.webp',
        'alt'       => 'Detalle de equipo industrial con componentes neumÃ¡ticos',
        'titulo'    => 'IntegraciÃ³n industrial',
        'categoria' => 'neumatica',
        'contador'  => '02 / 06',
        'destacada' => true
    ],
    [
        'src'       => get_template_directory_uri() . '/assets/galeria-5.webp',
        'alt'       => 'Banda transportadora industrial fotografiada en taller',
        'titulo'    => 'Equipo de proceso',
        'categoria' => 'estaciones',
        'contador'  => '03 / 06',
        'destacada' => true
    ],
    [
        'src'       => get_template_directory_uri() . '/assets/galeria-6.webp',
        'alt'       => 'EstaciÃ³n industrial con resguardo transparente y conexiones neumÃ¡ticas',
        'titulo'    => 'Detalle de estaciÃ³n',
        'categoria' => 'neumatica',
        'contador'  => '04 / 06',
        'destacada' => true
    ],
    [
        'src'       => get_template_directory_uri() . '/assets/IngenieriaMecanica.webp',
        'alt'       => 'Nave de ingenierÃ­a y Ã¡rea de ensamble de ICAP IngenierÃ­a',
        'titulo'    => 'Ãrea de ensamble',
        'categoria' => 'manufactura',
        'contador'  => '05 / 06',
        'destacada' => false
    ],
    [
        'src'       => get_template_directory_uri() . '/assets/IngenieriaAutomatizacion.webp',
        'alt'       => 'Ãrea de maquinados de ICAP con equipo y personal en operaciÃ³n',
        'titulo'    => 'Taller de maquinados',
        'categoria' => 'manufactura',
        'contador'  => '06 / 06',
        'destacada' => false
    ]
];

$icap_faqs = [
    [
        'codigo'    => '01',
        'pregunta'  => 'Â¿QuÃ© Ã¡reas de ingenierÃ­a y automatizaciÃ³n abarca ICAP?',
        'respuesta' => 'Integramos cuatro especialidades principales: DiseÃ±o MecÃ¡nico (estaciones de trabajo, elemento finito, modelado 3D y selecciÃ³n de materiales), Manufactura (maquinado CNC, torno y fresa convencional, soldadura MIG/Arco y rectificado), Sistemas ElÃ©ctricos / NeumÃ¡ticos y Control (integraciÃ³n de hardware/software y programaciÃ³n de PLC y robots).'
    ],
    [
        'codigo'    => '02',
        'pregunta'  => 'Â¿QuÃ© marcas de PLC, robots y cobots programan e integran?',
        'respuesta' => 'En programaciÃ³n de PLC trabajamos con Allen-Bradley, Siemens, Mitsubishi, Schneider, Omron y Keyence. En programaciÃ³n de cobots y robots industriales trabajamos con StÃ¤ubli, Fanuc, Doosan, Universal Robots, Yaskawa y ABB.'
    ],
    [
        'codigo'    => '03',
        'pregunta'  => 'Â¿A quÃ© sectores industriales atienden?',
        'respuesta' => 'Desarrollamos soluciones a medida y estaciones de trabajo manuales, semiautomÃ¡ticas y automÃ¡ticas para los sectores automotriz, aeronÃ¡utico, alimenticio, farmacÃ©utico y de servicios.'
    ],
    [
        'codigo'    => '04',
        'pregunta'  => 'Â¿DÃ³nde se encuentran ubicadas sus instalaciones?',
        'respuesta' => 'Contamos con oficinas principales y Ã¡rea de ensamble en El MarquÃ©s (Condominio Industrial EUROPARK II, Bodega 5A), asÃ­ como nuestro taller de maquinados en Pedro Escobedo, QuerÃ©taro.'
    ]
];

if (function_exists('get_option')) {
    $icap_contacto['correo']           = get_option('icap_correo', $icap_contacto['correo']);
    $icap_contacto['telefono_visible'] = get_option('icap_telefono_visible', $icap_contacto['telefono_visible']);
    $icap_contacto['telefono_enlace']  = get_option('icap_telefono_enlace', $icap_contacto['telefono_enlace']);
    $icap_contacto['whatsapp_numero']  = get_option('icap_whatsapp_numero', $icap_contacto['whatsapp_numero']);
    $icap_contacto['whatsapp_enlace']  = 'https://wa.me/' . $icap_contacto['whatsapp_numero'] . '?text=Hola%20ICAP%20Ingenier%C3%ADa%2C%20me%20gustar%C3%ADa%20solicitar%20informaci%C3%B3n.';
    $icap_contacto['gmail_compose']    = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . rawurlencode($icap_contacto['correo']) . '&su=Consulta%20-%20ICAP%20Ingenier%C3%ADa';
    $icap_contacto['outlook_compose']  = 'https://outlook.office.com/mail/deeplink/compose?to=' . rawurlencode($icap_contacto['correo']) . '&subject=Consulta%20-%20ICAP%20Ingenier%C3%ADa';
    $icap_contacto['sedes'][0]['direccion'] = get_option('icap_direccion_marques', $icap_contacto['sedes'][0]['direccion']);
    $icap_contacto['sedes'][1]['direccion'] = get_option('icap_direccion_escobedo', $icap_contacto['sedes'][1]['direccion']);
    $icap_contacto['redes']['linkedin']['url'] = get_option('icap_url_linkedin', $icap_contacto['redes']['linkedin']['url']);
    $icap_contacto['redes']['youtube']['url']  = get_option('icap_url_youtube', $icap_contacto['redes']['youtube']['url']);
    $icap_contacto['redes']['facebook']['url'] = get_option('icap_url_facebook', $icap_contacto['redes']['facebook']['url']);
}

if (function_exists('get_posts')) {
    $posts_galeria = get_posts([
        'post_type'      => 'icap_galeria',
        'post_status'    => 'publish',
        'posts_per_page' => 30,
        'orderby'        => ['menu_order' => 'ASC', 'date' => 'ASC']
    ]);
    if (!empty($posts_galeria)) {
        $galeria_dinamica = [];
        $total_fotos = count($posts_galeria);
        foreach ($posts_galeria as $idx => $p_gal) {
            $img_url = get_the_post_thumbnail_url($p_gal->ID, 'full') ?: (get_template_directory_uri() . '/assets/taller.webp');
            $thumb_id = get_post_thumbnail_id($p_gal->ID);
            $alt_txt = $thumb_id ? (string) get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
            if ($alt_txt === '') {
                $alt_txt = $p_gal->post_title;
            }
            $num_str = str_pad((string) ($idx + 1), 2, '0', STR_PAD_LEFT);
            $tot_str = str_pad((string) $total_fotos, 2, '0', STR_PAD_LEFT);
            $galeria_dinamica[] = [
                'src'       => $img_url,
                'alt'       => $alt_txt,
                'titulo'    => $p_gal->post_title,
                'categoria' => (string) (get_post_meta($p_gal->ID, '_icap_gal_categoria', true) ?: 'estaciones'),
                'contador'  => $num_str . ' / ' . $tot_str,
                'destacada' => ($idx < 4)
            ];
        }
        $icap_galeria = $galeria_dinamica;
    }
}

function icap_obtener_galeria_js(): array {
    global $icap_galeria;
    $items = [];
    foreach ($icap_galeria as $f) {
        $items[] = [
            'src'   => $f['src'],
            'alt'   => $f['alt'],
            'title' => $f['titulo'],
            'count' => $f['contador']
        ];
    }
    return $items;
}