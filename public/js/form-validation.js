/**
 * @file: form-validation.js
 * @description: Lightweight, dependency-free form validation
 * @usage: new FormValidator('#my-form');
 */

'use strict';

class FormValidator {
    constructor(selector) {
        this.form = document.querySelector(selector);

        if (!this.form) {
            console.warn(`FormValidator: No form found for selector "${selector}"`);
            return;
        }

        this.inputs = this.form.querySelectorAll('[data-validate]');
        this.bindEvents();
    }

    // =========================================
    // CORE VALIDATORS
    // =========================================
    validators = {
        email: (val) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val),

        // Admite formatos internacionales o 9 dígitos españoles sin prefijo
        phone: (val) => /^(\+34|0034)? ?[6789]\d{8}$/.test(val.replace(/[\s-]/g, '')),

        // Texto genérico con longitud mínima opcional (default 3)
        text: (val, el) => {
            const min = parseInt(el.dataset.minLength || 3);
            return val.length >= min;
        },

        // Fecha debe ser POSTERIOR a hoy (mañana en adelante)
        date: (val) => {
            const inputDate = new Date(val);
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Reset time to start of day

            // Comparar timestamps para asegurar que sea estrictamente mayor
            return inputDate > today;
        }
    };

    messages = {
        email: 'Por favor, introduce un email válido',
        phone: 'Introduce un teléfono válido (ej. +34 600...)',
        text: 'Este campo es obligatorio y debe ser válido',
        date: 'Selecciona una fecha válida (futura)',
        required: 'Este campo es obligatorio'
    };

    // =========================================
    // EVENT BINDING
    // =========================================
    bindEvents() {
        // Validación al enviar
        this.form.addEventListener('submit', (e) => {
            let isValid = true;
            this.inputs.forEach(input => {
                if (!this.validateField(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
                // Scroll al primer error
                const firstError = this.form.querySelector('.input-error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });

        // Validación en tiempo real (blur)
        this.inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));

            // Limpiar error al escribir
            input.addEventListener('input', () => {
                if (input.classList.contains('input-error')) {
                    this.clearError(input);
                }
            });
        });
    }

    // =========================================
    // LOGIC
    // =========================================
    validateField(input) {
        const type = input.dataset.validate;
        const isRequired = input.hasAttribute('required');
        const value = input.value.trim();

        // 1. Check Required
        if (isRequired && !value) {
            this.showError(input, this.messages.required);
            return false;
        }

        // 2. Si está vacío y no es required, es válido (opcional)
        if (!isRequired && !value) {
            this.clearError(input);
            return true;
        }

        // 3. Check Validator
        if (this.validators[type]) {
            const isValid = this.validators[type](value, input);
            if (!isValid) {
                this.showError(input, this.messages[type]);
                return false;
            }
        }

        this.clearError(input);
        return true;
    }

    // =========================================
    // UI FEEDBACK
    // =========================================
    showError(input, message) {
        this.clearError(input); // Evitar duplicados

        input.classList.add('input-error', 'border-red-500');

        // Crear elemento de mensaje
        const errorMsg = document.createElement('p');
        errorMsg.className = 'text-red-500 text-xs mt-1 error-message flex items-center gap-1 animate-fadeIn';
        // Icono SVG simple inline (exclamación)
        errorMsg.innerHTML = `
      <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
      <span>${message}</span>
    `;

        input.parentElement.appendChild(errorMsg);
    }

    clearError(input) {
        input.classList.remove('input-error', 'border-red-500');
        const existingMsg = input.parentElement.querySelector('.error-message');
        if (existingMsg) {
            existingMsg.remove();
        }
    }
}

// Inicialización automática si existe el ID predeterminado (opcional)
// O dejar que app.js lo inicialice
window.FormValidator = FormValidator;
