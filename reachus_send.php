<?php

// Simple endpoint to receive contact form with only name, email, message
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Invalid request method.';
    exit;
}

$nm = trim($_POST['name'] ?? '');
$em = trim($_POST['email'] ?? '');
$ms = trim($_POST['message'] ?? '');

// basic validation
if ($nm === '' || $em === '' || $ms === '' || !filter_var($em, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo 'Missing or invalid fields.';
    exit;
}

$file = __DIR__ . '/contacts/enquiries.json';
$record = [
    'name' => $nm,
    'email' => $em,
    'message' => $ms,
    'timestamp' => date('Y-m-d H:i:s')
];

$existing = [];
if (file_exists($file) && filesize($file) > 0) {
    $content = file_get_contents($file);
    $decoded = json_decode($content, true);
    if (is_array($decoded)) $existing = $decoded;
}

$existing[] = $record;

if (file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX)) {
    echo 'OK';
} else {
    http_response_code(500);
    echo 'Error saving record.';
}

?>