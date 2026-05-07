<?php
/**
 * Login API Endpoint
 * POST /api/auth/login.php
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
if (empty($data->email) || empty($data->password)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Email dan password harus diisi'
    ]);
    exit();
}

// Database connection
$database = new Database();
$db = $database->getConnection();

// Query user
$query = "SELECT id, name, email, password, phone, profile_image, bio, created_at 
          FROM users 
          WHERE email = :email 
          LIMIT 1";

$stmt = $db->prepare($query);
$stmt->bindParam(':email', $data->email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Verify password
    if (password_verify($data->password, $row['password'])) {
        // Generate simple token (in production, use JWT)
        $token = bin2hex(random_bytes(32));
        
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user' => [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'profile_image' => $row['profile_image'],
                    'bio' => $row['bio'],
                    'created_at' => $row['created_at']
                ],
                'token' => $token
            ]
        ]);
    } else {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'Email atau password salah'
        ]);
    }
} else {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => 'Email atau password salah'
    ]);
}
?>
