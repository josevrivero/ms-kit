/**
 * @file: form-submission.js
 * @description: Async form submission handler with standard API response parsing
 * @author: MS-KIT v1.0
 */

'use strict';

/**
 * Envía un formulario de manera asíncrona mediante Fetch API.
 * @param {HTMLFormElement} formElement - El elemento <form> a enviar.
 * @param {string} endpoint - URL de destino (API).
 * @returns {Promise<Object>} Respuesta del servidor parserada a JSON.
 */
async function submitForm(formElement, endpoint) {
    // 1. Validar argumentos
    if (!formElement || !endpoint) {
        throw new Error('FormSubmission: Faltan argumentos (formElement o endpoint)');
    }

    // Preparar UI (Loading state)
    const submitBtn = formElement.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn ? submitBtn.innerHTML : '';

    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
      <svg class="animate-spin h-5 w-5 mr-2 inline-block text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
      Enviando...
    `;
    }

    try {
        // 2. Preparar datos
        const formData = new FormData(formElement);

        // 3. Petición Fetch
        const response = await fetch(endpoint, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // Identifica petición AJAX para Backend
                'Accept': 'application/json'
            }
        });

        // 4. Parsear respuesta
        // Intentamos leer JSON incluso si status no es 200 (para leer errores del backend)
        const data = await response.json().catch(() => ({}));

        if (!response.ok || !data.success) {
            throw new Error(data.message || `Error del servidor (${response.status})`);
        }

        // 5. Manejo de Éxito
        showFeedback(formElement, 'success', data.message || '¡Formulario enviado correctamente!');
        formElement.reset(); // Limpiar formulario
        return data;

    } catch (error) {
        // 6. Manejo de Errores
        console.error('Submit Error:', error);
        showFeedback(formElement, 'error', error.message || 'Ha ocurrido un error inesperado. Por favor, inténtalo de nuevo.');
        throw error; // Propagar error para manejo externo si se necesita

    } finally {
        // 7. Restaurar UI
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        }
    }
}

/**
 * Muestra mensajes de estado (Toast o Inline)
 * @param {HTMLElement} form 
 * @param {'success'|'error'} type 
 * @param {string} message 
 */
function showFeedback(form, type, message) {
    // Buscar o crear contenedor de mensajes
    let feedbackBox = form.querySelector('.form-feedback');

    if (!feedbackBox) {
        feedbackBox = document.createElement('div');
        feedbackBox.className = 'form-feedback mt-4 p-4 rounded-lg hidden animate-fadeIn text-sm font-medium text-center';
        form.appendChild(feedbackBox); // Append al final del form
    }

    // Configurar estilos según tipo
    if (type === 'success') {
        feedbackBox.className = 'form-feedback mt-4 p-4 rounded-lg bg-green-50 text-green-700 border border-green-200 animate-fadeIn';
    } else {
        feedbackBox.className = 'form-feedback mt-4 p-4 rounded-lg bg-red-50 text-red-700 border border-red-200 animate-fadeIn';
    }

    feedbackBox.textContent = message;

    // Auto-ocultar después de 5s si es éxito
    if (type === 'success') {
        setTimeout(() => {
            feedbackBox.classList.add('hidden');
        }, 5000);
    }
}

// Exponer globalmente
window.submitForm = submitForm;
