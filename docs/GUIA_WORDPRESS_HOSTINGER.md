# Guía de Despliegue en Hostinger y WordPress — ICAP Ingeniería

Este repositorio contiene **dos modalidades completas y listas para producción**, según la etapa en que la empresa decida publicar el sitio:

---

## Opción A: Subida directa en PHP a Hostinger (Sin necesidad de WordPress ni Base de Datos)

Si ICAP desea publicar el nuevo sitio de inmediato en cualquier plan de hosting de Hostinger (o servidor Apache/PHP):

1. Entra al **Administrador de Archivos** de Hostinger (`public_html`).
2. Sube los siguientes archivos y carpetas de la raíz del proyecto:
   - `index.php`, `servicios.php`, `nosotros.php`, `galeria.php`, `contacto.php`, `404.php`
   - `.htaccess` y `favicon.ico`
   - Carpeta `includes/` (`datos.php`, `header.php`, `footer.php`)
   - Carpeta `assets/` (incluyendo `assets/css/` y las fotografías `.webp` / `.png`)
   - `styles.css` y `script.js`
3. **Listo.** El sitio funcionará de inmediato con redirecciones automáticas desde las rutas antiguas del sitio en ASP.NET (`/Nosotros`, `/Mecanico`, `/Manufactura`, `/Electrico`, `/Control`).
4. Para editar cualquier teléfono, correo, dirección o texto desde un solo lugar, basta con modificar [`includes/datos.php`](includes/datos.php).

---

## Opción B: Instalación en WordPress en Hostinger (Con Panel Autoadministrable para el Cliente)

Si ICAP activa el instalador automático de **WordPress** en su panel de Hostinger (hPanel) para que personal no técnico edite contenido desde `icapmx.com/wp-admin`:

### Paso 1: Subir y activar el Plugin de Contenido y Permisos (`plugin-icap-contenido.zip`)
1. En el panel de WordPress (`wp-admin`), ve a **Plugins → Añadir nuevo plugin → Subir plugin**.
2. Selecciona el archivo **`plugin-icap-contenido.zip`** incluido en este proyecto y haz clic en **Instalar ahora** y luego en **Activar plugin**.
3. Al activarse, este plugin registra automáticamente:
   - El menú **«Datos ICAP»** (para cambiar correo, teléfono, WhatsApp, direcciones de El Marqués y Pedro Escobedo, y enlaces de LinkedIn, YouTube y Facebook sin tocar código).
   - El menú **«Galería en Planta»** (para subir nuevas fotografías, cambiar orden, elegir categoría de filtro y llenar los puntos de inspección técnica del Lightbox).
   - El menú **«Especialidades ICAP»** y **«Proyectos ICAP»**.
   - El rol de usuario restringido **«Gestor de contenido ICAP»** (puede subir fotos y actualizar datos, pero no puede desconfigurar el tema, instalar plugins ni tocar código).

### Paso 2: Subir y activar el Tema Visual (`tema-icap.zip`)
1. En el panel de WordPress, ve a **Apariencia → Temas → Añadir nuevo tema → Subir tema**.
2. Selecciona el archivo **`tema-icap.zip`** y haz clic en **Instalar ahora** y luego en **Activar**.
3. Al activarse el tema:
   - Crea y configura automáticamente las 5 páginas base (**Inicio**, **Servicios**, **Nosotros**, **Galería** y **Contacto**) con sus plantillas correspondientes.
   - Carga por defecto todos los textos, fotografías, mapas de **EUROPARK II** y **Pedro Escobedo**, y enlaces verificados de ICAP para que el sitio luzca al 100% desde el primer segundo.
   - Activa las redirecciones 301 de las rutas heredadas del antiguo sistema en ASP.NET.

### Paso 3: Configurar Enlaces Permanentes
1. Ve a **Ajustes → Enlaces permanentes (Permalinks)**.
2. Selecciona la opción **«Nombre de la entrada» (`/%postname%/`)** y haz clic en **Guardar cambios**.
