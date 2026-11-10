# ICAP Ingeniería — arquitectura aprobada y plan de migración

## Estado actual

La primera entrega añadió `index.html`, `styles.css`, `script.js` y `assets/` al material inicial. Es una **maqueta local de la página de inicio**, construida con HTML, CSS y JavaScript sin framework ni compilación. Todavía no existe WordPress, conexión a base de datos ni publicación del rediseño. La Fase 1 resguardó todos los archivos con Git en la rama `main`; el commit inicial `96264f5` conserva la maqueta anterior a esta actualización documental. No hay remoto configurado.

La arquitectura aprobada es WordPress como CMS, tema personalizado con PHP, CSS actual como base visual, JavaScript para interactividad, `theme.json` para identidad visual, MariaDB/MySQL, XAMPP local y Hostinger como alojamiento final. **Tailwind CSS y Alpine.js no forman parte de esta implementación.** El inventario de campos, imágenes y enlaces está en [`INVENTARIO_CMS.md`](INVENTARIO_CMS.md).

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
- Conservación: reutilizar el HTML semántico, las clases, las variables CSS, el menú móvil de `script.js`, el logo y todas las fotografías. La conversión a WordPress se hará en un directorio nuevo; la maqueta permanecerá intacta como referencia.

## Arquitectura WordPress definitiva

Se desarrollará un **tema híbrido de plantillas PHP**. `header.php`, `front-page.php`, `footer.php` y las plantillas interiores conservarán la estructura y las clases visuales de la maqueta. `functions.php` registrará los recursos y funciones del tema; `theme.json` definirá la paleta, tipografía y ajustes del editor en coherencia con las variables CSS. El CSS actual será la base; se reorganizará solo cuando la conversión lo requiera, con comprobación visual antes y después. No se necesita un frontend desacoplado.

Los textos e imágenes que el cliente cambie se almacenarán en WordPress y se mostrarán mediante PHP, con validación de entrada y escape de salida. Para secciones fijas se diseñarán pantallas/campos de contenido claros; las imágenes se seleccionarán en la biblioteca de medios. Los tipos de contenido `servicio`, `proyecto` y `elemento de galería` vivirán en un pequeño plugin propio para que el contenido sobreviva a un cambio de tema. **Una foto de galería no se convertirá automáticamente en una ficha de proyecto.**

| Área | Modelo editorial aprobado |
| --- | --- |
| Inicio, Nosotros y Contacto | Secciones fijas con campos para títulos, textos, botones e imágenes; PHP controla el marcado y la composición |
| Servicios | Cuatro fichas precargadas con contenido, imagen y orden editables; nombre de categoría y ruta canónica bajo control del Administrador |
| Proyectos | Fichas independientes para casos documentados y autorizados por ICAP |
| Galería | Elementos de imagen independientes con leyenda, alt, orden y estado de publicación; se podrán agregar, reemplazar y retirar |
| Contacto global | Una sola fuente para correo, teléfono, dirección y enlaces autorizados, reutilizada en portada y pie |

El rol **Gestor de contenido ICAP** tendrá capacidades específicas para editar estas áreas y subir medios. No tendrá acceso a temas, plugins, ajustes técnicos, usuarios, plantillas, CSS o JavaScript. El Administrador mantendrá el control técnico. La restricción se aplicará con permisos reales de WordPress, no solo ocultando opciones del menú.

### Organización de código prevista (no creada aún)

```text
index.html, styles.css, script.js, assets/   # maqueta conservada
tema-icap/                                  # fuente del tema PHP
  style.css, theme.json, functions.php
  header.php, front-page.php, footer.php
  page.php, single-servicio.php, single-proyecto.php
  assets/css/, assets/js/, assets/img/
plugin-icap-contenido/                      # tipos y permisos del CMS
wordpress/                                 # instalación local ignorada por Git
```

Las rutas actuales como `/Nosotros`, `/Mecanico`, `/Manufactura`, `/Electrico` y `/Control` se conservarán cuando sea posible. Si alguna cambia, se preparará una redirección 301. Los enlaces provisionales al sitio anterior se sustituirán solo cuando las páginas nuevas estén listas.

## Fases de implementación

| Fase | Trabajo | Estado |
| --- | --- | --- |
| 1. Resguardo y preparación | Git, `.gitignore`, inventario editorial, permisos propuestos y este plan | **Completada; sin instalar WordPress** |
| 2. Entorno local | Instalar WordPress de forma aislada en XAMPP, configurar MariaDB y comprobar accesos | Pendiente de autorización posterior |
| 3. Tema e inicio | Crear tema PHP, `theme.json`, trasladar home y conectar contenido editable sin perder diseño | Pendiente |
| 4. Administración | Crear plugin de contenido, pantallas/campos y rol; probar cambios, altas, reemplazos y retiros de fotos | Pendiente |
| 5. Páginas interiores | Nosotros, servicios, proyectos/galería y contacto con datos verificados | Pendiente |
| 6. Validación y lanzamiento | Pruebas de accesibilidad, responsive, rendimiento, SEO, permisos, respaldos y redirecciones en staging; despliegue tras autorización | Pendiente |

La Fase 1 no instala WordPress, no crea bases de datos y no modifica la maqueta. Antes de producción faltará validar permiso y originales del logo/fotos, HEX corporativo, datos de contacto y fichas de proyectos. Un formulario requerirá textos legales, protección antispam y un flujo aprobado por ICAP.
