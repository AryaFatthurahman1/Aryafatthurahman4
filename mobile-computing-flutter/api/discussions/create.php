<?php
/**
 * Create Discussion API Endpoint
 * POST /api/discussions/create.php
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
if (empty($data->user_id) || empty($data->title) || empty($data->message)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'User ID, title, dan message harus diisi'
    ]);
    exit();
}

// Database connection
$database = new Database();
$db = $database->getConnection();

// Insert new discussion
$query = "INSERT INTO discussions (user_id, title, message) 
          VALUES (:user_id, :title, :message)";

$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $data->user_id);
$stmt->bindParam(':title', $data->title);
$stmt->bindParam(':message', $data->message);

if ($stmt->execute()) {
    $discussion_id = $db->lastInsertId();
    
    // Get the created discussion with user info
    $get_query = "SELECT d.id, d.title, d.message, d.created_at,
                         u.id as user_id, u.name as user_name, u.profile_image as user_image
                  FROM discussions d
                  LEFT JOIN users u ON d.user_id = u.id
                  WHERE d.id = :id
                  LIMIT 1";
    
    $get_stmt = $db->prepare($get_query);
    $get_stmt->bindParam(':id', $discussion_id, PDO::PARAM_INT);
    $get_stmt->execute();
    $row = $get_stmt->fetch(PDO::FETCH_ASSOC);
    
    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'Diskusi berhasil dibuat',
        'data' => [
            'id' => (int)$row['id'],
            'title' => $row['title'],
            'message' => $row['message'],
            'created_at' => $row['created_at'],
            'user' => [
                'id' => (int)$row['user_id'],
                'name' => $row['user_name'],
                'profile_image' => $row['user_image']
            ]
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Gagal membuat diskusi'
    ]);
}
?>
