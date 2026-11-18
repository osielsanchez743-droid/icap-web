<?php
declare(strict_types=1);

/**
 * Función auxiliar para escapar salidas HTML de forma segura.
 * Equivalente en WordPress: esc_html() / esc_attr()
 */
function icap_esc(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

/**
 * Datos oficiales verificados de ICAP Ingeniería (https://icapmx.com/)
 */
$icap_contacto = [
    'nombre_marca'     => 'ICAP Ingeniería',
    'razon_descriptiva'=> 'Instrumentación, Control y Automatización de Procesos.',
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
            'handle' => 'ICAP Ingeniería MX',
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
            'codigo'      => 'EL MARQUÉS, QRO.',
            'titulo_corto'=> 'Oficinas Principales y Área de Ensamble',
            'titulo'      => 'Oficinas Principales y Área de Ensamble',
            'descripcion' => 'Oficinas principales y área de ensamble de estaciones de trabajo.',
            'direccion'   => 'Carretera Estatal 431, El Colorado-Galindo, Km 1.9. Condominio Industrial EUROPARK II, Bodega 5A, C.P. 76246, El Marqués, Qro.',
            'coordenadas' => 'El Marqués, Querétaro · EUROPARK II, Bodega 5A',
            'maps_url'    => 'https://www.google.com.mx/maps/place/ICAP+Ingenier%C3%ADa+S.A.+DE+C.V./@20.5585749,-100.2714363,17z/data=!3m1!4b1!4m6!3m5!1s0x85d3436eb595a12f:0x61336c6be2883009!8m2!3d20.5585749!4d-100.2688614!16s%2Fg%2F11tf3g4ls_?entry=ttu',
            'embed_url'   => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3736.1357!2d-100.2688614!3d20.5585749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d3436eb595a12f%3A0x61336c6be2883009!2sICAP%20Ingenier%C3%ADa%20S.A.%20DE%20C.V.!5e0!3m2!1ses-419!2smx',
            'imagen'      => 'assets/img/IngenieriaMecanica.webp',
            'alt'         => 'Oficinas y nave de ensamble de ICAP en El Marqués'
        ],
        [
            'id'          => 'sede-escobedo',
            'codigo'      => 'PEDRO ESCOBEDO, QRO.',
            'titulo_corto'=> 'Taller de Maquinados',
            'titulo'      => 'Taller de Maquinados',
            'descripcion' => 'Taller de maquinados para procesamiento de materias primas y fabricación de piezas.',
            'direccion'   => 'Pedro Escobedo, Querétaro, México.',
            'coordenadas' => 'Pedro Escobedo, Querétaro',
            'maps_url'    => 'https://maps.app.goo.gl/5oitKRzF3EB1td4q7',
            'embed_url'   => 'https://maps.google.com/maps?q=20.490902,-100.185883&t=&z=17&ie=UTF8&iwloc=&output=embed',
            'imagen'      => 'assets/img/IngenieriaAutomatizacion.webp',
            'alt'         => 'Taller de maquinados de ICAP en Pedro Escobedo'
        ]
    ]
];

$icap_sectores = [
    'Automotriz',
    'Aeronáutico',
    'Alimenticio',
    'Farmacéutico',
    'Servicios'
];

$icap_servicios = [
    [
        'id'          => 'mecanico',
        'codigo'      => '01',
        'badge'       => '01 · ESPECIALIDAD',
        'indice'      => '01 · Diseño Mecánico',
        'titulo'      => 'Diseño Mecánico',
        'resumen'     => 'Diseño de piezas, componentes y sistemas de naturaleza mecánica.',
        'descripcion' => 'Creación y desarrollo de estaciones de trabajo manuales, semiautomáticas y automáticas, así como manufactura de piezas metálicas y plásticas.',
        'especificaciones' => [
            'Diseño de elemento finito',
            'Diseño de estaciones de trabajo',
            'Selección de materiales',
            'Modelo matemático 3D'
        ],
        'imagen'      => 'assets/img/IngenieriaMecanica.webp',
        'alt'         => 'Área de diseño mecánico y estaciones de trabajo en ICAP',
        'svg'         => '<path d="M12 2L3 7l9 5 9-5-9-5z"/><path d="M3 17l9 5 9-5"/><path d="M3 12l9 5 9-5"/>'
    ],
    [
        'id'          => 'manufactura',
        'codigo'      => '02',
        'badge'       => '02 · ESPECIALIDAD',
        'indice'      => '02 · Manufactura',
        'titulo'      => 'Manufactura',
        'resumen'     => 'Fabricación y desarrollo de soluciones para procesos industriales.',
        'descripcion' => 'Procesamiento de materias primas y fabricación de piezas metálicas y no metálicas.',
        'especificaciones' => [
            'Torno y fresa convencional',
            'Maquinado CNC',
            'Soldadura (MIG y Arco)',
            'Rectificado plano y cilíndrico'
        ],
        'imagen'      => 'assets/img/IngenieriaAutomatizacion.webp',
        'alt'         => 'Taller de maquinados de ICAP',
        'svg'         => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c.26.6.77 1.05 1.51 1H21a2 2 0 1 1 0 4h-.09c-.74.05-1.25.4-1.51 1z"/>'
    ],
    [
        'id'          => 'electrico',
        'codigo'      => '03',
        'badge'       => '03 · ESPECIALIDAD',
        'indice'      => '03 · Eléctrico / Neumático',
        'titulo'      => 'Eléctrico / Neumático',
        'resumen'     => 'Integración eléctrica y neumática para equipos y estaciones de trabajo.',
        'descripcion' => 'Diseño, planificación e integración de sistemas eléctricos y neumáticos para la industria.',
        'especificaciones' => [
            'Diseño eléctrico',
            'Armado de gabinetes de control',
            'Diseño neumático',
            'Selección de pruebas neumáticas'
        ],
        'imagen'      => 'assets/img/IngenieriaManufactura.webp',
        'alt'         => 'Integración neumática y eléctrica en equipo ICAP',
        'svg'         => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M9 8h6"/><path d="M9 12h6"/><path d="M11 16h2"/>'
    ],
    [
        'id'          => 'control',
        'codigo'      => '04',
        'badge'       => '04 · ESPECIALIDAD',
        'indice'      => '04 · Control',
        'titulo'      => 'Control',
        'resumen'     => 'Soluciones de control para la automatización de procesos.',
        'descripcion' => 'Integración de sistemas de hardware y software para la automatización de procesos industriales.',
        'especificaciones' => [
            'Integración de sistemas de hardware y software',
            'Programación de PLC',
            'Programación de Cobot y Robot'
        ],
        'imagen'      => 'assets/img/taller.webp',
        'alt'         => 'Estaciones automatizadas y control en ICAP',
        'svg'         => '<rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><path d="M10 17.5h4a2 2 0 0 0 2-2V10"/><circle cx="6.5" cy="7.5" r="2.5"/><path d="M6.5 10v4"/>'
    ]
];

$icap_plataformas = [
    'plc' => [
        'titulo' => 'Programación de PLC',
        'marcas' => ['Allen-Bradley', 'Siemens', 'Mitsubishi', 'Schneider', 'Omron', 'Keyence']
    ],
    'robots' => [
        'titulo' => 'Programación de Cobot y Robot',
        'marcas' => ['Stäubli', 'Fanuc', 'Doosan', 'Universal Robots', 'Yaskawa', 'ABB']
    ]
];

$icap_filosofia = [
    [
        'indice' => '01 · MISIÓN',
        'titulo' => 'Misión',
        'texto'  => 'Desarrollar soluciones a la medida de cada cliente, reconociendo que cada necesidad es diferente, e integrar nuestras fortalezas técnicas para encontrar las mejores respuestas a los problemas de la industria.'
    ],
    [
        'indice' => '02 · VISIÓN',
        'titulo' => 'Visión',
        'texto'  => 'Ser una empresa 100% mexicana líder en el área de automatización de procesos e innovación tecnológica, ofreciendo soluciones integrales a nivel nacional e internacional.'
    ],
    [
        'indice' => '03 · POLÍTICA DE CALIDAD',
        'titulo' => 'Política de Calidad',
        'texto'  => 'Operar en estricto cumplimiento de los requisitos de nuestros clientes, estándares de calidad y normativas legales a lo largo de nuestra cadena de valor, buscando satisfacer las necesidades de nuestras partes interesadas mediante la mejora continua, la seguridad y el bienestar de nuestro equipo humano.'
    ]
];

$icap_galeria = [
    [
        'src'       => 'assets/img/taller.webp',
        'alt'       => 'Línea de estaciones automatizadas con estructuras de aluminio y paneles de control',
        'titulo'    => 'Estaciones de trabajo',
        'categoria' => 'estaciones',
        'contador'  => '01 / 06',
        'destacada' => true
    ],
    [
        'src'       => 'assets/img/IngenieriaManufactura.webp',
        'alt'       => 'Detalle de equipo industrial con componentes neumáticos',
        'titulo'    => 'Integración industrial',
        'categoria' => 'neumatica',
        'contador'  => '02 / 06',
        'destacada' => true
    ],
    [
        'src'       => 'assets/img/galeria-5.webp',
        'alt'       => 'Banda transportadora industrial fotografiada en taller',
        'titulo'    => 'Equipo de proceso',
        'categoria' => 'estaciones',
        'contador'  => '03 / 06',
        'destacada' => true
    ],
    [
        'src'       => 'assets/img/galeria-6.webp',
        'alt'       => 'Estación industrial con resguardo transparente y conexiones neumáticas',
        'titulo'    => 'Detalle de estación',
        'categoria' => 'neumatica',
        'contador'  => '04 / 06',
        'destacada' => true
    ],
    [
        'src'       => 'assets/img/IngenieriaMecanica.webp',
        'alt'       => 'Nave de ingeniería y área de ensamble de ICAP Ingeniería',
        'titulo'    => 'Área de ensamble',
        'categoria' => 'manufactura',
        'contador'  => '05 / 06',
        'destacada' => false
    ],
    [
        'src'       => 'assets/img/IngenieriaAutomatizacion.webp',
        'alt'       => 'Área de maquinados de ICAP con equipo y personal en operación',
        'titulo'    => 'Taller de maquinados',
        'categoria' => 'manufactura',
        'contador'  => '06 / 06',
        'destacada' => false
    ]
];
