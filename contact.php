<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$errors = [];

$firstName = trim($_POST['firstName'] ?? '');
$lastName  = trim($_POST['lastName']  ?? '');
$email     = trim($_POST['email']     ?? '');
$service   = trim($_POST['service']   ?? '');
$message   = trim($_POST['message']   ?? '');

if ($firstName === '') $errors['firstName'] = 'First name is required.';
if ($lastName  === '') $errors['lastName']  = 'Last name is required.';
if ($email     === '') {
    $errors['email'] = 'Email address is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
}
if ($message === '') $errors['message'] = 'Message is required.';

if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

$file = __DIR__ . '/contacts/enquiries.json';

$record = [
    'firstName' => $firstName,
    'lastName'  => $lastName,
    'email'     => $email,
    'service'   => $service,
    'message'   => $message,
    'timestamp' => date('Y-m-d H:i:s'),
];

$existing = [];
if (file_exists($file) && filesize($file) > 2) {
    $decoded = json_decode(file_get_contents($file), true);
    if (is_array($decoded)) {
        $existing = $decoded;
    }
}

$existing[] = $record;

if (file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Unable to save your enquiry. Please try again or email us at info@zivande.com.']);
}
