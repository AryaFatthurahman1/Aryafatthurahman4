<?php
/**
 * Register API Endpoint
 * POST /api/auth/register.php
 */

include_once '../config/cors.php';
include_once '../config/database.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Get posted data
$data = json_decode(file_get_contents("php://input"));

// Validate input
if (empty($data->name) || empty($data->email) || empty($data->password)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Nama, email, dan password harus diisi'
    ]);
    exit();
}

// Validate email format
if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Format email tidak valid'
    ]);
    exit();
}

// Database connection
$database = new Database();
$db = $database->getConnection();

// Check if email already exists
$check_query = "SELECT id FROM users WHERE email = :email LIMIT 1";
$check_stmt = $db->prepare($check_query);
$check_stmt->bindParam(':email', $data->email);
$check_stmt->execute();

if ($check_stmt->rowCount() > 0) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Email sudah terdaftar'
    ]);
    exit();
}

// Hash password
$hashed_password = password_hash($data->password, PASSWORD_DEFAULT);

// Generate profile image URL
$profile_image = 'https://ui-avatars.com/api/?name=' . urlencode($data->name) . '&background=4F46E5&color=fff';

// Insert new user
$query = "INSERT INTO users (name, email, password, phone, profile_image, bio) 
          VALUES (:name, :email, :password, :phone, :profile_image, :bio)";

$stmt = $db->prepare($query);
$stmt->bindParam(':name', $data->name);
$stmt->bindParam(':email', $data->email);
$stmt->bindParam(':password', $hashed_password);
$stmt->bindParam(':phone', $data->phone ?? '');
$stmt->bindParam(':profile_image', $profile_image);
$stmt->bindParam(':bio', $data->bio ?? '');

if ($stmt->execute()) {
    $user_id = $db->lastInsertId();
    
    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'Registrasi berhasil',
        'data' => [
            'user' => [
                'id' => $user_id,
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone ?? '',
                'profile_image' => $profile_image,
                'bio' => $data->bio ?? ''
            ]
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Registrasi gagal'
    ]);
}
?>
