# REGLA: PHP SEGURO Y MODULAR

## CUÁNDO APLICA
- Auto-attach a archivos *.php
- PRIORITARIO: SEGURIDAD CRÍTICA

## ESTRUCTURA BASE

### 1. HEADER Y SEGURIDAD INMEDIATA
```php
<?php
/**
 * @file: submit-form.php
 * @method: POST
 * @csrf_protection: true
 * @rate_limiting: true
 * @input_sanitization: true
 */

session_start();

// 1. VALIDAR MÉTODO
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['success' => false]));
}

// 2. VALIDAR CSRF TOKEN
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    http_response_code(403);
    die(json_encode(['success' => false, 'message' => 'CSRF token inválido']));
}

// 3. RATE LIMITING
$ip = $_SERVER['REMOTE_ADDR'];
$key = "submissions_$ip";
$attempts = apcu_fetch($key) ?? 0;

if ($attempts >= 5) {
    http_response_code(429);
    die(json_encode(['success' => false, 'message' => 'Demasiados intentos']));
}
apcu_store($key, $attempts + 1, 60);

// ... resto de lógica
```

### 2. SANITIZACIÓN
```php
// ✅ Correcto: Sanitizar SIEMPRE
$name = trim(strip_tags($_POST['name'] ?? ''));
$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$phone = preg_replace('/[^0-9\s\-\+\(\)]/', '', $_POST['phone'] ?? '');

// ❌ Incorrecto: Usar directamente
$name = $_POST['name'];  // PELIGROSO
```

### 3. VALIDACIÓN
```php
$errors = [];

if (strlen($name) < 3) {
    $errors['name'] = 'Mínimo 3 caracteres';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Email inválido';
}

if (!empty($errors)) {
    http_response_code(422);
    die(json_encode(['success' => false, 'errors' => $errors]));
}
```

### 4. DATABASE (PREPARED STATEMENTS)
```php
// ✅ Correcto: Prepared statements
$stmt = $pdo->prepare('INSERT INTO bookings (name, email) VALUES (:name, :email)');
$stmt->execute([':name' => $name, ':email' => $email]);

// ❌ Incorrecto: SQL injection
$query = "INSERT INTO bookings VALUES ('$name', '$email')";
```

### 5. RESPUESTA JSON
```php
// Éxito
http_response_code(200);
echo json_encode([
    'success' => true,
    'message' => 'Reserva confirmada',
    'booking_id' => $id,
]);

// Error validación
http_response_code(422);
echo json_encode(['success' => false, 'errors' => $errors]);

// Error servidor
http_response_code(500);
error_log($e->getMessage()); // Log para admin
echo json_encode(['success' => false]);
```

### 6. VALIDACIÓN
- [ ] Prepared statements siempre
- [ ] Sanitización en entrada
- [ ] Validación en lógica
- [ ] Sin información sensible en errores públicos
- [ ] Error log en servidor (no cliente)