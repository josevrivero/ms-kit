/**
 * @file: app.js
 * @description: Main Application Logic (Mobile Menu, Scroll, Form Orchestration)
 * @author: MS-KIT v1.0
 */

'use strict';

document.addEventListener('DOMContentLoaded', () => {
    initMobileMenu();
    initSmoothScroll();
    initBookingForm();
});

/* =========================================
   1. MOBILE MENU TOGGLE
   ========================================= */
function initMobileMenu() {
    const btn = document.querySelector('button[aria-label="Abrir menú"]');
    const nav = document.querySelector('header nav');

    if (!btn || !nav) return;

    btn.addEventListener('click', () => {
        // Toggle de clases para mostrar/ocultar
        nav.classList.toggle('hidden');
        nav.classList.toggle('absolute');
        nav.classList.toggle('top-full');
        nav.classList.toggle('left-0');
        nav.classList.toggle('w-full');
        nav.classList.toggle('bg-white');
        nav.classList.toggle('border-t');
        nav.classList.toggle('flex-col');
        nav.classList.toggle('p-6');
        nav.classList.toggle('shadow-lg');

        // Toggle icon (Simple swap logic)
        const isOpen = nav.classList.contains('absolute');
        btn.innerHTML = isOpen
            ? '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
            : '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>';
    });

    // Cerrar menú al hacer click en un enlace
    nav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            if (nav.classList.contains('absolute')) {
                btn.click(); // Simular click para cerrar
            }
        });
    });
}

/* =========================================
   2. SMOOTH SCROLL OFFSET
   ========================================= */
function initSmoothScroll() {
    // Ajuste para el header fijo al hacer click en anclas
    document.documentElement.style.scrollPaddingTop = '100px';
}

/* =========================================
   3. BOOKING FORM ORCHESTRATION
   ========================================= */
function initBookingForm() {
    const formSelector = '#booking-form';
    const form = document.querySelector(formSelector);

    if (!form) return;

    // A. Inicializar Validador (Listener #1)
    // Se encargará de mostrar errores visuales y validar inputs
    new FormValidator(formSelector);

    // B. Inicializar Envío (Listener #2)
    form.addEventListener('submit', async (e) => {
        e.preventDefault(); // Stop standard submit

        // Pequeño hack: Verificar si el validador encontró errores
        // El validador corre primero porque se instanció antes (si el orden se respeta)
        // Check for specific error classes added by Validator
        const hasErrors = form.querySelectorAll('.input-error').length > 0;

        if (hasErrors) {
            // El validador ya se encargó de mostrar mensajes y hacer focus
            return;
        }

        // Si es válido, proceder al envío AJAX
        try {
            await submitForm(form, '/api/submit-booking.php'); // URL relativa ficticia

            // Opcional: Cerrar modal si existiera, o scroll top
            // alert('Gracias por tu reserva'); 
        } catch (error) {
            // El manejo de errores UI ya lo hace submitForm
            console.error('Submission failed caught in app.js', error);
        }
    });

    // C. Auto-fill de inputs si vienen por URL (ej. ?treatment=botox)
    const urlParams = new URLSearchParams(window.location.search);
    const treatment = urlParams.get('treatment');
    if (treatment) {
        const select = form.querySelector('select[name="treatment"]');
        if (select) select.value = treatment;
    }
}
