<?php
/**
 * Discussions List API Endpoint
 * GET /api/discussions/list.php
 */

include_once '../config/cors.php';
include_once '../config/database.php';

// Only accept GET requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Database connection
$database = new Database();
$db = $database->getConnection();

// Get query parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;
$user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;

$offset = ($page - 1) * $limit;

// Build query
$where_clause = $user_id ? "WHERE d.user_id = :user_id" : "";

// Count total
$count_query = "SELECT COUNT(*) as total FROM discussions d $where_clause";
$count_stmt = $db->prepare($count_query);
if ($user_id) {
    $count_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
}
$count_stmt->execute();
$total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Get discussions
$query = "SELECT d.id, d.title, d.message, d.created_at,
                 u.id as user_id, u.name as user_name, u.profile_image as user_image
          FROM discussions d
          LEFT JOIN users u ON d.user_id = u.id
          $where_clause
          ORDER BY d.created_at DESC
          LIMIT :limit OFFSET :offset";

$stmt = $db->prepare($query);
if ($user_id) {
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$discussions = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $discussions[] = [
        'id' => (int)$row['id'],
        'title' => $row['title'],
        'message' => $row['message'],
        'created_at' => $row['created_at'],
        'user' => [
            'id' => (int)$row['user_id'],
            'name' => $row['user_name'],
            'profile_image' => $row['user_image']
        ]
    ];
}

http_response_code(200);
echo json_encode([
    'success' => true,
    'message' => 'Data diskusi berhasil diambil',
    'data' => [
        'discussions' => $discussions,
        'pagination' => [
            'current_page' => $page,
            'total_pages' => ceil($total / $limit),
            'total_items' => (int)$total,
            'items_per_page' => $limit
        ]
    ]
]);
?>
