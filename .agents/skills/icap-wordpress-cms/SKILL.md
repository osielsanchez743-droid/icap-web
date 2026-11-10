---
name: icap-wordpress-cms
description: Preparar o integrar el sitio de ICAP con WordPress alojado en Hostinger para que personal no técnico pueda editar textos, cambiar fotografías, añadir o quitar imágenes y actualizar proyectos sin programar. Utilizar al planear CMS, contenido editable, panel administrativo, temas o despliegue.
---

# WordPress y edición para cliente no técnico

## Meta
El diseñador/desarrollador controla la estructura y estilos; el cliente edita el contenido diario desde WordPress, sin modificar HTML/CSS/JS.

## Flujo
1. Inspecciona stack del proyecto antes de implementar. Si es React/estático, presenta rutas viables: tema personalizado de WordPress (preferida para mantenimiento simple), o frontend desacoplado con WordPress headless si hay razón técnica. No simules editabilidad del HTML estático.
2. Define inventario de campos editables:
   - Inicio: título, subtítulo, imagen hero, CTA.
   - Nosotros: descripción, misión, visión e imágenes.
   - Servicios: título, descripción, imagen, orden y detalles.
   - Proyectos/Galería: agregar, reordenar y eliminar imágenes, leyendas y categorías.
   - Contacto: teléfono, correo, dirección, enlace a WhatsApp si es autorizado.
3. Implementa contenido con bloques nativos de WordPress y, donde sea necesario, bloques personalizados o campos estructurados. Evita codificar textos o fotografías dentro de templates si deben cambiarse desde el panel.
4. Bloquea o limita edición de estilos/plantillas para rol Editor cuando corresponda y conserva la cuenta administrador para mantenimiento. No guardes credenciales en el repositorio.
5. Conserva URLs y planifica redirecciones 301 si cambia el mapa del sitio; configura SEO básico, SSL, copias de seguridad y formularios con protección antispam.
6. Usa plugins mínimos, mantenidos y confiables. Evita depender de complementos de pago sin aprobación.
7. Antes del despliegue, prueba en staging: cambiar texto, sustituir imagen, agregar foto, eliminar foto y comprobar resultado público en móvil/escritorio. Prueba permisos y recuperación de respaldo.
8. Genera una guía de una página para el cliente con capturas reales del panel cuando estén disponibles. Incluir ruta wp-admin y flujos de edición, pero nunca contraseñas.

## Criterios de aceptación
- El cliente puede editar textos e imágenes sin programar.
- El cliente no puede romper accidentalmente el diseño global con el rol de contenido acordado.
- Las modificaciones se reflejan en la web tras publicar/actualizar.
- El diseño responsive se conserva al agregar contenido y fotos nuevas.
