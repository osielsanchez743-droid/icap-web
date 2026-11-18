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

/* Animación sutil de aparición al hacer scroll */
const revealElements = document.querySelectorAll(
  ".service-card, .pillar-card, .facility-card, .gallery-item, .service-detail-grid, .channel-card, .contact-form-card, .map-viewer-card",
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

/* Galería interactiva con <dialog> accesible */
const galleryItems = [
  {
    src: "assets/img/taller.webp",
    alt: "Línea de estaciones automatizadas con estructuras de aluminio y paneles de control",
    title: "Estaciones de trabajo",
    count: "01 / 06",
  },
  {
    src: "assets/img/IngenieriaManufactura.webp",
    alt: "Detalle de equipo industrial con componentes neumáticos",
    title: "Integración industrial",
    count: "02 / 06",
  },
  {
    src: "assets/img/galeria-5.webp",
    alt: "Banda transportadora industrial fotografiada en taller",
    title: "Equipo de proceso",
    count: "03 / 06",
  },
  {
    src: "assets/img/galeria-6.webp",
    alt: "Estación industrial con resguardo transparente y conexiones neumáticas",
    title: "Detalle de estación",
    count: "04 / 06",
  },
  {
    src: "assets/img/IngenieriaMecanica.webp",
    alt: "Nave de ingeniería y área de ensamble de ICAP Ingeniería",
    title: "Área de ensamble",
    count: "05 / 06",
  },
  {
    src: "assets/img/IngenieriaAutomatizacion.webp",
    alt: "Área de maquinados de ICAP con equipo y personal en operación",
    title: "Taller de maquinados",
    count: "06 / 06",
  },
];

const lightbox = document.getElementById("gallery-lightbox");
const lightboxImg = document.getElementById("lightbox-img");
const lightboxTitle = document.getElementById("lightbox-title");
const lightboxCounter = document.getElementById("lightbox-counter");
const lightboxClose = document.getElementById("lightbox-close");
const lightboxPrev = document.getElementById("lightbox-prev");
const lightboxNext = document.getElementById("lightbox-next");

let currentGalleryIndex = 0;
let lastTriggerButton = null;

function renderLightboxItem(index) {
  currentGalleryIndex = (index + galleryItems.length) % galleryItems.length;
  const item = galleryItems[currentGalleryIndex];
  if (!lightboxImg) return;
  const isSubfolderHtml = window.location.pathname
    .replace(/\\/g, "/")
    .includes("/maqueta-html/");
  lightboxImg.src =
    isSubfolderHtml && item.src.startsWith("assets/")
      ? `../${item.src}`
      : item.src;
  lightboxImg.alt = item.alt;
  if (lightboxTitle) lightboxTitle.textContent = item.title;
  if (lightboxCounter) lightboxCounter.textContent = item.count;
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
      copyFeedback.textContent = "✓ Correo copiado";
      setTimeout(() => {
        copyFeedback.textContent = "";
      }, 3200);
    } catch {
      copyFeedback.textContent = email;
    }
  });
}

/* Selector de sede en el Mapa de Contacto */
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
    mecanico: "Diseño Mecánico",
    manufactura: "Manufactura",
    electrico: "Eléctrico / Neumático",
    control: "Control",
  };
  if (areaParam && map[areaParam]) {
    areaSelect.value = map[areaParam];
  }
}

/* Formulario de contacto y modal de canales directos */
const projectForm = document.getElementById("project-form");
const quoteDialog = document.getElementById("quote-send-dialog");
const optWa = document.getElementById("dialog-opt-wa");
const optGmail = document.getElementById("dialog-opt-gmail");
const optOutlook = document.getElementById("dialog-opt-outlook");
const optMailto = document.getElementById("dialog-opt-mailto");
const closeDialogBtn = document.getElementById("dialog-close-btn");

if (projectForm) {
  projectForm.addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(projectForm);
    const nombre = (formData.get("nombre") || "").toString().trim();
    const empresa = (formData.get("empresa") || "").toString().trim();
    const correo = (formData.get("correo") || "").toString().trim();
    const telefono = (formData.get("telefono") || "").toString().trim();
    const area = (formData.get("area") || "").toString().trim();
    const mensaje = (formData.get("mensaje") || "").toString().trim();

    const subjectRaw = `Consulta [${area}] - ${empresa}`;
    const bodyLines = [
      "Hola ICAP Ingeniería,",
      "",
      `• Nombre: ${nombre}`,
      `• Empresa: ${empresa}`,
      `• Correo: ${correo}`,
      `• Teléfono: ${telefono || "No especificado"}`,
      `• Área: ${area}`,
      "",
      "Mensaje:",
      mensaje,
    ];
    const bodyText = bodyLines.join("\n");

    const subjectEnc = encodeURIComponent(subjectRaw);
    const bodyEnc = encodeURIComponent(bodyText);

    if (optWa) {
      const waText = encodeURIComponent(
        `*CONSULTA ICAP INGENIERÍA*\n` +
          `*Empresa:* ${empresa}\n` +
          `*Nombre:* ${nombre}\n` +
          `*Correo:* ${correo}\n` +
          `*Tel:* ${telefono || "N/A"}\n` +
          `*Área:* ${area}\n\n` +
          `*Mensaje:*\n${mensaje}`,
      );
      optWa.href = `https://wa.me/524462136128?text=${waText}`;
    }

    if (optGmail) {
      optGmail.href = `https://mail.google.com/mail/?view=cm&fs=1&to=julio.dejesus@icapmx.com&su=${subjectEnc}&body=${bodyEnc}`;
    }

    if (optOutlook) {
      optOutlook.href = `https://outlook.office.com/mail/deeplink/compose?to=julio.dejesus@icapmx.com&subject=${subjectEnc}&body=${bodyEnc}`;
    }

    if (optMailto) {
      optMailto.href = `mailto:julio.dejesus@icapmx.com?subject=${subjectEnc}&body=${bodyEnc}`;
    }

    if (quoteDialog && typeof quoteDialog.showModal === "function") {
      quoteDialog.showModal();
    } else if (optGmail) {
      window.open(optGmail.href, "_blank");
    }
  });
}

if (closeDialogBtn && quoteDialog) {
  closeDialogBtn.addEventListener("click", () => quoteDialog.close());
  quoteDialog.addEventListener("click", (event) => {
    if (event.target === quoteDialog) {
      quoteDialog.close();
    }
  });
}
