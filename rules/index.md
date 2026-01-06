# MEIKING SYSTEMS - Landing Pages Kit v1.0
## Sistema de Reglas IA para Desarrollo Modular

### CONTEXTO EMPRESARIAL
**Usuario**: Systems Engineer + Graphic Designer, 10+ años experiencia  
**Objetivo**: Landing pages profesionales para sectores diversos (clínicas, salones, restaurantes)  
**Modelo**: Entregar 2-3 landings/semana con máxima reutilización  
**Estándar**: Excelencia técnica, clean code, security-first

### TECH STACK - FASE 1

Frontend:  HTML5 semántico + Tailwind CSS + JavaScript ES6+
Backend:   PHP vanilla (sin frameworks)
Database:  MySQL/PostgreSQL
Payments:  Stripe
Build:     Vite (opcional)


### PRINCIPIOS ARQUITECTURA
1. **Modularidad**: Cada funcionalidad = archivo separado
2. **Reutilización**: 100% comentado para copy-paste entre proyectos
3. **Escalabilidad**: Soporta 100+ clientes sin repensar arquitectura

### CONVENTIONS

**Naming:**
- Archivos: kebab-case (form-validation.js)
- Clases CSS: camelCase o snake_case
- Variables JS: camelCase
- Constantes: SCREAMING_SNAKE_CASE
- Variables CSS: kebab-case (--color-primary)

**Code Style:**
- 2 espacios indentación
- Máximo 80 caracteres línea (documentación)
- Máximo 100 caracteres línea (código)
- Comentarios para funciones complejas

**Seguridad:**
- CSRF protection obligatorio en formularios
- Validación dual (frontend + backend)
- Prepared statements en BD
- Sanitización de inputs
- Rate limiting en endpoints

**Performance:**
- Lighthouse: 90+ en todos los aspectos
- Core Web Vitals: Green
- CSS/JS minificado en producción
- Imágenes optimizadas (WebP)


### ESTRUCTURA CARPETAS (MANDATORY)

proyecto/
├── public/              ← Lo que se sirve al navegador
│   ├── index.html
│   ├── css/            ← Estilos separados por responsabilidad
│   │   ├── variables.css    ← Tokens (colores, espacios, tipografía)
│   │   ├── base.css         ← Reset y estilos globales
│   │   ├── components.css   ← Componentes (botones, cards, etc)
│   │   └── animations.css   ← Transiciones y keyframes
│   └── js/             ← Scripts separados por funcionalidad
│       ├── app.js            ← Inicialización y orquestación
│       ├── form-validation.js ← Validación cliente
│       ├── form-submission.js ← Envío a backend
│       └── payment-init.js   ← Stripe/PayPal
├── src/                 ← Backend PHP
│   ├── config/         ← Configuración (DB, Stripe, env)
│   ├── handlers/       ← Lógica (formularios, pagos)
│   ├── middleware/     ← Seguridad (CSRF, rate-limit)
│   └── utils/          ← Funciones compartidas
└── components/         ← Componentes para reutilizar (copy-paste)