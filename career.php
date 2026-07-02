<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$errors = [];

$name           = trim($_POST['name']           ?? '');
$email          = trim($_POST['email']          ?? '');
$phone          = trim($_POST['phone']          ?? '');
$experience     = trim($_POST['experience']     ?? '');
$qualification  = trim($_POST['qualification']  ?? '');
$specialization = trim($_POST['specialization'] ?? '');
$location       = trim($_POST['location']       ?? '');
$summary        = trim($_POST['summary']        ?? '');

if ($name === '') {
    $errors['name'] = 'Full name is required.';
} elseif (strlen($name) < 2) {
    $errors['name'] = 'Please enter your full name.';
}

if ($email === '') {
    $errors['email'] = 'Email address is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
}

if ($phone === '') {
    $errors['phone'] = 'Phone number is required.';
} elseif (!preg_match('/^\d{10}$/', $phone)) {
    $errors['phone'] = 'Please enter a valid 10-digit phone number.';
}

if ($experience === '') {
    $errors['experience'] = 'Experience is required.';
}

if ($qualification === '') {
    $errors['qualification'] = 'Qualification is required.';
}

if ($specialization === '') {
    $errors['specialization'] = 'Specialization is required.';
}

if ($location === '') {
    $errors['location'] = 'Location is required.';
}

if ($summary === '') {
    $errors['summary'] = 'Summary is required.';
} elseif (strlen($summary) < 20) {
    $errors['summary'] = 'Please provide at least 20 characters in the summary.';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

$payload = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'experience' => $experience,
    'qualification' => $qualification,
    'specialization' => $specialization,
    'location' => $location,
    'summary' => $summary,
    'timestamp' => date('Y-m-d H:i:s'),
];

$directory = __DIR__ . '/career';
$filePath = $directory . '/career_enquiries.json';

if (!is_dir($directory) && !mkdir($directory, 0777, true)) {
    echo json_encode(['success' => false, 'message' => 'Could not create data directory.']);
    exit;
}

$existingData = [];
if (file_exists($filePath) && filesize($filePath) > 0) {
    $fileContents = file_get_contents($filePath);
    if ($fileContents !== false) {
        $decoded = json_decode($fileContents, true);
        if (is_array($decoded)) {
            $existingData = $decoded;
        }
    }
}

$existingData[] = $payload;

try {
    $jsonData = json_encode($existingData, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
} catch (Throwable $e) {
    echo json_encode(['success' => false, 'message' => 'Unable to serialize application data.']);
    exit;
}

if (file_put_contents($filePath, $jsonData) !== false) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Unable to save application. Please try again later.']);
}
