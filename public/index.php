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
    content="Recibe una Auditoría Digital en Vídeo de 5 Minutos detectando los 3 errores técnicos que están vaciando tu agenda.">
  <title>Tu Clínica Pierde Pacientes Mientras Duermes. Te Muestro Por Dónde.</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="css/tailwind.css">
  <link rel="stylesheet" href="css/variables.css">
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/animations.css">


  <!-- Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">

</head>

<body data-theme="dark">

  <!-- FILENAME: /partials/bg-ambient.svg (inline, above-the-fold asset) -->
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



  <!-- HEADER -->
  <header class="fixed w-full top-0 z-50 bg-[--color-bg-surface]/90 backdrop-blur-md shadow-sm transition-all duration-300 border-b border-[--color-border]">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <a href="#" aria-label="Inicio">
        <img src="/assets/images/MS HORZ_2.svg" alt="Logo" class="w-72">
      </a>

      <!-- Desktop CTA Button -->
      <a href="#contacto" class="btn btn--primary btn--hidden-mobile max-w-xs" id="header-cta">
        Solicitar Auditoría
      </a>

    </div>
  </header>

  <main>

    <!-- HERO SECTION -->
    <section class="hero container">
      <div class="hero__content">
        <!-- Animation wrapper -->
        <div class="animate-fadeInUp">
          <h1 class="hero__title">
            Tu Clínica Pierde Pacientes Mientras Duermes. <br>
            <span>Te Muestro Por Dónde.</span>
          </h1>
          <p class="hero__subtitle">
            Recibe un vídeo-análisis de 5 minutos detectando los 3 errores técnicos que vacían tu agenda.
          </p>
          <div class="delay-2 animate-fadeInUp">
            <a href="#contacto" class="btn btn--primary max-w-xs" id="main-cta">
              Quiero Mi Auditoría Gratis
            </a>
            <p class="mt-4 text-[--color-text-muted] text-xs">
              *Solo 5 auditorías disponibles esta semana.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Proof Social -->
    <section class="container reveal">
      <div
        class="check-icon card card--rounded-2xl card--p-md flex items-center justify-center max-w-md mx-auto px-4">
        <div class="text-center">
          <div class="text-3xl font-bold text-[--color-accent]">60%</div>
          <div class="text-sm">de las reservas se pierden por mala gestión</div>
        </div>
        <div class="h-12 w-px bg-[#00E0FF]/20 mx-4"></div>
        <div class="text-center">
          <div class="text-3xl font-bold text-[--color-accent]">90%</div>
          <div class="text-sm">de clínicas cometen los mismos fallos</div>
        </div>
      </div>
    </section>

    <section class="container py-12 reveal">
      <div class=" max-w-5xl mx-auto space-y-4 px-2">
        <p class="text-lg text-justify">
          Sé que eres excelente en tus tratamientos, pero tu sistema de reservas manual te está costando
          dinero.
        </p>
        <p class="text-lg text-justify">
          He analizado decenas de clínicas y el <strong class="text-[#00E0FF]">90% cometen los
            mismos
            fallos</strong> en Instagram y Google Maps que regalan clientes a la competencia.
        </p>
        <p class="text-lg text-justify">
          Déjame analizar tu presencia digital. <strong>Sin coste. Sin compromiso.</strong> Solo ingeniería
          aplicada a tus ventas.
        </p>
      </div>
    </section>

    <!-- ============================================
        DESCUBRIMIENTO DE ERRORES
    ============================================= -->
    <section class="container mx-auto py-12">
      <h2 class="text-center mb-6">
        En este vídeo de 5 minutos descubrirás:
      </h2>

      <ul class="space-y-4 text-left max-w-2xl mx-auto" role="list">

        <!-- EL "AGUJERO NEGRO" DE TU INSTAGRAM -->
        <li
          class="check-icon card card--rounded-xl card--p-sm flex items-start gap-4">
          <span
            class="flex-shrink-0 w-8 h-8 flex items-center justify-center text-2xl rounded-full bg-[#00E0FF]/20 text-[--color-accent]"
            aria-hidden="true">
            ✓
          </span>
          <div>
            <strong class="text-[--color-accent]">El "Agujero Negro" de tu Instagram:</strong>
            <span class="text-[--color-text-main]"> Por qué tus seguidores ven tus fotos pero no piden
              cita.</span>
          </div>
        </li>

        <li
          class="check-icon card card--rounded-xl card--p-sm flex items-start gap-4">
          <span
            class="flex-shrink-0 w-8 h-8 flex items-center justify-center text-2xl rounded-full bg-[#00E0FF]/20 text-[--color-accent]"
            aria-hidden="true">
            ✓
          </span>
          <div>
            <strong class="text-[--color-accent]">La Fricción de WhatsApp:</strong>
            <span class="text-[--color-text-main]"> Cuántas horas pierdes respondiendo mensajes que no cierran
              ventas.</span>
          </div>
        </li>

        <li
          class="check-icon card card--rounded-xl card--p-sm flex items-start gap-4">
          <span
            class="flex-shrink-0 w-8 h-8 flex items-center justify-center text-2xl rounded-full bg-[#00E0FF]/20 text-[--color-accent]"
            aria-hidden="true">
            ✓
          </span>
          <div>
            <strong class="text-[--color-accent]">3 Correcciones Rápidas (Quick Wins):</strong>
            <span class="text-[--color-text-main]"> Cambios que puedes aplicar HOY para llenar esos huecos
              libres en tu agenda.</span>
          </div>
        </li>
      </ul>
    </section>


    <!-- BOOKING SECTION -->
    <section id="contacto" class="py-12 bg-[--color-bg-body] flex justify-center reveal">
      <div class="max-w-5xl mx-auto bg-[--color-bg-surface] rounded-3xl shadow-xl overflow-hidden border border-[--color-border] flex flex-col md:flex-row">

        <!-- PROTECCIÓN DE DATOS INFO -->
        <div class="bg-[--color-bg-alt] p-10 border-b border-[--color-border] md:w-1/2">
          <h3 class="mb-4 text-center uppercase">🔒 PROTEGEMOS TUS DATOS</h3>
          <p class="mb-4 text-justify">
            MEIKING SYSTEMS trata los datos que proporcionas para enviarte tu vídeo de auditoría personalizado
            y comunicaciones sobre cómo mejorar tu presencia digital.
          </p>
          <ul class="space-y-2 text-sm text-[--color-text-muted]">
            <li class="flex items-start gap-2">
              <span class="text-[--color-accent]">✓</span>
              <span><strong>Base legal:</strong> Tu consentimiento (RGPD Art. 6.1.a).</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="text-[--color-accent]">✓</span>
              <span><strong>Duración:</strong> Guardaremos tus datos 12 meses para comunicaciones de seguimiento.</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="text-[--color-accent]">✓</span>
              <span><strong>Derechos:</strong> Acceso, rectificación, supresión, portabilidad y oposición.</span>
            </li>
          </ul>
          <p class="mt-4 text-sm text-[--color-text-muted]">
            👉 Leer completo: <a href="#" class="text-[--color-accent] underline hover:opacity-80">Política de Privacidad.</a>
          </p>
        </div>

        <!-- BOOKING FORM -->
        <div class="p-10 md:w-1/2">
          <form action="/api/submit-booking.php" method="POST" id="booking-form" class="space-y-4">
            <!-- CSRF Token Injected by PHP -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <h3 class="text-center uppercase">Recibe tu
              auditoría
            </h3>
            <p>Déjame tus datos para enviarte el vídeo en cuanto esté
              listo.</p>
            <!-- NAME INPUT -->
            <div class="space-y-2">
              <input type="text" id="name" name="name" required data-validate="text"
                data-min-length="7"
                class="w-full px-4 py-3 rounded-lg border border-[--color-border] bg-[--color-bg-body] text-[--color-text-main] focus:ring-2 focus:ring-[--color-accent] focus:border-transparent outline-none transition-shadow"
                placeholder="Nombre Completo">
            </div>

            <!-- EMAIL INPUT -->
            <div class="space-y-2">
              <input type="email" id="email" name="email" required data-validate="email"
                class="w-full px-4 py-3 rounded-lg border border-[--color-border] bg-[--color-bg-body] text-[--color-text-main] focus:ring-2 focus:ring-[--color-accent] focus:border-transparent outline-none transition-shadow"
                placeholder="Correo Electrónico">
            </div>

            <!-- INSTAGRAM OR WEB INPUT -->
            <div class="space-y-2">
              <input type="text" id="instagram_web" name="instagram_web" required data-validate="text"
                class="w-full px-4 py-3 rounded-lg border border-[--color-border] bg-[--color-bg-body] text-[--color-text-main] focus:ring-2 focus:ring-[--color-accent] focus:border-transparent outline-none transition-shadow"
                placeholder="Instagram o Web">
            </div>

            <!-- CONSENT CHECKBOX -->
            <div class="space-y-4 pt-4">
              <div class="flex items-start gap-3">
                <input type="checkbox" id="consent_audit" name="consent_audit" required
                  class="mt-1 w-5 h-5 rounded border-[--color-border] bg-[--color-bg-body] text-[--color-accent] focus:ring-2 focus:ring-[--color-accent]">
                <label for="consent_audit" class="text-sm text-[--color-text-muted]">
                  Acepto recibir mi vídeo de auditoría personalizado y comunicaciones sobre
                  cómo mejorar mi presencia digital
                </label>
              </div>

              <button type="submit"
                class="btn btn--primary mx-auto w-full">
                Enviar Solicitud
              </button>
              <p class="mt-4 text-[--color-text-muted] text-xs text-center">
                Respuesta en menos de 48 Hrs.
              </p>

          </form>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="bg-[--color-bg-alt] text-[--color-text-muted] py-12 border-t border-[--color-border]">
    <div class="container mx-auto px-6">
      <div class="flex flex-col md:flex-row justify-between items-center">

        <nav class="flex flex-col md:flex-row space-y-2 text-center md:space-y-0 md:space-x-4">
          <a href="#" class="hover:text-white transition-colors">Aviso Legal</a>
          <a href="#" class="hover:text-white transition-colors">Política de Privacidad</a>
          <a href="#" class="hover:text-white transition-colors">Cookies</a>
        </nav>

        <!-- ICON LOADER PHP -->
        <?php require_once '../src/utils/icon-loader.php'; ?>

        <div class="flex space-x-4 mt-4 md:mt-0">
          <a href="https://www.instagram.com/meiking.systems/" class="w-10 h-10 rounded-full bg-[--color-bg-surface] border border-[--color-border] flex items-center justify-center hover:text-white transition-all" aria-label="Instagram">
            <?php echo render_icon('instagram', 'w-5 h-5 text-main'); ?>
          </a>


          <a href="https://wa.me/34658483981" class="w-10 h-10 rounded-full bg-[--color-bg-surface] border border-[--color-border] flex items-center justify-center hover:text-white transition-all" aria-label="WhatsApp">
            <?php echo render_icon('whatsapp', 'w-5 h-5 text-main'); ?>
          </a>

        </div>
      </div>













      <div class="text-center mt-8 text-sm text-[--color-text-muted]">
        &copy; 2026 Meiking Systems. Todos los derechos reservados.
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="js/form-validation.js" defer></script>
  <script src="js/form-submission.js" defer></script>
  <script src="js/app.js" defer></script>
  <script src="js/utils.js" defer></script>
</body>

</html>