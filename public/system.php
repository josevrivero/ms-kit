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
    content="Diseñamos tu Marca Premium e Instalamos un Sistema que Llena Tu Agenda sin depender de WhatsApp ni Redes Sociales.">
  <title>Pack Transformación Digital - Meiking Systems</title>

  <!-- ============================================
        ESTILOS
    ============================================= -->
  <link rel="stylesheet" href="css/tailwind.css">
  <link rel="stylesheet" href="css/variables.css">
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/animations.css">


  <!-- ============================================
        FONTS
    ============================================= -->
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">

</head>

<body data-theme="dark">

  <!-- ============================================
        BG AMBIENT
    ============================================= -->
  <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10">
    <div class="absolute -top-24 -left-20 h-72 w-72 orb floaty"
      style="background:radial-gradient(circle at 30% 30%, rgba(0,224,255,.55), rgba(0,224,255,0) 60%);"></div>
    <div class="absolute top-24 -right-24 h-96 w-96 orb floaty2"
      style="background:radial-gradient(circle at 40% 40%, rgba(0,224,255,.28), rgba(0,224,255,0) 62%);"></div>
    <svg class="absolute inset-0 h-full w-full opacity-[0.18]" viewBox="0 0 1200 700" preserveAspectRatio="none">
      <defs>
        <linearGradient id="grid" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0" stop-color="#00E0FF" stop-opacity=".35" />
          <stop offset="1" stop-color="#00E0FF" stop-opacity="0" />
        </linearGradient>
      </defs>
      <path d="M0 520 C 240 480, 360 620, 600 560 C 840 500, 980 520, 1200 460 L1200 700 L0 700 Z"
        fill="url(#grid)" />
    </svg>
  </div>



  <!-- ============================================
        HEADER
    ============================================= -->
  <header
    class="fixed w-full top-0 z-50 backdrop-blur-md shadow-sm transition-all duration-300 border-b border-[--color-border]">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <a href="#" aria-label="Inicio">
        <img src="/assets/images/MS-ISO-WHITE.svg" alt="Logo" class="w-24" />
      </a>

      <!-- Desktop Navigation -->
      <nav class="hidden md:flex md:flex-row space-x-8">
        <a
          href="#inicio"
          class="hover:text-[--color-accent] transition-colors font-medium">Inicio</a>
        <a
          href="#servicios"
          class="hover:text-[--color-accent] transition-colors font-medium">Para Quién</a>
        <a
          href="#beneficios"
          class="hover:text-[--color-accent] transition-colors font-medium">Beneficios</a>
        <a
          href="#contacto"
          class="hover:text-[--color-accent] transition-colors font-medium">Auditoría</a>
      </nav>

      <!-- HEADER CTA Button -->
      <a
        href="#contacto"
        class="hidden md:inline-block px-6 py-2 bg-[--color-accent] text-[--color-primary] rounded-full font-semibold hover:opacity-90 transition-opacity shadow-lg">
        Quiero mi Auditoría Gratuita
      </a>

      <!-- HEADER MOBILE MENU BUTTON -->
      <button
        id="mobile-menu-btn"
        class="md:hidden text-[--color-text-main] focus:outline-none"
        aria-label="Abrir menú">
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>

    <!-- Mobile Navigation Menu -->
    <nav
      id="mobile-nav"
      class="hidden absolute top-full left-0 w-full bg-[--color-bg-surface] border-t border-[--color-border] shadow-xl z-50">
      <div class="container mx-auto px-6 py-4 flex flex-col space-y-4">
        <a
          href="#inicio"
          class="text-[--color-text-muted] hover:text-[--color-accent] transition-colors font-medium py-2 block">Inicio</a>
        <a
          href="#servicios"
          class="text-[--color-text-muted] hover:text-[--color-accent] transition-colors font-medium py-2 block">Para Quién</a>
        <a
          href="#beneficios"
          class="text-[--color-text-muted] hover:text-[--color-accent] transition-colors font-medium py-2 block">Beneficios</a>
        <a
          href="#contacto"
          class="text-[--color-text-muted] hover:text-[--color-accent] transition-colors font-medium py-2 block">Auditoría</a>
        <a
          href="#contacto"
          class="mt-4 px-6 py-3 bg-[--color-accent] text-black rounded-full font-semibold hover:opacity-90 transition-opacity shadow-lg text-center block">
          Auditoría Digital Gratis
        </a>
      </div>
    </nav>
  </header>
  <main>

    <!-- ============================================
        HERO
    ============================================= -->
    <section class="hero container reveal">
      <div class="hero__content text-center mx-auto">

        <h1 class="mb-6 leading-tight animate-fadeInUp delay-100">
          Convierte tus Seguidores en <span class="gradient-text">Pacientes Reales</span> que agendan automáticamente
        </h1>

        <!-- VIDEO HERO -->
        <div class="card rounded-2xl inline-block mb-6 delay-200 animate-fadeInUp">
          <video class="w-full h-full object-cover rounded-2xl mix-blend-screen" autoplay muted loop playsinline>
            <source src="/assets/images/hero-mobile.mp4" type="video/mp4" />
          </video>
        </div>
        <!-- END VIDEO HERO -->

        <p class="hero__subtitle text-[--color-text-main] animate-fadeInUp delay-300">
          Diseñamos tu Marca Premium e Instalamos el Sistema de reservas para que no dependas de WhatsApp ni Redes Sociales.
        </p>

        <div class="delay-500 animate-fadeInUp">
          <a href="#contacto" class="btn btn--primary max-w-xs" id="main-cta">
            SOLICITAR DEMO
          </a>
          <p class="mt-4 text-[--color-text-muted] text-xs">
            *Solo Instalamos 3 Sistemas al Mes.
          </p>
        </div>

      </div>
    </section>

    <!-- ============================================
        PROBLEMA
    ============================================= -->
    <section id="problema" class="container mx-auto reveal">
      <h2 class="mb-6 text-center">
        Tu presencia digital <span class="gradient-text">no debería estar frenando tus ventas</span>
      </h2>

      <div class="space-y-8 text-justify">
        <p class="leading-relaxed">
          La mayoría de clínicas y despachos siguen con webs que funcionan como folletos. Reciben visitas,
          pero no reservas. Publican contenido, pero no tienen un sistema.
        </p>

        <p class="leading-relaxed italic">
          Esto genera frustración, horas perdidas respondiendo mensajes y la sensación constante de estar
          dejando dinero sobre la mesa.
        </p>

        <p class="leading-relaxed">
          No es justo. Si ya haces bien tu trabajo, también deberías tener un sistema digital que trabaje por
          ti.
        </p>
      </div>

      <div class="text-center py-12">
        <a href="#formulario"
          class="inline-block btn btn--secondary">
          Evaluar Mi Caso
        </a>
      </div>
    </section>

    <!-- ============================================
        BENEFICIOS
    ============================================= -->
    <section id="beneficios" class="container mx-auto py-12">
      <h2 class="mb-6 text-center reveal">
        Lo que ocurre cuando tu negocio tiene un <span class="gradient-text">sistema que convierte</span>
      </h2>
      <div class="space-y-4 text-left mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div
          class="card card--rounded-xl p-6">
          <div
            class="text-4xl text-center mb-4"
            aria-hidden="true">
            🎯
          </div>
          <div class="text-center">
            <h3 class="mb-3">Más reservas sin dependencia</h3>
            <p> Sin depender de WhatsApp o mensajes manuales.</p>
          </div>
        </div>

        <div
          class="card card--rounded-xl p-6">
          <div class="text-4xl text-center mb-4"
            aria-hidden="true">
            ✨
          </div>
          <div class="text-center">
            <h3 class="mb-3">Autoridad Visual</h3>
            <p> Una identidad visual que transmite autoridad desde el primer vistazo.</p>
          </div>
        </div>

        <div
          class="card card--rounded-xl p-6">
          <div class="text-4xl text-center mb-4"
            aria-hidden="true">
            🚀
          </div>
          <div class="text-center">
            <h3 class="mb-3">Sistema Sin Fricciones</h3>
            <p> Un sistema claro que guía al cliente hasta la compra sin fricciones.</p>
          </div>
        </div>

        <div
          class="card card--rounded-xl p-6">
          <div
            class="text-4xl text-center mb-4"
            aria-hidden="true">
            ⏰
          </div>
          <div class="text-center">
            <h3 class="mb-3">Más Tiempo para Ti</h3>
            <p> Menos tareas repetitivas y más tiempo para tu trabajo real y para ti.</p>
          </div>
        </div>
        <div class="card card--rounded-xl p-6">
          <div class="text-4xl text-center mb-4"
            aria-hidden="true">
            📊
          </div>
          <div class="text-center">
            <h3 class="mb-3">Control Total</h3>
            <p> Tú decides cuándo tu agenda está disponible.</p>
          </div>
        </div>
      </div>
    </section>



    <!-- ============================================
        GUÍA
    ============================================= -->
    <section class="container mx-auto py-12 reveal">
      <h2 class="text-center mb-6">
        <span class="gradient-text">No necesitas más publicaciones. </span>Necesitas un sistema.
      </h2>

      <div class="card rounded-2xl inline-block mb-6 delay-200 animate-fadeInUp">
        <img src="/assets/images/jose_rivero.png" alt="IMAGEN José Rivero" class="w-full h-full object-cover rounded-2xl mix-blend-screen">
      </div>

      <div class="text-justify space-y-4">
        <p>En MEIKING SYSTEMS combinamos ingeniería, diseño estratégico y automatización para crear sistemas que funcionan solos.</p>

        <p class="italic">Sabemos lo frustrante que es invertir en marketing sin resultados claros. Por eso creamos un método que convierte tu presencia digital en tu activo más rentable.</p>

        <p>No hacemos “diseños o páginas bonitas”. Hacemos que tu negocio se vea profesional, como tus servicios, y que crezca mientras estás atendiendo pacientes.</p>

        <p class="gradient-text font-bold">✓ 8+ Años de Experiencia.</p>
        <p class="gradient-text font-bold">✓ 10+ Marcas Transformadas.</p>
        <p class="gradient-text font-bold">✓ 94% de Satisfacción.</p>
      </div>
    </section>

    <!-- ============================================
        PROCESO SIMPLE
    ============================================= -->
    <section class="container mx-auto py-12 reveal">
      <h2 class="text-center mb-6">
        Un proceso simple para <span class="gradient-text">resultados reales</span>
      </h2>

      <div class="space-y-4 text-left">
        <div
          class="hover-scale card card--rounded-xl card--p-sm flex items-start gap-4">
          <div
            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-[#00E0FF]/20 text-[--color-accent]">
            1
          </div>
          <div class="text-left">
            <h3 class="text-[--color-accent]">Auditoría Digital</h3>
            <p> Analizamos tu presencia digital y tu sistema de reservas actual e identificamos oportunidades de mejora inmediatas.</p>
          </div>
        </div>

        <div
          class="card card--rounded-xl card--p-sm flex items-start gap-4">
          <div
            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-[#00E0FF]/20 text-[--color-accent]"
            aria-hidden="true">
            2
          </div>
          <div class="text-left">
            <h3 class="text-[--color-accent]">Diseño de Marca Premium</h3>
            <p> Te entregamos una identidad visual que transmite autoridad desde el primer vistazo. Aumenta tu confianza y tu atractivo para tu público.</p>
          </div>
        </div>

        <div
          class="card card--rounded-xl card--p-sm flex items-start gap-4">
          <div
            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-[#00E0FF]/20 text-[--color-accent]"
            aria-hidden="true">
            3
          </div>
          <div class="text-left">
            <h3 class="text-[--color-accent]">Instalación del Sistema</h3>
            <p> Implementamos tu sistema, te explicamos cómo gestionarlo y lo dejamos funcionando 24/7.</p>
          </div>
        </div>
      </div>

      <!-- CTA 2 -->
      <div class="mt-8">
        <a href="#formulario"
          class="inline-block btn btn--primary">
          Empezar con el Paso 1
        </a>
      </div>

    </section>


  </main>
  <!-- FOOTER -->
  <footer class="py-8 px-4 bg-black/50 border-t border-white/10">
    <div class="container mx-auto max-w-6xl text-center">
      <!-- <p class="text-2xl font-bold mb-2 gradient-text">MEIKING SYSTEMS</p> -->
      <p class="text-gray-400">© 2025 MEIKING SYSTEMS - Sistemas de captación automatizados</p>
    </div>
    <?php require_once '../src/utils/icon-loader.php'; ?>

    <div class="flex gap-4">
      <a href="#" class="group transition-colors duration-300" aria-label="Instagram">
        <?php echo render_icon('instagram', 'w-6 h-6 text-white group-hover:text-[#00E0FF] transition-colors'); ?>
      </a>

      <a href="#" class="group transition-colors duration-300" aria-label="WhatsApp">
        <?php echo render_icon('whatsapp', 'w-6 h-6 text-white group-hover:text-[#00E0FF] transition-colors'); ?>
      </a>
    </div>
  </footer>
  <script src="js/app.js" defer></script>
  <script src="js/utils.js" defer></script>
</body>

</html>