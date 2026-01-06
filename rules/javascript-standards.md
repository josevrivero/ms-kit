# REGLA: JAVASCRIPT CLEAN CODE ES6+

## CUÁNDO APLICA
- Auto-attach a archivos *.js
- Prioritario en lógica

## ESTRUCTURA

### 1. HEADER OBLIGATORIO
```javascript
/**
 * @file: form-validation.js
 * @description: Validación universal para formularios
 * @usage: new FormValidator('#booking-form');
 * @author: MEIKING SYSTEMS
 * @version: 1.0
 */

'use strict'; // Obligatorio

// ... resto del código
```

### 2. CLASES Y MÉTODOS
```javascript
class FormValidator {
  /**
   * Constructor
   * @param {string} formSelector - CSS selector
   */
  constructor(formSelector) {
    this.form = document.querySelector(formSelector);
    if (!this.form) {
      console.error(`Form not found: ${formSelector}`);
      return;
    }
  }

  /**
   * Validar campo específico
   * @param {HTMLElement} field - Input a validar
   * @returns {boolean} Es válido
   */
  validateField(field) {
    const type = field.dataset.validate;
    const value = field.value.trim();
    
    if (!type || !value) return false;
    
    return this.validators[type]?.(value) || false;
  }
}
```

### 3. VALIDACIÓN CON DATA ATTRIBUTES
```html
<!-- HTML con validación -->
<input 
  data-validate="email"          ← Define tipo
  data-required="true"           ← Parámetro
  placeholder="tu@email.com"
>
```

```javascript
// JS que lee los atributos
const validators = {
  email: (v) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),
  phone: (v) => /^[0-9\s\-\+\(\)]{9,}$/.test(v),
  text: (v) => v.length >= 3,
};
```

### 4. FETCH CON MANEJO ERRORES
```javascript
const submitForm = async (endpoint, formData) => {
  try {
    const response = await fetch(endpoint, {
      method: 'POST',
      body: formData,
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
    });

    if (!response.ok) throw new Error(`HTTP ${response.status}`);
    
    const data = await response.json();
    if (!data.success) throw new Error(data.message);
    
    return data;
    
  } catch (error) {
    console.error('Submit error:', error);
    throw error; // Propagar al llamador
  }
};
```

### 5. SEGURIDAD
- [ ] No usar `eval()`
- [ ] No usar `innerHTML` con user input
- [ ] Usar `textContent` para texto
- [ ] Escapar HTML si es necesario
- [ ] CSRF token en POST

### 6. VALIDACIÓN
- [ ] ESLint: 0 errores
- [ ] Máximo 30 líneas por función
- [ ] Máximo 300 líneas por archivo
- [ ] Nombres descriptivos (no a, b, x)