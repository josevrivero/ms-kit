<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Transforma tu belleza en nuestra Clínica Estética Premium. Especialistas en Botox, Rellenos y Peeling.">
  <title>Clínica Estética Premium | Tratamientos Faciales</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="css/tailwind.css">
  <link rel="stylesheet" href="css/variables.css">
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/animations.css">


  <!-- Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap"
    rel="stylesheet">

</head>

<body class="bg-gray-50 text-gray-800 antialiased">

  <!-- HEADER -->
  <header class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur-md shadow-sm transition-all duration-300">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <a href="#" class="text-2xl font-bold text-[--color-secondary]" aria-label="Inicio Clínica Estética">
        Estética<span class="text-[--color-primary]">Premium</span>
      </a>

      <!-- Desktop Navigation -->
      <nav class="hidden md:flex md:flex-row space-x-8">
        <a href="#inicio"
          class="text-gray-600 hover:text-[--color-primary] transition-colors font-medium">Inicio</a>
        <a href="#servicios"
          class="text-gray-600 hover:text-[--color-primary] transition-colors font-medium">Servicios</a>
        <a href="#testimonios"
          class="text-gray-600 hover:text-[--color-primary] transition-colors font-medium">Testimonios</a>
        <a href="#contacto"
          class="text-gray-600 hover:text-[--color-primary] transition-colors font-medium">Contacto</a>
      </nav>

      <!-- Desktop CTA Button -->
      <a href="#contacto"
        class="hidden md:inline-block px-6 py-2 bg-[--color-primary] text-white rounded-full font-semibold hover:opacity-90 transition-opacity shadow-lg">
        Reservar Cita
      </a>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-btn" class="md:hidden text-gray-600 focus:outline-none" aria-label="Abrir menú">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
          </path>
        </svg>
      </button>
    </div>

    <!-- Mobile Navigation Menu -->
    <nav id="mobile-nav" class="hidden absolute top-full left-0 w-full bg-white border-t border-gray-200 shadow-xl z-50">
      <div class="container mx-auto px-6 py-4 flex flex-col space-y-4">
        <a href="#inicio"
          class="text-gray-600 hover:text-[--color-primary] transition-colors font-medium py-2 block">Inicio</a>
        <a href="#servicios"
          class="text-gray-600 hover:text-[--color-primary] transition-colors font-medium py-2 block">Servicios</a>
        <a href="#testimonios"
          class="text-gray-600 hover:text-[--color-primary] transition-colors font-medium py-2 block">Testimonios</a>
        <a href="#contacto"
          class="text-gray-600 hover:text-[--color-primary] transition-colors font-medium py-2 block">Contacto</a>
        <a href="#contacto"
          class="mt-4 px-6 py-3 bg-[--color-primary] text-white rounded-full font-semibold hover:opacity-90 transition-opacity shadow-lg text-center block">
          Reservar Cita
        </a>
      </div>
    </nav>
  </header>

  <main class="pt-20">
    <!-- HERO SECTION -->
    <section id="inicio" class="relative py-20 lg:py-32 overflow-hidden flex items-center">
      <div class="absolute inset-0 z-0 bg-gradient-to-r from-gray-50 to-gray-100"></div>

      <div class="container mx-auto px-6 relative z-10 grid lg:grid-cols-2 gap-12 items-center">
        <div class="text-center lg:text-left space-y-6">
          <h1 class="text-4xl lg:text-6xl font-bold text-[--color-secondary] leading-tight">
            Descubre tu mejor versión con <span class="text-[--color-primary]">Ciencia y Arte</span>
          </h1>
          <p class="text-lg text-gray-600 max-w-2xl mx-auto lg:mx-0">
            Tratamientos estéticos avanzados personalizados para realzar tu belleza natural. Tecnología de
            vanguardia y profesionales expertos.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
            <a href="#contacto"
              class="px-8 py-4 bg-[--color-secondary] text-white rounded-lg font-semibold hover:bg-gray-800 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-1">
              Agendar Consulta
            </a>
            <a href="#servicios"
              class="px-8 py-4 border-2 border-[--color-secondary] text-[--color-secondary] rounded-lg font-semibold hover:bg-[--color-secondary] hover:text-white transition-all">
              Ver Tratamientos
            </a>
          </div>
        </div>

        <div class="relative hidden lg:block">
          <!-- Placeholder image matching aesthetic theme -->
          <div
            class="rounded-2xl overflow-hidden shadow-2xl bg-gray-200 aspect-[4/3] flex items-center justify-center">
            <span class="text-gray-400 font-medium">Imagen Hero: Rostro Radiante</span>
          </div>
          <!-- Decorative elements -->
          <div
            class="absolute -bottom-6 -left-6 w-24 h-24 bg-[--color-primary] rounded-full opacity-20 blur-xl">
          </div>
          <div
            class="absolute -top-6 -right-6 w-32 h-32 bg-[--color-secondary] rounded-full opacity-10 blur-xl">
          </div>
        </div>
      </div>
    </section>

    <!-- SERVICES SECTION -->
    <section id="servicios" class="py-20 bg-white">
      <div class="container mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-16">
          <h2 class="text-3xl lg:text-4xl font-bold text-[--color-secondary] mb-4">Nuestros Tratamientos</h2>
          <p class="text-gray-600">Soluciones estéticas de mínima invasión con resultados inmediatos y
            naturales.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Card 1: Botox -->
          <article
            class="group bg-gray-50 rounded-2xl p-8 transition-all duration-300 hover:shadow-xl hover:bg-white border border-transparent hover:border-gray-100">
            <div
              class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 text-blue-600 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-[--color-secondary] mb-3">Toxina Botulínica</h3>
            <p class="text-gray-600 mb-6">Suaviza líneas de expresión y arrugas dinámicas manteniendo tu
              expresividad natural.</p>
            <a href="#contacto" aria-label="Más información sobre Botox"
              class="text-[--color-primary] font-semibold flex items-center gap-2 group-hover:gap-3 transition-all">
              Saber más <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
              </svg>
            </a>
          </article>

          <!-- Card 2: Rellenos -->
          <article
            class="group bg-gray-50 rounded-2xl p-8 transition-all duration-300 hover:shadow-xl hover:bg-white border border-transparent hover:border-gray-100">
            <div
              class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6 text-purple-600 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                </path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-[--color-secondary] mb-3">Rellenos Dérmicos</h3>
            <p class="text-gray-600 mb-6">Restaura volumen facial, define contornos y mejora la hidratación
              profunda con ácido hialurónico.</p>
            <a href="#contacto" aria-label="Más información sobre Rellenos"
              class="text-[--color-primary] font-semibold flex items-center gap-2 group-hover:gap-3 transition-all">
              Saber más <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
              </svg>
            </a>
          </article>

          <!-- Card 3: Peeling -->
          <article
            class="group bg-gray-50 rounded-2xl p-8 transition-all duration-300 hover:shadow-xl hover:bg-white border border-transparent hover:border-gray-100">
            <div
              class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center mb-6 text-teal-600 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                </path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-[--color-secondary] mb-3">Peeling Químico</h3>
            <p class="text-gray-600 mb-6">Renovación celular para una piel más luminosa, uniforme y libre de
              imperfecciones.</p>
            <a href="#contacto" aria-label="Más información sobre Peeling"
              class="text-[--color-primary] font-semibold flex items-center gap-2 group-hover:gap-3 transition-all">
              Saber más <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
              </svg>
            </a>
          </article>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section id="testimonios" class="py-20 bg-[--color-secondary] text-white">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl lg:text-4xl font-bold text-center mb-16">Lo que dicen nuestros pacientes</h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Testimonial 1 -->
          <article class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/10">
            <div class="flex text-[--color-primary] mb-4">
              ★★★★★
            </div>
            <blockquote class="text-gray-300 mb-6 italic">
              "Excelentes profesionales. El tratamiento de Botox fue indoloro y los resultados súper
              naturales. Justo lo que buscaba."
            </blockquote>
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 rounded-full bg-gray-400"></div>
              <div>
                <cite class="not-italic font-semibold block">María González</cite>
                <span class="text-sm text-gray-400">Paciente Verificada</span>
              </div>
            </div>
          </article>

          <!-- Testimonial 2 -->
          <article class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/10">
            <div class="flex text-[--color-primary] mb-4">
              ★★★★★
            </div>
            <blockquote class="text-gray-300 mb-6 italic">
              "Me realicé un peeling y mi piel nunca ha estado tan luminosa. La atención personalizada es
              lo mejor de esta clínica."
            </blockquote>
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 rounded-full bg-gray-400"></div>
              <div>
                <cite class="not-italic font-semibold block">Laura Sánchez</cite>
                <span class="text-sm text-gray-400">Paciente Verificada</span>
              </div>
            </div>
          </article>

          <!-- Testimonial 3 -->
          <article
            class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/10 hidden lg:block">
            <div class="flex text-[--color-primary] mb-4">
              ★★★★★
            </div>
            <blockquote class="text-gray-300 mb-6 italic">
              "Profesionalismo y confianza desde el primer momento. El doctor resolvió todas mis dudas
              sobre los rellenos."
            </blockquote>
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 rounded-full bg-gray-400"></div>
              <div>
                <cite class="not-italic font-semibold block">Carlos Ruiz</cite>
                <span class="text-sm text-gray-400">Paciente Verificado</span>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- BOOKING SECTION -->
    <section id="contacto" class="py-20 bg-gray-50">
      <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">

          <!-- Form Info -->
          <div class="md:w-5/12 bg-[--color-secondary] p-10 text-white flex flex-col justify-between">
            <div>
              <h2 class="text-3xl font-bold mb-6">Agenda tu Visita</h2>
              <p class="text-gray-300 mb-8">Déjanos tus datos y nos pondremos en contacto contigo para
                confirmar tu cita.</p>

              <ul class="space-y-4">
                <li class="flex items-center gap-3">
                  <span
                    class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-[--color-primary]">📍</span>
                  <span>Av. Principal 123, Madrid</span>
                </li>
                <li class="flex items-center gap-3">
                  <span
                    class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-[--color-primary]">📞</span>
                  <span>+34 912 345 678</span>
                </li>
                <li class="flex items-center gap-3">
                  <span
                    class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-[--color-primary]">✉️</span>
                  <span>info@clinicaestetica.com</span>
                </li>
              </ul>
            </div>
            <div class="mt-8 text-sm text-gray-400">
              * Consulta de valoración gratuita
            </div>
          </div>

          <!-- Form -->
          <div class="md:w-7/12 p-10">
            <form action="/api/submit-booking.php" method="POST" id="booking-form" class="space-y-6">
              <!-- CSRF Token Injected by PHP -->
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

              <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label for="name" class="block text-sm font-medium text-gray-700">Nombre
                    Completo</label>
                  <input type="text" id="name" name="name" required data-validate="text"
                    data-min-length="3"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[--color-primary] focus:border-transparent outline-none transition-shadow"
                    placeholder="Ej. Ana García">
                </div>

                <div class="space-y-2">
                  <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                  <input type="tel" id="phone" name="phone" required data-validate="phone"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[--color-primary] focus:border-transparent outline-none transition-shadow"
                    placeholder="+34 600 000 000">
                </div>
              </div>

              <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required data-validate="email"
                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[--color-primary] focus:border-transparent outline-none transition-shadow"
                  placeholder="tu@email.com">
              </div>

              <div class="space-y-2">
                <label for="treatment" class="block text-sm font-medium text-gray-700">Tratamiento de
                  Interés</label>
                <select id="treatment" name="treatment" required
                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[--color-primary] focus:border-transparent outline-none transition-shadow bg-white">
                  <option value="valoracion" selected>Valoración General</option>
                  <option value="botox">Toxina Botulínica</option>
                  <option value="fillers">Rellenos Dérmicos</option>
                  <option value="peeling">Peeling Químico</option>
                </select>
              </div>

              <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label for="date" class="block text-sm font-medium text-gray-700">Fecha
                    Preferente</label>
                  <input type="date" id="date" name="date"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[--color-primary] focus:border-transparent outline-none transition-shadow">
                </div>
                <div class="space-y-2">
                  <label for="time" class="block text-sm font-medium text-gray-700">Hora</label>
                  <select id="time" name="time"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[--color-primary] focus:border-transparent outline-none transition-shadow bg-white">
                    <option value="mañana">Mañana (10-14h)</option>
                    <option value="tarde">Tarde (16-20h)</option>
                  </select>
                </div>
              </div>

              <button type="submit"
                class="w-full py-4 bg-[--color-primary] text-white font-bold rounded-lg hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                Confirmar Reserva
              </button>

              <p class="text-xs text-center text-gray-500 mt-4">
                Al enviar aceptas nuestra <a href="#"
                  class="underline hover:text-[--color-secondary]">Política de Privacidad</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
    <div class="container mx-auto px-6">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-6 md:mb-0">
          <span class="text-2xl font-bold text-white">Estética<span
              class="text-[--color-primary]">Premium</span></span>
          <p class="mt-2 text-sm">Medicina estética responsable y segura.</p>
        </div>

        <nav class="flex space-x-6 mb-6 md:mb-0">
          <a href="#" class="hover:text-white transition-colors">Aviso Legal</a>
          <a href="#" class="hover:text-white transition-colors">Privacidad</a>
          <a href="#" class="hover:text-white transition-colors">Cookies</a>
        </nav>

        <div class="flex space-x-4">
          <a href="#" aria-label="Instagram"
            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-[--color-primary] hover:text-white transition-all">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
            </svg>
          </a>
        </div>
      </div>
      <div class="text-center mt-8 text-sm text-gray-600">
        &copy; 2026 Meiking Systems. Todos los derechos reservados.
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="js/form-validation.js" defer></script>
  <script src="js/form-submission.js" defer></script>
  <script src="js/app.js" defer></script>
</body>

</html>