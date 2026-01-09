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

<body class="bg-[--color-bg-body] text-[--color-text-main] antialiased" data-theme="dark">

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
  <header class="w-full center">
    <div class="container mx-auto px-6 flex justify-center py-12 items-center">
      <a href="#" aria-label="Inicio">
        <img src="/assets/images/MS-ISO-WHITE.svg" alt=" Logo" class="w-24">
      </a>
    </div>
  </header>

  <main>

    <!-- ============================================
        FILENAME: components/bullet-points.html
        Puntos de valor con iconos animados
    ============================================= -->
    <section class="container mx-auto py-12 section-animate">
      <ul class="space-y-6 text-left max-w-5xl mx-auto" role="list">
        <li
          class="btn btn--primary flex items-start gap-4">
          <span
            class="flex-shrink-0 flex items-center justify-center"
            aria-hidden="true">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
            </svg>
          </span>
          <div>
            <a href="https://wa.me/34658483981" target="_blank" rel="noopener noreferrer">
              <strong>Contacto WhatsApp</strong>
            </a>
        </li>

        <li
          class="btn btn--secondary flex items-start gap-4">
          <span
            class="flex-shrink-0 flex items-center justify-center"
            aria-hidden="true">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
            </svg>
          </span>
          <div>
            <a href="https://www.instagram.com/meiking.systems/" target="_blank" rel="noopener noreferrer">
              <strong class="text-[--color-accent]">Instagram</strong>
            </a>
          </div>
        </li>

        <li
          class="btn btn--secondary flex items-start gap-4">
          <span
            class="flex-shrink-0 flex items-center justify-center"
            aria-hidden="true">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
          </span>
          <div>
            <a href="https://www.instagram.com/meiking.systems/" target="_blank" rel="noopener noreferrer">
              <strong class="text-[--color-accent]">Guión Precio</strong>
            </a>
          </div>
        </li>
      </ul>
    </section>
    <!-- Scripts -->
    <script src="js/utils.js" defer></script>
</body>

</html>