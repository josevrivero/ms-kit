<?php
/**
 * @file: form-handler.php
 * @description: Backend Handler para procesar reservas de forma segura.
 * @author: MS-KIT v1.0
 * 
 * Flow:
 * 1. Headers & Config
 * 2. CSRF & Rate Limiting Check
 * 3. Sanitization
 * 4. Validation
 * 5. Database Interaction
 * 6. Response
 */

// 1. HEADERS & CONFIG
// -------------------------------------------------------------------
header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

require_once '../config/db.php'; // Asumimos conexión PDO en $pdo
require_once '../utils/security.php'; // Helper para CSRF y otros

session_start();

// Helper para respuestas JSON consistentes
function send_json($status, $success, $message, $errors = []) {
    http_response_code($status);
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'errors'  => $errors
    ]);
    exit;
}

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    send_json(405, false, 'Método no permitido');
}

try {
    // 2. SEGURIDAD INICIAL (CSRF & RATE LIMITING)
    // -------------------------------------------------------------------
    
    // a) Verificar CSRF Token
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (empty($csrf_token) || $csrf_token !== ($_SESSION['csrf_token'] ?? '')) {
        send_json(403, false, 'Error de seguridad (Token inválido). Recarga la página.');
    }

    // b) Rate Limiting (Simple usando archivo o APCu/Redis en producción)
    // Aquí simularemos con sesión para simplicidad, idealmente usar almacenamiento persistente
    $ip = $_SERVER['REMOTE_ADDR'];
    $rate_limit_key = 'last_submission_' . md5($ip);
    
    if (isset($_SESSION[$rate_limit_key])) {
        $last_time = $_SESSION[$rate_limit_key];
        // Bloquear si intentó hace menos de 10 segundos (Prevención flood básica)
        if (time() - $last_time < 10) {
            send_json(429, false, 'Demasiadas solicitudes. Espera un momento.');
        }
    }
    $_SESSION[$rate_limit_key] = time();


    // 3. SANITIZACIÓN DE ENTRADAS
    // -------------------------------------------------------------------
    $name    = trim(strip_tags($_POST['name'] ?? ''));
    $email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone   = preg_replace('/[^0-9\+\-\s]/', '', trim($_POST['phone'] ?? '')); // Solo nums y símbolos tel
    $service = trim(strip_tags($_POST['treatment'] ?? '')); // 'treatment' coincide con el HTML
    $date    = trim($_POST['date'] ?? '');
    $time    = trim($_POST['time'] ?? '');

    // 4. VALIDACIÓN DE LÓGICA DE NEGOCIO
    // -------------------------------------------------------------------
    $errors = [];

    // Validar Nombre
    if (strlen($name) < 3) {
        $errors['name'] = 'El nombre es demasiado corto.';
    }

    // Validar Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El formato de email no es válido.';
    }

    // Validar Teléfono (Mínimo 9 dígitos efectivos)
    $phone_digits = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($phone_digits) < 9) {
        $errors['phone'] = 'Introduce un teléfono válido.';
    }

    // Validar Servicio (Lista blanca)
    $allowed_services = ['botox', 'fillers', 'peeling', 'valoracion'];
    if (!in_array($service, $allowed_services)) {
        $errors['treatment'] = 'Servicio no válido.';
    }

    // Validar Fecha (Debe ser futura o hoy)
    if (empty($date) || strtotime($date) < strtotime(date('Y-m-d'))) {
        $errors['date'] = 'La fecha debe ser a partir de hoy.';
    }

    // Si hay errores de validación, detener
    if (!empty($errors)) {
        send_json(422, false, 'Por favor, corrige los errores en el formulario.', $errors);
    }


    // 5. INTERACCIÓN CON BASE DE DATOS
    // -------------------------------------------------------------------
    
    // SQL Query
    $sql = "INSERT INTO bookings (name, email, phone, service_type, booking_date, booking_time, created_at) 
            VALUES (:name, :email, :phone, :service, :date, :time, NOW())";
    
    $stmt = $pdo->prepare($sql);
    
    // Ejecución segura con parámetros vinculados (evita SQL Injection)
    $result = $stmt->execute([
        ':name'    => $name,
        ':email'   => $email,
        ':phone'   => $phone,
        ':service' => $service,
        ':date'    => $date,
        ':time'    => $time
    ]);

    if ($result) {
        // Opcional: Enviar email de confirmación aquí
        
        send_json(200, true, '¡Reserva confirmada! Te contactaremos pronto.');
    } else {
        throw new Exception('Error al insertar en DB');
    }

} catch (PDOException $e) {
    // Log interno del error real
    error_log("Database Error: " . $e->getMessage());
    // Respuesta genérica al usuario
    send_json(500, false, 'Error interno del servidor. Inténtalo más tarde.');

} catch (Exception $e) {
    error_log("General Error: " . $e->getMessage());
    send_json(500, false, 'Ocurrió un error inesperado.');
}
