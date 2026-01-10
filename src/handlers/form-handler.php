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
// Desactivar output de errores visibles en producción
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Iniciar sesión primero (puede generar cookies pero no output)
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Headers después de session_start pero antes de cualquier output
header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

// Helper para respuestas JSON consistentes (debe estar antes de usarse)
function send_json($status, $success, $message, $errors = [])
{
  http_response_code($status);
  echo json_encode([
    'success' => $success,
    'message' => $message,
    'errors'  => $errors
  ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  exit;
}

// Cargar configuración de base de datos
try {
  $pdo = require __DIR__ . '/../config/db.php';
  if (!$pdo || !($pdo instanceof PDO)) {
    send_json(500, false, 'Error interno del servidor. Inténtalo más tarde.');
  }
} catch (PDOException $e) {
  error_log("Database connection error: " . $e->getMessage());
  send_json(500, false, 'Error interno del servidor. Inténtalo más tarde.');
} catch (Exception $e) {
  error_log("Database connection error: " . $e->getMessage());
  send_json(500, false, 'Error interno del servidor. Inténtalo más tarde.');
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
  $name = trim(strip_tags($_POST['name'] ?? ''));
  $email_raw = trim($_POST['email'] ?? '');
  $email = filter_var($email_raw, FILTER_SANITIZE_EMAIL);
  $instagram_web = trim(strip_tags($_POST['instagram_web'] ?? ''));

  // Validar que los campos requeridos no estén vacíos después de sanitizar
  if (empty($name) || empty($email_raw)) {
    send_json(422, false, 'Los campos nombre y email son obligatorios.');
  }

  // 4. VALIDACIÓN DE LÓGICA DE NEGOCIO
  // -------------------------------------------------------------------
  $errors = [];

  // Validar Nombre (mínimo 3 caracteres)
  if (strlen($name) < 3) {
    $errors['name'] = 'El nombre debe tener al menos 3 caracteres.';
  }

  // Validar longitud máxima de nombre (prevenir overflow)
  if (strlen($name) > 255) {
    $errors['name'] = 'El nombre es demasiado largo.';
  }

  // Validar Email (validar el original, usar el sanitizado si pasa)
  if (!filter_var($email_raw, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'El formato de email no es válido.';
  } else {
    // Si el email es válido, asegurarse de que el sanitizado no esté vacío
    if (empty($email)) {
      $email = $email_raw; // Usar el original si el sanitizado está vacío
    }
  }

  // Validar longitud máxima de email
  if (strlen($email) > 255) {
    $errors['email'] = 'El email es demasiado largo.';
  }

  // Validar instagram_web (opcional, pero si existe validar longitud)
  if (!empty($instagram_web) && strlen($instagram_web) > 255) {
    $errors['instagram_web'] = 'El campo Instagram/Web es demasiado largo.';
  }

  // Validar consentimiento RGPD (obligatorio)
  // Los checkboxes envían "on" cuando están marcados, o no se envía nada si no están marcados
  if (!isset($_POST['consent_audit']) || $_POST['consent_audit'] !== 'on') {
    $errors['consent_audit'] = 'Debes aceptar el consentimiento para continuar.';
  }

  // Si hay errores de validación, detener
  if (!empty($errors)) {
    send_json(422, false, 'Por favor, corrige los errores en el formulario.', $errors);
  }


  // 5. INTERACCIÓN CON BASE DE DATOS (Lead + Consent ledger)
  // -------------------------------------------------------------------

  // Evidencia de consentimiento (texto + versionado)
  $consentKey = 'audit_marketing';
  $consentVersion = 'v1';
  $consentText = 'Acepto recibir mi vídeo de auditoría personalizado y comunicaciones sobre cómo mejorar mi presencia digital.';

  // Evidencia técnica básica
  $ipAddress = $_SERVER['REMOTE_ADDR'] ?? null;
  $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? substr($_SERVER['HTTP_USER_AGENT'], 0, 255) : null;
  $referrerUrl = isset($_SERVER['HTTP_REFERER']) ? substr($_SERVER['HTTP_REFERER'], 0, 2048) : null;
  $sourceUrl = isset($_POST['_source_url']) ? substr(trim($_POST['_source_url']), 0, 2048) : null;

  try {
    // Transacción: o se guardan ambos (lead + consent) o ninguno
    $pdo->beginTransaction();

    // 1) Insert Lead
    // Tabla nueva: leads(nombre,email,instagram_web,fecha_registro DEFAULT CURRENT_DATE)
    $sqlLead = "INSERT INTO `leads` (`nombre`, `email`, `instagram_web`)
                VALUES (:nombre, :email, :instagram_web)";
    $stmtLead = $pdo->prepare($sqlLead);

    if ($stmtLead === false) {
      $errorInfo = $pdo->errorInfo();
      error_log("PDO Prepare Error (lead): " . print_r($errorInfo, true));
      $pdo->rollBack();
      send_json(500, false, 'Error al preparar la consulta SQL (lead).');
    }

    $stmtLead->bindValue(':nombre', $name, PDO::PARAM_STR);
    $stmtLead->bindValue(':email', $email, PDO::PARAM_STR);
    // En tu schema `instagram_web` es NOT NULL, así que nunca enviamos NULL
    $stmtLead->bindValue(':instagram_web', $instagram_web !== '' ? $instagram_web : '-', PDO::PARAM_STR);

    $okLead = $stmtLead->execute();
    if ($okLead === false) {
      $errorInfo = $stmtLead->errorInfo();
      error_log("PDO Execute Error (lead): " . print_r($errorInfo, true));
      $pdo->rollBack();
      send_json(500, false, 'Error al insertar lead en la base de datos.');
    }

    $leadId = (int)$pdo->lastInsertId();

    // 2) Insert Consent (ledger)
    $sqlConsent = "INSERT INTO `consents`
      (`subject_type`, `subject_id`, `consent_key`, `granted`, `consent_version`, `consent_text`,
       `ip_address`, `user_agent`, `source_url`, `referrer_url`, `payload_json`)
      VALUES
      (:subject_type, :subject_id, :consent_key, :granted, :consent_version, :consent_text,
       :ip_address, :user_agent, :source_url, :referrer_url, :payload_json)";

    $stmtConsent = $pdo->prepare($sqlConsent);
    if ($stmtConsent === false) {
      $errorInfo = $pdo->errorInfo();
      error_log("PDO Prepare Error (consent): " . print_r($errorInfo, true));
      $pdo->rollBack();
      send_json(500, false, 'Error al preparar la consulta SQL (consent).');
    }

    $payload = [
      'form' => 'audit-form',
      'consent_field' => 'consent_audit',
    ];

    $stmtConsent->bindValue(':subject_type', 'lead', PDO::PARAM_STR);
    $stmtConsent->bindValue(':subject_id', $leadId, PDO::PARAM_INT);
    $stmtConsent->bindValue(':consent_key', $consentKey, PDO::PARAM_STR);
    $stmtConsent->bindValue(':granted', 1, PDO::PARAM_INT);
    $stmtConsent->bindValue(':consent_version', $consentVersion, PDO::PARAM_STR);
    $stmtConsent->bindValue(':consent_text', $consentText, PDO::PARAM_STR);
    $stmtConsent->bindValue(':ip_address', $ipAddress, PDO::PARAM_STR);
    $stmtConsent->bindValue(':user_agent', $userAgent, PDO::PARAM_STR);
    $stmtConsent->bindValue(':source_url', $sourceUrl, PDO::PARAM_STR);
    $stmtConsent->bindValue(':referrer_url', $referrerUrl, PDO::PARAM_STR);
    $stmtConsent->bindValue(
      ':payload_json',
      json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
      PDO::PARAM_STR
    );

    $okConsent = $stmtConsent->execute();
    if ($okConsent === false) {
      $errorInfo = $stmtConsent->errorInfo();
      error_log("PDO Execute Error (consent): " . print_r($errorInfo, true));
      $pdo->rollBack();
      send_json(500, false, 'Error al registrar el consentimiento.');
    }

    $pdo->commit();

    send_json(200, true, '¡Formulario enviado correctamente! Recibirás tu auditoría en breve.');
  } catch (PDOException $dbException) {
    error_log("Database Transaction PDOException: " . $dbException->getMessage());
    if ($pdo->inTransaction()) {
      $pdo->rollBack();
    }
    send_json(500, false, 'Error interno del servidor. Inténtalo más tarde.');
  } catch (Exception $e) {
    error_log("Database Transaction Exception: " . $e->getMessage());
    if ($pdo->inTransaction()) {
      $pdo->rollBack();
    }
    send_json(500, false, 'Ocurrió un error inesperado.');
  }
} catch (PDOException $e) {
  // Log interno del error real
  error_log("Outer PDOException: " . $e->getMessage());
  error_log("PDO Error Code: " . $e->getCode());
  $errorInfo = $e->errorInfo ?? [];
  if (!empty($errorInfo)) {
    error_log("PDO Error Info: " . print_r($errorInfo, true));
  }
  // Respuesta genérica al usuario
  send_json(500, false, 'Error interno del servidor. Inténtalo más tarde.');
} catch (Exception $e) {
  error_log("Outer General Exception: " . $e->getMessage());
  error_log("Exception Trace: " . $e->getTraceAsString());
  send_json(500, false, 'Ocurrió un error inesperado.');
}
