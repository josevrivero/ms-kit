<?php
/**
 * @file: submit-audit.php
 * @description: Public API endpoint for audit form submission
 * @author: MS-KIT v1.0
 * 
 * This endpoint serves as the entry point from the frontend
 * and delegates to the secure form handler.
 */

// Ruta relativa al handler desde public/api/
require_once __DIR__ . '/../../src/handlers/form-handler.php';

