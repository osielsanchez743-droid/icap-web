<?php
declare(strict_types=1);

/**
 * Función auxiliar para escapar salidas HTML de forma segura.
 * Equivalente futuro en WordPress: esc_html() / esc_attr()
 */
function icap_esc(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

/**
 * Datos globales verificados de ICAP Ingeniería (https://icapmx.com/)
 * En la fase WordPress estos valores provendrán de opciones/campos del CMS.
 */
$icap_contacto = [
    'nombre_marca'     => 'ICAP Ingeniería',
    'razon_descriptiva'=> 'Instrumentación, Control y Automatización de Procesos.',
    'fundacion'        => '2016',
    'correo'           => 'julio.dejesus@icapmx.com',
    'gmail_compose'    => 'https://mail.google.com/mail/?view=cm&fs=1&to=julio.dejesus@icapmx.com&su=Consulta%20de%20proyecto%20-%20ICAP%20Ingenier%C3%ADa',
    'outlook_compose'  => 'https://outlook.office.com/mail/deeplink/compose?to=julio.dejesus@icapmx.com&subject=Consulta%20de%20proyecto%20-%20ICAP%20Ingenier%C3%ADa',
    'telefono_visible' => '+52 (446) 213 6128',
    'telefono_enlace'  => '+524462136128',
    'whatsapp_numero'  => '524462136128',
    'whatsapp_enlace'  => 'https://wa.me/524462136128?text=Hola%20ICAP%20Ingenier%C3%ADa%2C%20me%20gustar%C3%ADa%20solicitar%20informaci%C3%B3n%20sobre%20un%20proyecto.',
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
            'url'    => 'https://wa.me/524462136128?text=Hola%20ICAP%20Ingenier%C3%ADa%2C%20me%20gustar%C3%ADa%20solicitar%20informaci%C3%B3n%20sobre%20un%20proyecto.'
        ]
    ],
    'sedes'            => [
        [
            'id'          => 'sede-marques',
            'codigo'      => 'SEDE 01 // EL MARQUÉS, QRO.',
            'titulo_corto'=> '01 // Oficinas y Área de Ensamble',
            'titulo'      => 'Oficinas Principales y Área de Ensamble',
            'descripcion' => 'Espacio dedicado a ingeniería de diseño, integración eléctrica y neumática, programación de control y ensamble de estaciones de trabajo.',
            'direccion'   => 'Carretera Estatal 431, El Colorado-Galindo, Km 1.9. Condominio Industrial EUROPARK II, Bodega 5A, C.P. 76246, El Marqués, Qro.',
            'coordenadas' => '20.55857° N, 100.26886° W // EUROPARK II, BODEGA 5A',
            'maps_url'    => 'https://www.google.com.mx/maps/place/ICAP+Ingenier%C3%ADa+S.A.+DE+C.V./@20.5585749,-100.2714363,17z/data=!3m1!4b1!4m6!3m5!1s0x85d3436eb595a12f:0x61336c6be2883009!8m2!3d20.5585749!4d-100.2688614!16s%2Fg%2F11tf3g4ls_?entry=ttu',
            'embed_url'   => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3736.1357!2d-100.2688614!3d20.5585749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d3436eb595a12f%3A0x61336c6be2883009!2sICAP%20Ingenier%C3%ADa%20S.A.%20DE%20C.V.!5e0!3m2!1ses-419!2smx',
            'imagen'      => get_template_directory_uri() . '/assets/IngenieriaMecanica.webp',
            'alt'         => 'Oficinas y nave de ensamble de ICAP en El Marqués'
        ],
        [
            'id'          => 'sede-escobedo',
            'codigo'      => 'SEDE 02 // PEDRO ESCOBEDO, QRO.',
            'titulo_corto'=> '02 // Taller de Maquinados',
            'titulo'      => 'Taller de Maquinados y Manufactura',
            'descripcion' => 'Planta equipada con centros de maquinado CNC, tornos, fresadoras convencionales, área de soldadura y rectificado para fabricación de componentes.',
            'direccion'   => 'Planta de manufactura, maquinado CNC y convencional. Pedro Escobedo, Querétaro, México (20.490902, -100.185883).',
            'coordenadas' => '20.49090° N, 100.18588° W // TALLER PEDRO ESCOBEDO',
            'maps_url'    => 'https://maps.app.goo.gl/5oitKRzF3EB1td4q7',
            'embed_url'   => 'https://maps.google.com/maps?q=20.490902,-100.185883&t=&z=17&ie=UTF8&iwloc=&output=embed',
            'imagen'      => get_template_directory_uri() . '/assets/IngenieriaAutomatizacion.webp',
            'alt'         => 'Taller de maquinados CNC y convencional de ICAP en Pedro Escobedo'
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
        'codigo'      => 'MOD-01 // MEC',
        'badge'       => 'MOD-01 // ESPECIALIDAD',
        'indice'      => '01 // Diseño Mecánico',
        'titulo'      => 'Diseño Mecánico',
        'resumen'     => 'Diseño de estaciones de trabajo, modelos 3D, análisis de elemento finito y selección de materiales.',
        'descripcion' => 'Desarrollamos estaciones de trabajo manuales, semiautomáticas y automáticas, así como el diseño de piezas metálicas y plásticas adaptadas a los requerimientos de cada proceso productivo.',
        'especificaciones' => [
            'Diseño de estaciones de trabajo a medida',
            'Análisis por elemento finito (FEA) para validación estructural',
            'Modelos matemáticos y modelado 3D de ensambles',
            'Selección técnica de materiales metálicos y plásticos de ingeniería'
        ],
        'imagen'      => get_template_directory_uri() . '/assets/IngenieriaMecanica.webp',
        'alt'         => 'Nave de ingeniería y diseño de estaciones de trabajo en ICAP',
        'svg'         => '<path d="M12 2L3 7l9 5 9-5-9-5z"/><path d="M3 17l9 5 9-5"/><path d="M3 12l9 5 9-5"/>'
    ],
    [
        'id'          => 'manufactura',
        'codigo'      => 'MOD-02 // CNC',
        'badge'       => 'MOD-02 // ESPECIALIDAD',
        'indice'      => '02 // Manufactura',
        'titulo'      => 'Manufactura',
        'resumen'     => 'Maquinado CNC, torno y fresa convencional, soldadura y rectificado de piezas metálicas y plásticas.',
        'descripcion' => 'Contamos con taller de maquinados propio en Querétaro para el procesamiento de materias primas y la fabricación de piezas unitarias o en serie con control dimensional.',
        'especificaciones' => [
            'Maquinado de precisión en centros CNC',
            'Torno y fresa convencional',
            'Soldadura industrial especializada (MIG y Arco)',
            'Rectificado plano y cilíndrico de piezas metálicas y no metálicas'
        ],
        'imagen'      => get_template_directory_uri() . '/assets/IngenieriaAutomatizacion.webp',
        'alt'         => 'Taller de maquinados de ICAP con equipos CNC y convencionales',
        'svg'         => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c.26.6.77 1.05 1.51 1H21a2 2 0 1 1 0 4h-.09c-.74.05-1.25.4-1.51 1z"/>'
    ],
    [
        'id'          => 'electrico',
        'codigo'      => 'MOD-03 // ELEC',
        'badge'       => 'MOD-03 // ESPECIALIDAD',
        'indice'      => '03 // Eléctrico y Neumático',
        'titulo'      => 'Eléctrico / Neumático',
        'resumen'     => 'Ingeniería eléctrica, armado de gabinetes de control e integración de sistemas y pruebas neumáticas.',
        'descripcion' => 'Realizamos la ingeniería, dimensionamiento, canalización e integración de sistemas eléctricos y neumáticos para estaciones de trabajo y maquinaria industrial.',
        'especificaciones' => [
            'Diseño y planificación de ingeniería eléctrica',
            'Armado e integración de gabinetes de control',
            'Diseño neumático de potencia y control',
            'Selección e implementación de pruebas neumáticas y de estanqueidad'
        ],
        'imagen'      => get_template_directory_uri() . '/assets/IngenieriaManufactura.webp',
        'alt'         => 'Integración neumática y eléctrica con manómetros y unidades de mantenimiento',
        'svg'         => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M9 8h6"/><path d="M9 12h6"/><path d="M11 16h2"/>'
    ],
    [
        'id'          => 'control',
        'codigo'      => 'MOD-04 // CTRL',
        'badge'       => 'MOD-04 // ESPECIALIDAD',
        'indice'      => '04 // Control y Robótica',
        'titulo'      => 'Control y Robótica',
        'resumen'     => 'Integración de hardware y software, programación de PLC multimarca y robótica industrial.',
        'descripcion' => 'Integramos sistemas de hardware y software para automatizar procesos, asegurando secuencias confiables, comunicación industrial y seguridad operativa en planta.',
        'especificaciones' => [
            'Integración completa de hardware y software industrial',
            'Programación de PLC multimarca y pantallas HMI',
            'Programación e integración de robots industriales y cobots',
            'Puesta en marcha y optimización de tiempos de ciclo'
        ],
        'imagen'      => get_template_directory_uri() . '/assets/taller.webp',
        'alt'         => 'Línea de estaciones automatizadas con paneles de control ICAP',
        'svg'         => '<rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><path d="M10 17.5h4a2 2 0 0 0 2-2V10"/><circle cx="6.5" cy="7.5" r="2.5"/><path d="M6.5 10v4"/>'
    ]
];

$icap_proceso = [
    [
        'paso'        => 'FASE 01',
        'codigo'      => 'REQ // PLANTA',
        'titulo'      => 'Levantamiento Técnico',
        'descripcion' => 'Análisis de requerimientos en línea de producción, definición de alcances, ergonomía y tiempos de ciclo.'
    ],
    [
        'paso'        => 'FASE 02',
        'codigo'      => 'CAD // FEA',
        'titulo'      => 'Diseño Mecánico 3D',
        'descripcion' => 'Modelado 3D de estaciones y herramentales, validación por elemento finito (FEA) y selección de materiales.'
    ],
    [
        'paso'        => 'FASE 03',
        'codigo'      => 'CAM // CNC',
        'titulo'      => 'Manufactura Propia',
        'descripcion' => 'Fabricación en nuestro taller de Querétaro: maquinado CNC, torno, fresa, soldadura MIG/Arco y rectificado.'
    ],
    [
        'paso'        => 'FASE 04',
        'codigo'      => 'PLC // FRL',
        'titulo'      => 'Integración y Control',
        'descripcion' => 'Armado de gabinetes eléctricos, potencia neumática, pruebas de estanqueidad y programación de PLC/Robots.'
    ],
    [
        'paso'        => 'FASE 05',
        'codigo'      => 'FAT // SAT',
        'titulo'      => 'Puesta en Marcha',
        'descripcion' => 'Instalación en planta del cliente, pruebas funcionales, ajuste de secuencias y entrega operativa.'
    ]
];

$icap_plataformas = [
    'plc' => [
        'titulo' => 'Programación de PLC, HMI y Visión',
        'subtitulo' => 'Arquitecturas de control industrial, redes de comunicación y sensórica avanzada',
        'marcas' => ['Allen-Bradley', 'Siemens', 'Mitsubishi', 'Schneider Electric', 'Omron', 'Keyence'],
        'detalle' => [
            ['nombre' => 'Allen-Bradley',      'rol' => 'ControlLogix / CompactLogix · PanelView HMI', 'tag' => 'PLC / HMI'],
            ['nombre' => 'Siemens',            'rol' => 'SIMATIC S7 · TIA Portal · PROFINET',          'tag' => 'PLC / RED'],
            ['nombre' => 'Mitsubishi',         'rol' => 'MELSEC · Automatización y servocontrol',      'tag' => 'PLC / SERVO'],
            ['nombre' => 'Schneider Electric', 'rol' => 'Modicon · Control y maniobra eléctrica',      'tag' => 'CONTROL'],
            ['nombre' => 'Omron',              'rol' => 'Sysmac · Control secuencial y seguridad',     'tag' => 'PLC / SEG'],
            ['nombre' => 'Keyence',            'rol' => 'Sistemas de visión artificial, lectura y PLC', 'tag' => 'VISIÓN / PLC']
        ]
    ],
    'robots' => [
        'titulo' => 'Integración de Robots y Cobots',
        'subtitulo' => 'Celdas robóticas de ensamble, manipulación, carga/descarga y trabajo colaborativo',
        'marcas' => ['Stäubli', 'Fanuc', 'Doosan', 'Universal Robots', 'Yaskawa', 'ABB'],
        'detalle' => [
            ['nombre' => 'Stäubli',          'rol' => 'Robots de alta velocidad y precisión',       'tag' => 'INDUSTRIAL'],
            ['nombre' => 'Fanuc',            'rol' => 'Celdas de manufactura, manejo y carga CNC',  'tag' => 'INDUSTRIAL'],
            ['nombre' => 'Doosan',           'rol' => 'Robótica colaborativa de alta sensibilidad', 'tag' => 'COBOT'],
            ['nombre' => 'Universal Robots', 'rol' => 'Cobots flexibles para estaciones manuales',  'tag' => 'COBOT'],
            ['nombre' => 'Yaskawa',          'rol' => 'Motoman · Soldadura y manipulación',         'tag' => 'INDUSTRIAL'],
            ['nombre' => 'ABB',              'rol' => 'Automatización robótica de líneas',          'tag' => 'INDUSTRIAL']
        ]
    ]
];

$icap_filosofia = [
    [
        'indice' => '01 // MISIÓN',
        'titulo' => 'Soluciones a medida',
        'texto'  => 'Desarrollar soluciones a la medida de cada cliente, reconociendo que cada necesidad es diferente, e integrar nuestras fortalezas técnicas para encontrar las mejores respuestas a los problemas de la industria.'
    ],
    [
        'indice' => '02 // VISIÓN',
        'titulo' => 'Liderazgo e innovación',
        'texto'  => 'Ser una empresa 100% mexicana líder en el área de automatización de procesos e innovación tecnológica, ofreciendo soluciones integrales a nivel nacional e internacional.'
    ],
    [
        'indice' => '03 // POLÍTICA DE CALIDAD',
        'titulo' => 'Mejora continua',
        'texto'  => 'Operar en estricto cumplimiento de los requisitos de nuestros clientes, estándares de calidad y normativas legales a lo largo de nuestra cadena de valor, buscando satisfacer las necesidades de nuestras partes interesadas mediante la mejora continua, la seguridad y el bienestar de nuestro equipo humano.'
    ]
];

$icap_galeria = [
    [
        'src'          => get_template_directory_uri() . '/assets/taller.webp',
        'alt'          => 'Línea de estaciones automatizadas con estructuras de aluminio y paneles de control ICAP',
        'titulo'       => 'Estaciones de trabajo automatizadas',
        'subtitulo'    => 'Estructuras en perfil de aluminio, control e iluminación integrada',
        'categoria'    => 'estaciones',
        'area_cotizar' => 'mecanico',
        'tags'         => ['MECÁNICO', 'ELÉCTRICO', 'CONTROL'],
        'specs'        => [
            'Estructura modular en perfil de aluminio anodizado con guardas de seguridad',
            'Paneles de control superiores con torretas de estado y botoneras industriales',
            'Iluminación LED integrada y rieles de alimentación para contenedores de línea'
        ],
        'fig'          => 'FIG 01',
        'contador'     => '01 / 06',
        'destacada'    => true
    ],
    [
        'src'          => get_template_directory_uri() . '/assets/IngenieriaManufactura.webp',
        'alt'          => 'Detalle de estación industrial con manómetros, unidades de mantenimiento neumático y cableado estructurado',
        'titulo'       => 'Integración neumática y eléctrica',
        'subtitulo'    => 'Unidades FRL, manómetros y canalización en estación',
        'categoria'    => 'neumatica',
        'area_cotizar' => 'electrico',
        'tags'         => ['NEUMÁTICO', 'ELÉCTRICO', 'PRUEBAS'],
        'specs'        => [
            'Unidades de mantenimiento neumático (FRL) con regulación independiente',
            'Manómetros de carátula para monitoreo de presión por circuito de trabajo',
            'Canalización neumática identificada y botonera de mando frontal'
        ],
        'fig'          => 'FIG 02',
        'contador'     => '02 / 06',
        'destacada'    => true
    ],
    [
        'src'          => get_template_directory_uri() . '/assets/galeria-5.webp',
        'alt'          => 'Banda transportadora industrial con paro de emergencia y gabinete inferior fotografiada en planta',
        'titulo'       => 'Equipo de proceso y transporte',
        'subtitulo'    => 'Transportador modular con seguridad y control integrado',
        'categoria'    => 'estaciones',
        'area_cotizar' => 'control',
        'tags'         => ['MECÁNICO', 'CONTROL', 'TRANSPORTE'],
        'specs'        => [
            'Sistema de transporte modular con estructura de aluminio y niveladores',
            'Paro de emergencia accesible y botonera de arranque/paro en estación',
            'Gabinete inferior integrado para alojamiento de control y potencia'
        ],
        'fig'          => 'FIG 03',
        'contador'     => '03 / 06',
        'destacada'    => true
    ],
    [
        'src'          => get_template_directory_uri() . '/assets/galeria-6.webp',
        'alt'          => 'Estación industrial con guarda de policarbonato, reguladores de presión y selectores neumáticos',
        'titulo'       => 'Estación con prueba neumática',
        'subtitulo'    => 'Resguardo transparente, regulación por circuito y desfogue',
        'categoria'    => 'neumatica',
        'area_cotizar' => 'electrico',
        'tags'         => ['NEUMÁTICO', 'ESTANQUEIDAD', 'SEGURIDAD'],
        'specs'        => [
            'Guarda de policarbonato transparente para protección de operador en ciclo',
            'Banco de reguladores de presión y manómetros para prueba neumática',
            'Válvulas selectoras y circuito de desfogue controlado en panel frontal'
        ],
        'fig'          => 'FIG 04',
        'contador'     => '04 / 06',
        'destacada'    => false
    ],
    [
        'src'          => get_template_directory_uri() . '/assets/IngenieriaMecanica.webp',
        'alt'          => 'Nave de ingeniería y área de ensamble de estaciones de trabajo de ICAP Ingeniería',
        'titulo'       => 'Nave de ingeniería y ensamble',
        'subtitulo'    => 'Área de diseño e integración de estaciones en El Marqués',
        'categoria'    => 'manufactura',
        'area_cotizar' => 'mecanico',
        'tags'         => ['EL MARQUÉS', 'ENSAMBLE', 'INGENIERÍA'],
        'specs'        => [
            'Sede principal en Condominio Industrial EUROPARK II, El Marqués, Qro.',
            'Área de integración mecánica, armado eléctrico y pruebas FAT de estaciones',
            'Oficinas de ingeniería para diseño CAD 3D, simulación FEA y programación'
        ],
        'fig'          => 'FIG 05',
        'contador'     => '05 / 06',
        'destacada'    => false
    ],
    [
        'src'          => get_template_directory_uri() . '/assets/IngenieriaAutomatizacion.webp',
        'alt'          => 'Área de maquinados de ICAP con centro de maquinado CNC y fresadoras convencionales',
        'titulo'       => 'Taller de maquinados',
        'subtitulo'    => 'Equipamiento CNC y convencional en operación',
        'categoria'    => 'manufactura',
        'area_cotizar' => 'manufactura',
        'tags'         => ['PEDRO ESCOBEDO', 'MAQUINADO CNC', 'MANUFACTURA'],
        'specs'        => [
            'Planta de manufactura en Pedro Escobedo, Querétaro, con equipamiento propio',
            'Centros de maquinado CNC, tornos y fresadoras convencionales de precisión',
            'Fabricación de componentes metálicos, plásticos de ingeniería y herramentales'
        ],
        'fig'          => 'FIG 06',
        'contador'     => '06 / 06',
        'destacada'    => false
    ]
];

$icap_faqs = [
    [
        'codigo'    => 'FAQ // 01',
        'pregunta'  => '¿Trabajan con planos proporcionados por el cliente o diseñan desde cero?',
        'respuesta' => 'Trabajamos en ambas modalidades. Si ya cuentas con dibujos 2D o modelos 3D (.STEP, .DXF, .IGES, .PDF), ejecutamos la manufactura y el maquinado directamente en nuestro taller de Pedro Escobedo. Si necesitas desarrollar una estación o herramental desde cero, nuestro equipo de ingeniería realiza el levantamiento en planta, modelado 3D y análisis por elemento finito (FEA) en El Marqués.'
    ],
    [
        'codigo'    => 'FAQ // 02',
        'pregunta'  => '¿Fabrican piezas unitarias, refacciones o únicamente proyectos llave en mano?',
        'respuesta' => 'Atendemos desde la fabricación de componentes unitarios, fixtures, galgas y refacciones urgentes en maquinado CNC, torno, fresa, soldadura y rectificado, hasta el desarrollo e integración completa de estaciones de trabajo manuales, semiautomáticas y automáticas.'
    ],
    [
        'codigo'    => 'FAQ // 03',
        'pregunta'  => '¿Se adaptan al estándar de PLC y robótica ya instalado en nuestra planta?',
        'respuesta' => 'Sí. Programamos e integramos las plataformas líderes de la industria según la especificación de cada planta: Allen-Bradley, Siemens, Mitsubishi, Schneider Electric, Omron y Keyence en control/visión, así como robots y cobots Stäubli, Fanuc, Doosan, Universal Robots, Yaskawa y ABB.'
    ],
    [
        'codigo'    => 'FAQ // 04',
        'pregunta'  => '¿A qué sectores industriales atienden y realizan visitas técnicas en planta?',
        'respuesta' => 'Desarrollamos proyectos para los sectores automotriz, aeronáutico, alimenticio, farmacéutico y de servicios. Realizamos levantamientos técnicos, instalación y puesta en marcha directamente en las instalaciones del cliente.'
    ],
    [
        'codigo'    => 'FAQ // 05',
        'pregunta'  => '¿Qué información debo incluir para agilizar una cotización técnica?',
        'respuesta' => 'Para cotizar con mayor rapidez, indícanos la especialidad principal (Diseño Mecánico, Manufactura CNC, Eléctrico/Neumático o Control), una descripción breve del proceso o pieza, cantidades estimadas y si dispones de archivos CAD/planos o requieres una visita de levantamiento técnico.'
    ]
];


/**
 * Integración con opciones editables del panel WordPress ("Datos ICAP" y CPT "Galería en Planta")
 */
if (function_exists('get_option')) {
    $icap_contacto['correo']           = get_option('icap_correo', $icap_contacto['correo']);
    $icap_contacto['telefono_visible'] = get_option('icap_telefono_visible', $icap_contacto['telefono_visible']);
    $icap_contacto['telefono_enlace']  = get_option('icap_telefono_enlace', $icap_contacto['telefono_enlace']);
    $icap_contacto['whatsapp_numero']  = get_option('icap_whatsapp_numero', $icap_contacto['whatsapp_numero']);
    $icap_contacto['whatsapp_enlace']  = 'https://wa.me/' . $icap_contacto['whatsapp_numero'] . '?text=Hola%20ICAP%20Ingenier%C3%ADa%2C%20me%20gustar%C3%ADa%20solicitar%20informaci%C3%B3n%20sobre%20un%20proyecto.';
    $icap_contacto['gmail_compose']    = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . rawurlencode($icap_contacto['correo']) . '&su=Consulta%20de%20proyecto%20-%20ICAP%20Ingenier%C3%ADa';
    $icap_contacto['outlook_compose']  = 'https://outlook.office.com/mail/deeplink/compose?to=' . rawurlencode($icap_contacto['correo']) . '&subject=Consulta%20de%20proyecto%20-%20ICAP%20Ingenier%C3%ADa';
    $icap_contacto['sedes'][0]['direccion'] = get_option('icap_direccion_marques', $icap_contacto['sedes'][0]['direccion']);
    $icap_contacto['sedes'][1]['direccion'] = get_option('icap_direccion_escobedo', $icap_contacto['sedes'][1]['direccion']);
    $icap_contacto['redes']['linkedin']['url'] = get_option('icap_url_linkedin', $icap_contacto['redes']['linkedin']['url']);
    $icap_contacto['redes']['youtube']['url']  = get_option('icap_url_youtube', $icap_contacto['redes']['youtube']['url']);
    $icap_contacto['redes']['facebook']['url'] = get_option('icap_url_facebook', $icap_contacto['redes']['facebook']['url']);
}

/**
 * Si el cliente ha subido fotografías desde el menú "Galería en Planta" de WordPress,
 * se cargan dinámicamente; de lo contrario, se muestran las 6 fotografías oficiales base.
 */
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
            $tags_raw = (string) get_post_meta($p_gal->ID, '_icap_gal_tags', true);
            $tags_arr = array_values(array_filter(array_map('trim', explode(',', $tags_raw ?: 'MECÁNICO, CONTROL'))));
            $specs_raw = (string) get_post_meta($p_gal->ID, '_icap_gal_specs', true);
            $specs_arr = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $specs_raw))));
            if (empty($specs_arr)) {
                $specs_arr = ['Integración industrial desarrollada por ICAP Ingeniería en Querétaro'];
            }
            $num_str = str_pad((string) ($idx + 1), 2, '0', STR_PAD_LEFT);
            $tot_str = str_pad((string) $total_fotos, 2, '0', STR_PAD_LEFT);
            $galeria_dinamica[] = [
                'src'          => $img_url,
                'alt'          => $alt_txt,
                'titulo'       => $p_gal->post_title,
                'subtitulo'    => $p_gal->post_excerpt ?: 'Evidencia en planta ICAP Ingeniería',
                'categoria'    => (string) (get_post_meta($p_gal->ID, '_icap_gal_categoria', true) ?: 'estaciones'),
                'area_cotizar' => (string) (get_post_meta($p_gal->ID, '_icap_gal_area', true) ?: 'mecanico'),
                'tags'         => $tags_arr,
                'specs'        => $specs_arr,
                'fig'          => (string) (get_post_meta($p_gal->ID, '_icap_gal_fig', true) ?: ('FIG ' . $num_str)),
                'contador'     => $num_str . ' / ' . $tot_str,
                'destacada'    => ($idx < 3)
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
            'desc'  => $f['subtitulo'],
            'count' => $f['contador'],
            'area'  => $f['area_cotizar'],
            'tags'  => $f['tags'],
            'specs' => $f['specs']
        ];
    }
    return $items;
}
