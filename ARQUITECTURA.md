# ICAP Ingeniería — propuesta y estado de la primera entrega

## Estado actual

El repositorio inicial solo contenía `AGENTS.md`, `LEEME.txt` y las skills. No había aplicación, framework, WordPress ni código que migrar. `index.html` es una **maqueta local de la página de inicio**. Todavía no existe un CMS ni se ha publicado el rediseño.

## Estructura propuesta

| Página | Contenido previsto | Fuente actual |
| --- | --- | --- |
| Inicio | Mensaje principal, cuatro áreas, presentación, galería y contacto | [Portada oficial](https://icapmx.com/) |
| Nosotros | Historia, promesa de valor, misión, visión, política y objetivos de calidad, locaciones | [Nosotros](https://icapmx.com/Nosotros) y portada oficial |
| Servicios | Índice de las cuatro áreas confirmadas | [Productos y servicios](https://icapmx.com/Servicios-Proyectos) |
| Diseño Mecánico | Diseño de elemento finito, estaciones de trabajo, selección de materiales y modelo matemático 3D | [Página oficial](https://icapmx.com/Mecanico) |
| Manufactura | Torno y fresa convencional, CNC, soldadura y rectificado | [Página oficial](https://icapmx.com/Manufactura) |
| Eléctrico / Neumático | Diseño eléctrico, gabinetes de control, diseño neumático e integración | [Página oficial](https://icapmx.com/Electrico) |
| Control | Programación PLC y programación de cobot y robot | [Página oficial](https://icapmx.com/Control) |
| Galería / Proyectos | Imágenes autorizadas, descripción, categoría y orden; las fichas de proyecto requieren datos que ICAP proporcione | [Galería oficial](https://icapmx.com/) |
| Contacto | Correo, teléfono, dirección y, tras validar el flujo, formulario | [Contacto oficial](https://icapmx.com/contactanos/Contacto) |

El sitio actual usa rutas como `/Nosotros`, `/Mecanico` y `/Control`. Al pasar a WordPress, conservarlas cuando sea viable; si cambian, crear redirecciones 301. En la maqueta, las fichas de servicio y “Conoce más” apuntan al sitio oficial hasta construir las páginas nuevas.

## Sistema de diseño

- Dirección: industrial sobria, con fotografías reales, gran jerarquía tipográfica y bordes finos.
- Color: `--icap-orange: #f3803f`, muestra **provisional tomada de los píxeles del logotipo oficial descargado** (el logo tiene varios tonos naranjas); grafito `#171a1d`, blanco y grises neutros. ICAP debe validar el HEX exacto de su manual de marca, si existe.
- Tipografía: Arial/Helvetica como opción local rápida, sin llamadas a terceros. Escala fluida para titulares mediante `clamp()`.
- Retícula: contenedor máximo de 1220 px, márgenes fluidos y espaciado de secciones adaptable. Tarjetas de servicios sin sombras pesadas; animaciones discretas y desactivadas con movimiento reducido.
- Fotografía: archivos usados por el sitio oficial. Copias WebP para la maqueta; los JPEG originales se guardan como referencia de origen. No se asignan clientes, cifras o nombres de proyectos que ICAP no haya confirmado.

## Arquitectura WordPress recomendada

**Tema de bloques personalizado en WordPress de Hostinger**, con `theme.json` para colores, tipografía y espaciado; plantillas para Inicio, Nosotros, archivo de Servicios, ficha de Servicio, archivo de Proyectos, ficha de Proyecto y Contacto. La maqueta actual sirve como referencia visual para convertirla en ese tema. No hace falta un frontend desacoplado para estos requisitos.

| Contenido editable | Modelo recomendado |
| --- | --- |
| Inicio: título, introducción, imagen principal y llamada a la acción | Bloques nativos con patrones bloqueados en estructura |
| Nosotros: historia, misión, visión, política, objetivos, imágenes | Página de bloques con patrones controlados |
| Servicios: nombre, resumen, detalle, imagen y orden | Tipo de contenido `servicio` con campos/bloques definidos; cuatro términos o entradas iniciales |
| Galería y proyectos: añadir, quitar o reordenar fotos, leyendas y categorías | Tipo `proyecto`, medios de WordPress, galería de bloques y taxonomía de categoría |
| Contacto: teléfono, correo, dirección y enlaces autorizados | Opciones globales del tema o patrón sincronizado administrado |

El rol Editor podrá cambiar textos e imágenes sin editar estilos globales ni plantillas. Mantener la administración del tema y plugins en un rol Administrador. Formularios, antispam, SSL, copias de seguridad y SEO básico se definirán en staging con el mínimo de plugins mantenidos. Antes de publicar: comprobar edición de texto, sustitución, alta, orden y eliminación de fotos; revisar móvil y escritorio; validar permisos; probar restauración y redirecciones.

## Pendiente antes de producción

1. Confirmar permiso de uso de los archivos del sitio actual y solicitar originales de logo/fotos en mayor calidad, manual de marca y HEX oficial.
2. Recibir fichas y leyendas reales de proyectos; las imágenes actuales son una galería visual sin atribuciones de proyecto.
3. Construir el tema WordPress y el resto de páginas; migrar contenido verificado y sustituir los enlaces temporales al sitio anterior.
4. Validar datos de contacto y añadir formulario con tratamiento de datos aprobado por ICAP.
5. Probar en staging y publicar solo cuando ICAP autorice el lanzamiento.
