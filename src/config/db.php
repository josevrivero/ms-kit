<?php

/**
 * @file: db.php
 * @description: Database connection using PDO with security best practices
 * @author: MS-KIT v1.0
 */

try {
  $pdo = new PDO(
    "mysql:host=127.0.0.1;port=3307;dbname=meiking_systems;charset=utf8mb4",
    // XAMPP default creds (ajusta si usas otro usuario)
    "root",
    "",
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false // Usar prepared statements nativos
    ]
  );
  return $pdo;
} catch (PDOException $e) {
  error_log("Database Connection Error: " . $e->getMessage());
  // Lanzar excepción en lugar de die() para que el handler pueda manejarla
  throw new PDOException("Error de conexión a la base de datos", 0, $e);
}
