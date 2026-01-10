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

    // Variable para almacenar la respuesta (disponible en catch si se lee)
    let responseText = '';
    
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
        // Leer respuesta una sola vez (el stream solo puede leerse una vez)
        responseText = await response.text();
        
        // Intentar parsear JSON
        let data = {};
        try {
            data = JSON.parse(responseText);
        } catch (e) {
            console.error('Error parsing JSON response:', e);
            console.error('Response text:', responseText);
            throw new Error('Error al procesar la respuesta del servidor.');
        }

        // 5. Validar respuesta del servidor
        // El backend devuelve success (boolean) y message (string)
        
        if (!response.ok || data.success === false || data.success === undefined) {
            // Si hay errores específicos de validación, mostrarlos
            if (data.errors && typeof data.errors === 'object' && Object.keys(data.errors).length > 0) {
                const firstError = Object.values(data.errors)[0];
                throw new Error(firstError || data.message || `Error del servidor (${response.status})`);
            }
            throw new Error(data.message || `Error del servidor (${response.status})`);
        }

        // 6. Manejo de Éxito
        showFeedback(formElement, 'success', data.message || '¡Formulario enviado correctamente!');
        formElement.reset(); // Limpiar formulario
        return data;

    } catch (error) {
        // 7. Manejo de Errores
        console.error('Submit Error:', error);
        console.error('Error details:', {
            message: error.message,
            stack: error.stack
        });
        // responseText está disponible desde el scope superior si se leyó antes del error
        if (responseText) {
            console.error('Response text:', responseText);
        }
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
