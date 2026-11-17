# Inventario de contenido editable — ICAP Ingeniería

Estado: **Fase 1, inventario y propuesta**. La home en `index.html` sigue siendo estática. Los nombres de campos y pantallas de WordPress aquí descritos todavía no están implementados.

## Criterio editorial

- El cliente podrá cambiar información y medios; el tema conservará estructura, colores, espaciado, navegación y estilos responsive.
- Las cuatro áreas verificadas son **Diseño Mecánico**, **Manufactura**, **Eléctrico / Neumático** y **Control**. Su categoría y ruta canónica requieren validación antes de renombrarse; los textos descriptivos y las imágenes serán editables.
- Las fotos actuales proceden del sitio oficial y forman una **galería visual**. No hay fichas ni atribuciones suficientes para presentarlas como proyectos individuales.
- El naranja `#f3803f` es una muestra provisional tomada del logo publicado. El color final se ajustará únicamente tras validar el manual de marca.

## Textos e información de la home

| Sección actual | Contenido que el cliente editará | Ubicación actual | Administración prevista |
| --- | --- | --- | --- |
| Portada | Antetítulo, título, párrafo, texto de CTA principal/secundario y lista de sectores atendidos | `index.html:58-74` | Pantalla «Inicio» con campos de texto, enlaces y lista de sectores |
| Franja de presentación | Rótulo y frase de capacidades | `index.html:81-87` | Campos de «Inicio» |
| Introducción a servicios | Antetítulo, titular y párrafo introductorio | `index.html:91-97` | Campos de «Inicio» |
| Tarjetas de servicios | Resumen, lista de subservicios verificados, icono/imagen y orden de cada una de las cuatro áreas | `index.html:99-192` | Pantalla «Servicios» con cuatro fichas precargadas |
| Ecosistema de control | Título, descripción y etiquetas de marcas de PLC y Robots/Cobots | `index.html:194-224` | Campos de «Inicio» / «Control» |
| Presentación de la empresa | Antetítulo, título, párrafos e información de Misión, Visión y Política de Calidad | `index.html:228-266` | Pantalla «Inicio»; detalle ampliado en «Nosotros» |
| Introducción a galería | Antetítulo, titular y párrafo | `index.html:270-276` | Campos de «Inicio» |
| Elementos de galería | 5 fotografías con título, descripción técnica y contador (`01 / 05` a `05 / 05`) | `index.html:278-346` | Cada elemento de galería tendrá título, leyenda y texto alternativo editables |
| Contacto y solicitud técnica | Antetítulo, titular, correo, teléfono, dos ubicaciones (El Marqués y Pedro Escobedo) y formulario | `index.html:350-439` | Campos de «Inicio» y datos globales de contacto |
| Pie de página | Descripción de ICAP, enlaces de especialidades, correo, teléfono y ubicaciones | `index.html:442-476` | Descripción editable y datos globales de contacto |
| Metadatos y SEO | Título, descripción, Open Graph y JSON-LD (`ProfessionalService`) | `index.html:6-42` | Edición de contenido/SEO en WordPress, sin acceso a código |

Los rótulos decorativos, numeración, iconos, disposición y estilos se conservan en el tema. Las etiquetas de navegación y la identidad del logo se administrarán como configuración de diseño por el Administrador, no como campos cotidianos del cliente.

## Fotografías y recursos actuales

| Archivo usado en la home | Uso actual | Acción editorial futura |
| --- | --- | --- |
| `assets/ICAP_LOGO.png` | Cabecera y pie | Recurso de identidad del tema; sustitución reservada al Administrador |
| `assets/taller.webp` | Imagen principal y primera foto de galería | La imagen principal será reemplazable; la foto de galería será un elemento independiente |
| `assets/IngenieriaAutomatizacion.webp` | Fotografía de «Nosotros» | Reemplazar desde la biblioteca de medios |
| `assets/IngenieriaManufactura.webp` | Segunda foto de galería | Agregar, reemplazar, reordenar o retirar de la galería |
| `assets/galeria-5.webp` | Tercera foto de galería | Agregar, reemplazar, reordenar o retirar de la galería |
| `assets/galeria-6.webp` | Cuarta foto de galería | Agregar, reemplazar, reordenar o retirar de la galería |
| `assets/IngenieriaMecanica.webp` | Quinta foto de galería (nave de ingeniería y ensamble) | Agregar, reemplazar, reordenar o retirar de la galería |

También se conservan los JPEG originales de las fotografías como respaldo de referencia. No se eliminarán durante la migración. Las nuevas imágenes deberán tener texto alternativo y dimensiones; la carga diferida seguirá reservada para imágenes fuera de portada.

## Enlaces actuales y destino previsto

| Enlace actual | Estado y tratamiento en WordPress |
| --- | --- |
| Anclas `#inicio`, `#servicios`, `#nosotros`, `#galeria`, `#contacto` | Mantener navegación interna de la home; las etiquetas y el menú pertenecen al tema |
| `https://icapmx.com/Mecanico`, `/Manufactura`, `/Electrico`, `/Control` | Son enlaces provisionales a fichas oficiales. Cambiar a enlaces internos al publicar las nuevas fichas; conservar rutas o crear redirecciones 301 |
| `https://icapmx.com/Nosotros` | Enlace provisional; cambiar a la nueva página «Nosotros» |
| `mailto:julio.dejesus@icapmx.com` | Se generará desde un único campo global de correo; mantener el asunto prellenado cuando convenga |
| `tel:+524462136128` | Se generará desde un único campo global de teléfono |
| «Volver arriba» | Enlace estructural del tema; no requiere campo editorial |

## Modelo de administración propuesto

| Contenido | Cómo lo gestionará el cliente | Regla para conservar el diseño |
| --- | --- | --- |
| Secciones fijas de Inicio, Nosotros y Contacto | Pantallas de contenido con campos claros para textos, botones e imágenes; selector de medios de WordPress | PHP imprime los datos en secciones y clases visuales fijas; se validan longitud, formato y enlaces |
| Servicios | Cuatro fichas iniciales, una por área confirmada; editar resumen, detalles, imagen y orden | El cliente no crea, elimina ni cambia las categorías/rutas canónicas sin revisión del Administrador |
| Proyectos | Fichas independientes **solo cuando ICAP aporte título, descripción, imágenes y atribución autorizada** | Tipo de contenido propio con campos definidos y plantilla común; el cliente podrá crear, editar y retirar fichas verificadas |
| Galería | Elementos de imagen independientes con leyenda, alt, orden y estado de publicación | El cliente podrá agregar, reemplazar, reordenar y retirar fotos sin alterar la retícula; retirar una foto de la web no obliga a borrar el archivo de la biblioteca |
| Contacto global | Correo, teléfono, dirección y otros enlaces expresamente autorizados | Una sola fuente de datos alimenta CTA y pie de página; no se editan HTML ni enlaces manualmente |

Los tipos de contenido de servicios, proyectos y elementos de galería se registrarán en un plugin propio pequeño para conservar los datos aunque el tema cambie. El tema PHP se encargará de su presentación.

## Rol propuesto: Gestor de contenido ICAP

Se creará en la fase de implementación un rol propio, distinto del Administrador y del Editor genérico.

- Permitido: entrar al panel, editar los campos de secciones autorizadas, cargar medios, cambiar fotos, editar las cuatro fichas de servicio, y crear/editar/retirar elementos de galería y proyectos autorizados.
- Restringido: instalar, activar o editar temas/plugins; cambiar ajustes, usuarios, rutas, diseño global, plantillas, CSS o JavaScript; crear o eliminar las cuatro categorías de servicio.
- Protección complementaria: menús de administración limitados, capacidades específicas por tipo de contenido, campos validados y controles del editor orientados a contenido. Ocultar menús por sí solo no equivale a restringir permisos.

El Administrador conservará el control técnico y de marca. La eliminación definitiva de un archivo de medios se diseñará con una comprobación de referencias para evitar romper otras secciones.

## Contenido pendiente de validar

- Permiso y originales de logo y fotografías, y valor HEX oficial del naranja.
- Títulos, descripciones, imágenes y autorización de cada proyecto que se quiera publicar como caso propio.
- Vigencia de correo, teléfono, dirección y posibles enlaces sociales o WhatsApp.
- Textos legales y política de privacidad si se incorpora un formulario.
