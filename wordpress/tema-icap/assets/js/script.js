/* Soporte dinámico para rutas de tema WordPress (ICAP_WP_CONFIG) */
const ICAP_THEME_URI = (window.ICAP_WP_CONFIG && window.ICAP_WP_CONFIG.themeUri) ? window.ICAP_WP_CONFIG.themeUri : '';
const ICAP_CONTACT_URL = (window.ICAP_WP_CONFIG && window.ICAP_WP_CONFIG.contactUrl) ? window.ICAP_WP_CONFIG.contactUrl : null;
const siteHeader = document.getElementById("site-header");
const menuButton = document.querySelector(".menu-toggle");
const nav = document.querySelector(".main-nav");
const themeToggle = document.getElementById("theme-toggle");
const themeLabel = document.getElementById("theme-label");
const themeMeta = document.querySelector('meta[name="theme-color"]');

/* Gestión de tema Claro / Oscuro */
function getActiveTheme() {
  return document.documentElement.getAttribute("data-theme") === "dark"
    ? "dark"
    : "light";
}

function applyTheme(theme, persist = false) {
  const normalized = theme === "dark" ? "dark" : "light";
  document.documentElement.setAttribute("data-theme", normalized);
  if (themeMeta) {
    themeMeta.setAttribute(
      "content",
      normalized === "dark" ? "#0e1114" : "#f2f3ef",
    );
  }
  if (themeToggle) {
    const isDark = normalized === "dark";
    themeToggle.setAttribute("aria-pressed", String(isDark));
    themeToggle.setAttribute(
      "aria-label",
      isDark ? "Cambiar a modo claro" : "Cambiar a modo oscuro",
    );
  }
  if (themeLabel) {
    themeLabel.textContent = normalized === "dark" ? "Claro" : "Oscuro";
  }
  if (persist) {
    try {
      localStorage.setItem("icap-theme", normalized);
    } catch {
      /* Ignorar si el navegador restringe almacenamiento */
    }
  }
}

applyTheme(getActiveTheme(), false);

if (themeToggle) {
  themeToggle.addEventListener("click", () => {
    const nextTheme = getActiveTheme() === "dark" ? "light" : "dark";
    applyTheme(nextTheme, true);
  });
}

/* Navegación móvil y cabecera fija */
function closeMenu() {
  if (!menuButton || !nav) return;
  menuButton.setAttribute("aria-expanded", "false");
  menuButton.setAttribute("aria-label", "Abrir menú de navegación");
  nav.classList.remove("is-open");
}

function updateHeaderScroll() {
  if (!siteHeader) return;
  siteHeader.classList.toggle("is-scrolled", window.scrollY > 16);
}

if (menuButton && nav) {
  menuButton.addEventListener("click", () => {
    const open = menuButton.getAttribute("aria-expanded") !== "true";
    menuButton.setAttribute("aria-expanded", String(open));
    menuButton.setAttribute(
      "aria-label",
      open ? "Cerrar menú de navegación" : "Abrir menú de navegación",
    );
    nav.classList.toggle("is-open", open);
  });

  nav
    .querySelectorAll("a")
    .forEach((link) => link.addEventListener("click", closeMenu));

  document.addEventListener("click", (event) => {
    if (!nav.contains(event.target) && !menuButton.contains(event.target)) {
      closeMenu();
    }
  });

  window
    .matchMedia("(min-width: 921px)")
    .addEventListener("change", (event) => {
      if (event.matches) closeMenu();
    });
}

window.addEventListener("scroll", updateHeaderScroll, { passive: true });
updateHeaderScroll();

/* Visor CAD interactivo en Hero (CAM 01, CAM 02, CAM 03) */
const heroViewportImg = document.getElementById("hero-viewport-img");
const heroViewportCaption = document.getElementById("hero-viewport-caption");
const heroViewportCode = document.getElementById("hero-viewport-code");
const heroSpecButtons = document.querySelectorAll(
  ".viewport-spec-item[data-hero-src]",
);

if (heroViewportImg && heroSpecButtons.length > 0) {
  heroSpecButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const nextSrc = btn.dataset.heroSrc;
      const nextCaption = btn.dataset.heroCaption;
      const nextCode = btn.dataset.heroCode;
      if (!nextSrc) return;

      heroSpecButtons.forEach((b) =>
        b.classList.toggle("is-active", b === btn),
      );
      heroViewportImg.style.opacity = "0.35";
      setTimeout(() => {
        heroViewportImg.src = nextSrc;
        if (heroViewportCaption && nextCaption)
          heroViewportCaption.textContent = nextCaption;
        if (heroViewportCode && nextCode)
          heroViewportCode.textContent = nextCode;
        heroViewportImg.style.opacity = "1";
      }, 140);
    });
  });
}

/* Animación sutil de aparición al hacer scroll */
const revealElements = document.querySelectorAll(
  ".service-card, .process-step, .brand-matrix-card, .pillar-card, .facility-card, .gallery-item, .service-detail-grid, .channel-card, .contact-form-card, .map-viewer-card",
);

if ("IntersectionObserver" in window && revealElements.length > 0) {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12, rootMargin: "0px 0px -30px 0px" },
  );

  revealElements.forEach((el) => {
    el.classList.add("reveal-on-scroll");
    observer.observe(el);
  });
}

/* Filtros de categoría en galeria */
const filterButtons = document.querySelectorAll(".filter-btn");
const filterableItems = document.querySelectorAll(
  ".gallery-grid-full .gallery-item",
);

if (filterButtons.length > 0 && filterableItems.length > 0) {
  filterButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const category = btn.dataset.filter || "all";
      filterButtons.forEach((b) => b.classList.toggle("is-active", b === btn));
      filterableItems.forEach((item) => {
        const match = category === "all" || item.dataset.category === category;
        item.hidden = !match;
      });
    });
  });
}

/* Galería interactiva con <dialog> accesible y ficha técnica lateral */
const galleryItems = (window.ICAP_WP_CONFIG && Array.isArray(window.ICAP_WP_CONFIG.gallery) && window.ICAP_WP_CONFIG.gallery.length > 0) ? window.ICAP_WP_CONFIG.gallery : [
  {
    src: "assets/taller.webp",
    alt: "Línea de estaciones automatizadas con estructuras de aluminio y paneles de control ICAP",
    title: "Estaciones de trabajo automatizadas",
    desc: "Estructuras en perfil de aluminio, control e iluminación integrada.",
    count: "01 / 06",
    area: "mecanico",
    tags: ["MECÁNICO", "ELÉCTRICO", "CONTROL"],
    specs: [
      "Estructura modular en perfil de aluminio anodizado con guardas de seguridad",
      "Paneles de control superiores con torretas de estado y botoneras industriales",
      "Iluminación LED integrada y rieles de alimentación para contenedores de línea",
    ],
  },
  {
    src: "assets/IngenieriaManufactura.webp",
    alt: "Detalle de estación industrial con manómetros, unidades de mantenimiento neumático y cableado estructurado",
    title: "Integración neumática y eléctrica",
    desc: "Unidades FRL, manómetros y canalización en estación de trabajo.",
    count: "02 / 06",
    area: "electrico",
    tags: ["NEUMÁTICO", "ELÉCTRICO", "PRUEBAS"],
    specs: [
      "Unidades de mantenimiento neumático (FRL) con regulación independiente",
      "Manómetros de carátula para monitoreo de presión por circuito de trabajo",
      "Canalización neumática identificada y botonera de mando frontal",
    ],
  },
  {
    src: "assets/galeria-5.webp",
    alt: "Banda transportadora industrial con paro de emergencia y gabinete inferior fotografiada en planta",
    title: "Equipo de proceso y transporte",
    desc: "Transportador modular con seguridad y control integrado.",
    count: "03 / 06",
    area: "control",
    tags: ["MECÁNICO", "CONTROL", "TRANSPORTE"],
    specs: [
      "Sistema de transporte modular con estructura de aluminio y niveladores",
      "Paro de emergencia accesible y botonera de arranque/paro en estación",
      "Gabinete inferior integrado para alojamiento de control y potencia",
    ],
  },
  {
    src: "assets/galeria-6.webp",
    alt: "Estación industrial con guarda de policarbonato, reguladores de presión y selectores neumáticos",
    title: "Estación con prueba neumática",
    desc: "Resguardo transparente, regulación por circuito y desfogue.",
    count: "04 / 06",
    area: "electrico",
    tags: ["NEUMÁTICO", "ESTANQUEIDAD", "SEGURIDAD"],
    specs: [
      "Guarda de policarbonato transparente para protección de operador en ciclo",
      "Banco de reguladores de presión y manómetros para prueba neumática",
      "Válvulas selectoras y circuito de desfogue controlado en panel frontal",
    ],
  },
  {
    src: "assets/IngenieriaMecanica.webp",
    alt: "Nave de ingeniería y área de ensamble de estaciones de trabajo de ICAP Ingeniería",
    title: "Nave de ingeniería y ensamble",
    desc: "Área de diseño e integración de estaciones en El Marqués, Querétaro.",
    count: "05 / 06",
    area: "mecanico",
    tags: ["EL MARQUÉS", "ENSAMBLE", "INGENIERÍA"],
    specs: [
      "Sede principal en Condominio Industrial EUROPARK II, El Marqués, Qro.",
      "Área de integración mecánica, armado eléctrico y pruebas FAT de estaciones",
      "Oficinas de ingeniería para diseño CAD 3D, simulación FEA y programación",
    ],
  },
  {
    src: "assets/IngenieriaAutomatizacion.webp",
    alt: "Área de maquinados de ICAP con centro de maquinado CNC y fresadoras convencionales",
    title: "Taller de maquinados",
    desc: "Equipamiento CNC y convencional en operación.",
    count: "06 / 06",
    area: "manufactura",
    tags: ["PEDRO ESCOBEDO", "MAQUINADO CNC", "MANUFACTURA"],
    specs: [
      "Planta de manufactura en Pedro Escobedo, Querétaro, con equipamiento propio",
      "Centros de maquinado CNC, tornos y fresadoras convencionales de precisión",
      "Fabricación de componentes metálicos, plásticos de ingeniería y herramentales",
    ],
  },
];

const lightbox = document.getElementById("gallery-lightbox");
const lightboxImg = document.getElementById("lightbox-img");
const lightboxTitle = document.getElementById("lightbox-title");
const lightboxDesc = document.getElementById("lightbox-desc");
const lightboxCounter = document.getElementById("lightbox-counter");
const lightboxTags = document.getElementById("lightbox-tags");
const lightboxSpecs = document.getElementById("lightbox-specs");
const lightboxQuoteLink = document.getElementById("lightbox-quote-link");
const lightboxClose = document.getElementById("lightbox-close");
const lightboxPrev = document.getElementById("lightbox-prev");
const lightboxNext = document.getElementById("lightbox-next");

let currentGalleryIndex = 0;
let lastTriggerButton = null;

function renderLightboxItem(index) {
  currentGalleryIndex = (index + galleryItems.length) % galleryItems.length;
  const item = galleryItems[currentGalleryIndex];
  if (!lightboxImg) return;
  lightboxImg.src = item.src;
  lightboxImg.alt = item.alt;
  lightboxTitle.textContent = item.title;
  lightboxDesc.textContent = item.desc;
  lightboxCounter.textContent = item.count;

  if (lightboxTags && Array.isArray(item.tags)) {
    lightboxTags.innerHTML = item.tags
      .map((t) => `<span class="gallery-tag">[${t}]</span>`)
      .join("");
  }
  if (lightboxSpecs && Array.isArray(item.specs)) {
    lightboxSpecs.innerHTML = item.specs.map((s) => `<li>${s}</li>`).join("");
  }
  if (lightboxQuoteLink) {
    const isHtmlPage = window.location.pathname.endsWith(".html");
    const contactBase = isHtmlPage ? "contacto.html" : "contacto.php";
    lightboxQuoteLink.href = `${contactBase}?area=${encodeURIComponent(item.area || "mecanico")}`;
  }
}

if (lightbox) {
  document.querySelectorAll("button.gallery-trigger").forEach((button) => {
    button.addEventListener("click", () => {
      const index = Number(button.dataset.index || 0);
      lastTriggerButton = button;
      renderLightboxItem(index);
      if (typeof lightbox.showModal === "function") {
        lightbox.showModal();
      }
    });
  });

  lightboxClose?.addEventListener("click", () => lightbox.close());
  lightboxPrev?.addEventListener("click", () =>
    renderLightboxItem(currentGalleryIndex - 1),
  );
  lightboxNext?.addEventListener("click", () =>
    renderLightboxItem(currentGalleryIndex + 1),
  );

  lightbox.addEventListener("click", (event) => {
    if (event.target === lightbox) {
      lightbox.close();
    }
  });

  lightbox.addEventListener("close", () => {
    if (lastTriggerButton) {
      lastTriggerButton.focus();
    }
  });
}

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    closeMenu();
  }
  if (lightbox && lightbox.open) {
    if (event.key === "ArrowLeft") {
      event.preventDefault();
      renderLightboxItem(currentGalleryIndex - 1);
    } else if (event.key === "ArrowRight") {
      event.preventDefault();
      renderLightboxItem(currentGalleryIndex + 1);
    }
  }
});

/* Botón para copiar correo electrónico */
const copyEmailBtn = document.getElementById("copy-email-btn");
const copyFeedback = document.getElementById("copy-feedback");

if (copyEmailBtn && copyFeedback) {
  copyEmailBtn.addEventListener("click", async () => {
    const email = copyEmailBtn.dataset.email || "julio.dejesus@icapmx.com";
    try {
      await navigator.clipboard.writeText(email);
      copyFeedback.textContent = "✓ Correo copiado al portapapeles";
      setTimeout(() => {
        copyFeedback.textContent = "";
      }, 3200);
    } catch {
      copyFeedback.textContent = email;
    }
  });
}

/* Selector de sede en el Visor Cartográfico de Contacto */
const mapTabs = document.querySelectorAll(".map-tab-btn[data-embed]");
const mapIframe = document.getElementById("icap-map-iframe");
const mapCoords = document.getElementById("icap-map-coords");
const mapExternal = document.getElementById("icap-map-external");

if (mapTabs.length > 0 && mapIframe) {
  mapTabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      const embedUrl = tab.dataset.embed;
      const coords = tab.dataset.coords;
      const mapsUrl = tab.dataset.maps;
      if (!embedUrl) return;

      mapTabs.forEach((t) => {
        const active = t === tab;
        t.classList.toggle("is-active", active);
        t.setAttribute("aria-selected", String(active));
      });

      if (mapIframe.src !== embedUrl) {
        mapIframe.src = embedUrl;
      }
      if (mapCoords && coords) mapCoords.textContent = coords;
      if (mapExternal && mapsUrl) mapExternal.href = mapsUrl;
    });
  });
}

/* Preselección de especialidad desde ?area= en contacto */
const areaSelect = document.getElementById("f-area");
if (areaSelect) {
  const params = new URLSearchParams(window.location.search);
  const areaParam = params.get("area");
  const map = {
    mecanico: "Diseño Mecánico / Estaciones de trabajo",
    manufactura: "Manufactura / Maquinado CNC",
    electrico: "Sistemas Eléctricos y Neumáticos",
    control: "Control, PLC y Robótica",
  };
  if (areaParam && map[areaParam]) {
    areaSelect.value = map[areaParam];
  }
}

/* Formulario estructurado de solicitud técnica y modal de canales directos */
const projectForm = document.getElementById("project-form");
const quoteDialog = document.getElementById("quote-send-dialog");
const optWa = document.getElementById("dialog-opt-wa");
const optGmail = document.getElementById("dialog-opt-gmail");
const optOutlook = document.getElementById("dialog-opt-outlook");
const optMailto = document.getElementById("dialog-opt-mailto");
const optCopy = document.getElementById("dialog-opt-copy");
const copyLabel = document.getElementById("dialog-copy-label");
const closeDialogBtn = document.getElementById("dialog-close-btn");

let currentQuoteText = "";

if (projectForm) {
  projectForm.addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(projectForm);
    const nombre = (formData.get("nombre") || "").toString().trim();
    const empresa = (formData.get("empresa") || "").toString().trim();
    const correo = (formData.get("correo") || "").toString().trim();
    const telefono = (formData.get("telefono") || "").toString().trim();
    const area = (formData.get("area") || "").toString().trim();
    const planos = (
      formData.get("planos") ||
      "Cuento con planos / modelos 3D (.STEP, .DXF, .PDF)"
    )
      .toString()
      .trim();
    const mensaje = (formData.get("mensaje") || "").toString().trim();

    const subjectRaw = `Solicitud técnica [${area}] - ${empresa}`;
    const bodyLines = [
      "Hola equipo de ICAP Ingeniería,",
      "",
      "Comparto los datos de nuestro requerimiento técnico:",
      `• Nombre: ${nombre}`,
      `• Empresa / Planta: ${empresa}`,
      `• Correo: ${correo}`,
      `• Teléfono: ${telefono || "No especificado"}`,
      `• Especialidad requerida: ${area}`,
      `• Documentación / Planos: ${planos}`,
      "",
      "Descripción del proyecto:",
      mensaje,
    ];
    currentQuoteText = bodyLines.join("\n");

    const subjectEnc = encodeURIComponent(subjectRaw);
    const bodyEnc = encodeURIComponent(currentQuoteText);

    // 1. Enlace para WhatsApp
    if (optWa) {
      const waText = encodeURIComponent(
        `*SOLICITUD TÉCNICA ICAP*\n` +
          `*Empresa:* ${empresa}\n` +
          `*Contacto:* ${nombre}\n` +
          `*Correo:* ${correo}\n` +
          `*Tel:* ${telefono || "N/A"}\n` +
          `*Área:* ${area}\n` +
          `*Planos / CAD:* ${planos}\n\n` +
          `*Detalle del proyecto:*\n${mensaje}`,
      );
      optWa.href = `https://wa.me/524462136128?text=${waText}`;
    }

    // 2. Enlace directo para redactar en Gmail Web
    if (optGmail) {
      optGmail.href = `https://mail.google.com/mail/?view=cm&fs=1&to=julio.dejesus@icapmx.com&su=${subjectEnc}&body=${bodyEnc}`;
    }

    // 3. Enlace directo para redactar en Outlook Web
    if (optOutlook) {
      optOutlook.href = `https://outlook.office.com/mail/deeplink/compose?to=julio.dejesus@icapmx.com&subject=${subjectEnc}&body=${bodyEnc}`;
    }

    // 4. Enlace para cliente de correo del sistema (mailto)
    if (optMailto) {
      optMailto.href = `mailto:julio.dejesus@icapmx.com?subject=${subjectEnc}&body=${bodyEnc}`;
    }

    // Mostrar el cuadro de diálogo
    if (quoteDialog && typeof quoteDialog.showModal === "function") {
      quoteDialog.showModal();
    } else if (optGmail) {
      // Fallback si el navegador no soporta dialog
      window.open(optGmail.href, "_blank");
    }
  });
}

// Botón para copiar texto dentro del modal
if (optCopy && copyLabel) {
  optCopy.addEventListener("click", async () => {
    try {
      await navigator.clipboard.writeText(currentQuoteText);
      copyLabel.textContent = "✓ Texto copiado al portapapeles";
      setTimeout(() => {
        copyLabel.textContent = "Copiar texto completo de la solicitud";
      }, 3500);
    } catch {
      copyLabel.textContent = "Selecciona y copia manualmente";
    }
  });
}

// Cerrar el modal
if (closeDialogBtn && quoteDialog) {
  closeDialogBtn.addEventListener("click", () => quoteDialog.close());
  quoteDialog.addEventListener("click", (event) => {
    if (event.target === quoteDialog) {
      quoteDialog.close();
    }
  });
}
