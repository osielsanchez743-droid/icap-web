---
name: icap-responsive-accesibilidad
description: Revisar y mejorar la experiencia responsive y accesible del sitio ICAP para celular, tableta y computadora. Utilizar al crear o modificar layouts, navegación, galerías, formularios y componentes interactivos.
---

# Responsive, rendimiento y accesibilidad

1. Trabaja mobile-first y prueba anchos de 320, 375, 390, 768, 1024 y 1440px; comprueba también zoom de 200%.
2. Evita desbordamiento horizontal, alturas rígidas, texto cortado y botones demasiado pequeños. Menú móvil accesible, desplegable que cierra correctamente y navegación por teclado.
3. Usa grid/flex y `clamp()` de forma prudente, contenedores fluidos y tamaños mínimos de interacción apropiados.
4. Emplea etiquetas semánticas, estructura de encabezados coherente, contraste suficiente, alt descriptivos, foco visible y etiquetas en formularios.
5. Para galerías: imágenes con dimensiones, carga diferida salvo contenido LCP, control usable mediante toque/teclado y subtítulos editables cuando corresponda.
6. Respeta `prefers-reduced-motion`; evita animaciones innecesarias y parallax invasivo.
7. Inspecciona Lighthouse y herramientas disponibles en el repositorio cuando sea posible; no declares resultados de pruebas que no se ejecutaron.
8. Reporta los puntos de ruptura probados, fallos corregidos y riesgos pendientes.
