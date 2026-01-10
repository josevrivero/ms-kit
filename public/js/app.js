/**
 * @file: app.js
 * @description: Main Application Logic (Mobile Menu, Scroll, Form Orchestration)
 * @author: MS-KIT v1.0
 */

"use strict";

document.addEventListener("DOMContentLoaded", () => {
  initMobileMenu();
  initSmoothScroll();
  initAuditForm();
  initRevealAnimations();
});

/* =========================================
   1. MOBILE MENU TOGGLE
   ========================================= */
function initMobileMenu() {
  const btn = document.querySelector("#mobile-menu-btn");
  const nav = document.querySelector("#mobile-nav");

  if (!btn || !nav) return;

  const toggleMenu = (show) => {
    if (show) {
      nav.classList.remove("hidden");
      btn.innerHTML =
        '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
      btn.setAttribute("aria-label", "Cerrar menú");
    } else {
      nav.classList.add("hidden");
      btn.innerHTML =
        '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>';
      btn.setAttribute("aria-label", "Abrir menú");
    }
  };

  btn.addEventListener("click", (e) => {
    e.stopPropagation();
    const isHidden = nav.classList.contains("hidden");
    toggleMenu(isHidden);
  });

  // Cerrar menú al hacer click en un enlace
  nav.addEventListener("click", (e) => {
    if (e.target.closest("a")) {
      toggleMenu(false);
    }
  });

  // Cerrar menú al hacer click fuera
  document.addEventListener("click", (e) => {
    if (!nav.contains(e.target) && !btn.contains(e.target)) {
      if (!nav.classList.contains("hidden")) {
        toggleMenu(false);
      }
    }
  });
}

/* =========================================
   2. SMOOTH SCROLL OFFSET
   ========================================= */
function initSmoothScroll() {
  // Ajuste para el header fijo al hacer click en anclas
  document.documentElement.style.scrollPaddingTop = "100px";
}

/* =========================================
   3. BOOKING FORM ORCHESTRATION
   ========================================= */
function initAuditForm() {
  const formSelector = "#audit-form";
  const form = document.querySelector(formSelector);

  if (!form) return;

  // Guardar URL de origen (evidencia para consentimientos / auditoría)
  const sourceUrlInput = form.querySelector("#source_url");
  if (sourceUrlInput) {
    sourceUrlInput.value = window.location.href;
  }

  // A. Inicializar Validador (Listener #1)
  // Se encargará de mostrar errores visuales y validar inputs
  new FormValidator(formSelector);

  // B. Inicializar Envío (Listener #2)
  form.addEventListener("submit", async (e) => {
    e.preventDefault(); // Stop standard submit

    // Pequeño hack: Verificar si el validador encontró errores
    // El validador corre primero porque se instanció antes (si el orden se respeta)
    // Check for specific error classes added by Validator
    const hasErrors = form.querySelectorAll(".input-error").length > 0;

    if (hasErrors) {
      // El validador ya se encargó de mostrar mensajes y hacer focus
      return;
    }

    // Si es válido, proceder al envío AJAX
    try {
      await submitForm(form, "api/submit-audit.php");
    } catch (error) {
      console.error("Submission failed caught in app.js", error);
    }
  });
}

/* =========================================
   4. REVEAL ANIMATIONS
   ========================================= */

function initRevealAnimations() {
  // Configuración del observador
  const observerOptions = {
    root: null,
    rootMargin: "0px",
    threshold: 0.15, // Se activa cuando el 15% del elemento es visible
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("active");
        observer.unobserve(entry.target); // Dejar de observar una vez animado
      }
    });
  }, observerOptions);

  // Seleccionar todos los elementos con la clase .reveal
  const revealElements = document.querySelectorAll(".reveal");
  revealElements.forEach((el) => observer.observe(el));
}
