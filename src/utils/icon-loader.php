<?php

/**
 * Renderiza un icono SVG de forma modular.
 * * @param string $name El nombre del archivo en components/icons (sin .php)
 * @param string $classes Clases Tailwind adicionales (opcional)
 * @return string HTML del SVG o string vacío si no existe
 */
function render_icon($name, $classes = '')
{
  $path = __DIR__ . "/../../components/icons/{$name}.php";

  if (file_exists($path)) {
    // Capturamos el contenido para poder inyectar clases dinámicamente
    ob_start();
    include $path;
    $svg = ob_get_clean();

    // Inyección de clases para reemplazar el atributo class por defecto si es necesario
    // O simplemente añadir las nuevas. Aquí hacemos un reemplazo simple para control total.
    if ($classes) {
      // Buscamos si ya tiene clase
      if (strpos($svg, 'class="') !== false) {
        $svg = str_replace('class="', 'class="' . $classes . ' ', $svg);
      } else {
        $svg = str_replace('<svg', '<svg class="' . $classes . '"', $svg);
      }
    }
    return $svg;
  }

  // Log de error en desarrollo
  error_log("MEIKING-SYSTEMS WARNING: Icono '$name' no encontrado.");
  return ''; // Fallo silencioso en producción
}
