<?php

/**
 * MEIKING SYSTEMS - Lead Capture Handler
 * Seguridad: Validación Dual + Prepared Statements
 */

require_once '../config/db.php';
require_once '../utils/sanitizer.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 1. Sanitización de Inputs (No confiamos en el cliente)
  $nombre = MS_Sanitizer::clean($_POST['nombre'] ?? '');
  $email  = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
  $clinica = MS_Sanitizer::clean($_POST['clinica'] ?? '');

  // 2. Validación Backend
  if (empty($nombre) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
    exit;
  }

  try {
    // 3. Persistencia en MySQL (Prepared Statements - Anti SQL Injection)
    $sql = "INSERT INTO leads (nombre, email, clinica, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $email, $clinica]);

    // 4. (Opcional) Notificación Slack/Email aquí

    echo json_encode(['success' => true, 'message' => 'Lead capturado con éxito.']);
  } catch (PDOException $e) {
    // No revelamos errores técnicos al cliente (Seguridad)
    echo json_encode(['success' => false, 'message' => 'Error en servidor local.']);
  }
}
