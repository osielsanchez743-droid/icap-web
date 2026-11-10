# Proyecto ICAP Ingeniería — instrucciones para Codex

Sitio de referencia: https://icapmx.com/. Proyecto: rediseño profesional de una web corporativa para automatización e ingeniería industrial en México.

## Objetivo
Diseñar una interfaz moderna, rápida, responsive y accesible, conservando la identidad visual de ICAP (especialmente el naranja del logotipo original). El cliente debe poder editar únicamente contenido habitual (textos, imágenes, galerías y fichas de servicios/proyectos) desde un CMS, sin tocar código.

## Fuente de verdad
- Verificar textos, identidad visual, logo, fotografías y datos de contacto contra el sitio oficial y materiales autorizados.
- No inventar cifras, clientes, certificaciones, servicios, testimonios o fotografías de proyectos propios.
- Áreas confirmadas en el sitio: diseño mecánico, manufactura, eléctrico/neumático y control. No renombrar categorías sin validación.
- Si no se dispone del logo original, usar placeholder marcado e indicar el archivo que hace falta; no reproducirlo de memoria.

## Arquitectura y decisiones
- Antes de programar, inspeccionar los archivos existentes, identificar framework y preguntar solo si una decisión de arquitectura es imprescindible.
- La recomendación base es WordPress en hosting WordPress de Hostinger, con bloques o campos editables, si se necesita que el cliente cambie contenido sin código.
- No presentar una maqueta estática como si ya tuviera CMS. Si se crea una demo estática, separar explícitamente la fase de integración WordPress.
- No instalar dependencias, sobreescribir archivos, migrar, desplegar o publicar sin avisar y confirmar cuando haya riesgo de pérdida de datos.
- Mantener el código modular, semántico, documentado y preparado para mantenimiento.

## Estilo
- Naranja de marca extraído del logo autorizado, acompañado de grafito, blanco y grises neutros.
- Estética industrial premium: tipografía clara, espacio en blanco, fotografías auténticas, jerarquía tipográfica, cards sobrias y animaciones discretas.
- Evitar degradados excesivos, efectos genéricos y carruseles automáticos innecesarios.

## Calidad de entrega
- Mobile-first, sin scroll horizontal en anchos de 320, 375, 768, 1024 y 1440px.
- Navegación por teclado, contraste WCAG AA cuando sea viable, textos alternativos, botones accesibles y `prefers-reduced-motion`.
- Optimizar imágenes (WebP/AVIF cuando convenga), lazy loading fuera de hero y evitar layout shifts.
- Al terminar una tarea: informar archivos modificados, cómo probarlos y qué queda pendiente.

## Skills disponibles
- `.agents/skills/icap-diseno-ui/SKILL.md`
- `.agents/skills/icap-responsive-accesibilidad/SKILL.md`
- `.agents/skills/icap-wordpress-cms/SKILL.md`
