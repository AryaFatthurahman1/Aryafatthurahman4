<?php
/**
 * User Profile API Endpoint
 * GET /api/users/profile.php?id=1
 * PUT /api/users/profile.php
 */

include_once '../config/cors.php';
include_once '../config/database.php';

// Database connection
$database = new Database();
$db = $database->getConnection();

// GET - Get user profile
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Validate input
    if (empty($_GET['id'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'User ID harus diisi'
        ]);
        exit();
    }
    
    $user_id = (int)$_GET['id'];
    
    // Get user profile
    $query = "SELECT id, name, email, phone, profile_image, bio, created_at
              FROM users
              WHERE id = :id
              LIMIT 1";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Data profil berhasil diambil',
            'data' => [
                'id' => (int)$row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'profile_image' => $row['profile_image'],
                'bio' => $row['bio'],
                'created_at' => $row['created_at']
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'User tidak ditemukan'
        ]);
    }
}

// PUT - Update user profile
elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Validate input
    if (empty($data->id)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'User ID harus diisi'
        ]);
        exit();
    }
    
    // Build update query
    $update_fields = [];
    $params = [':id' => $data->id];
    
    if (!empty($data->name)) {
        $update_fields[] = "name = :name";
        $params[':name'] = $data->name;
    }
    
    if (!empty($data->phone)) {
        $update_fields[] = "phone = :phone";
        $params[':phone'] = $data->phone;
    }
    
    if (!empty($data->bio)) {
        $update_fields[] = "bio = :bio";
        $params[':bio'] = $data->bio;
    }
    
    if (empty($update_fields)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Tidak ada data yang diupdate'
        ]);
        exit();
    }
    
    $query = "UPDATE users SET " . implode(", ", $update_fields) . " WHERE id = :id";
    
    $stmt = $db->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    if ($stmt->execute()) {
        // Get updated profile
        $get_query = "SELECT id, name, email, phone, profile_image, bio, created_at
                      FROM users
                      WHERE id = :id
                      LIMIT 1";
        
        $get_stmt = $db->prepare($get_query);
        $get_stmt->bindParam(':id', $data->id, PDO::PARAM_INT);
        $get_stmt->execute();
        $row = $get_stmt->fetch(PDO::FETCH_ASSOC);
        
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Profil berhasil diupdate',
            'data' => [
                'id' => (int)$row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'profile_image' => $row['profile_image'],
                'bio' => $row['bio'],
                'created_at' => $row['created_at']
            ]
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Gagal update profil'
        ]);
    }
}

else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>
