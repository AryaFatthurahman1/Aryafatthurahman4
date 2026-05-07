<?php
/**
 * Article Detail API Endpoint
 * GET /api/articles/detail.php?id=1
 */

include_once '../config/cors.php';
include_once '../config/database.php';

// Only accept GET requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Validate input
if (empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Article ID harus diisi'
    ]);
    exit();
}

$article_id = (int)$_GET['id'];

// Database connection
$database = new Database();
$db = $database->getConnection();

// Get article detail
$query = "SELECT a.id, a.title, a.content, a.image_url, a.category, a.views, a.created_at, a.updated_at,
                 u.id as author_id, u.name as author_name, u.profile_image as author_image, u.bio as author_bio
          FROM articles a
          LEFT JOIN users u ON a.author_id = u.id
          WHERE a.id = :id
          LIMIT 1";

$stmt = $db->prepare($query);
$stmt->bindParam(':id', $article_id, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Increment view count
    $update_query = "UPDATE articles SET views = views + 1 WHERE id = :id";
    $update_stmt = $db->prepare($update_query);
    $update_stmt->bindParam(':id', $article_id, PDO::PARAM_INT);
    $update_stmt->execute();
    
    $article = [
        'id' => (int)$row['id'],
        'title' => $row['title'],
        'content' => $row['content'],
        'image_url' => $row['image_url'],
        'category' => $row['category'],
        'views' => (int)$row['views'] + 1,
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at'],
        'author' => [
            'id' => (int)$row['author_id'],
            'name' => $row['author_name'],
            'profile_image' => $row['author_image'],
            'bio' => $row['author_bio']
        ]
    ];
    
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Detail artikel berhasil diambil',
        'data' => $article
    ]);
} else {
    http_response_code(404);
    echo json_encode([
        'success' => false,
        'message' => 'Artikel tidak ditemukan'
    ]);
}
?>
