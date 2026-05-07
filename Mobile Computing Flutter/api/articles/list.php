<?php
/**
 * Articles List API Endpoint
 * GET /api/articles/list.php
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
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$offset = ($page - 1) * $limit;

// Build query
$where_conditions = [];
$params = [];

if (!empty($search)) {
    $where_conditions[] = "(a.title LIKE :search OR a.content LIKE :search)";
    $params[':search'] = "%$search%";
}

if (!empty($category)) {
    $where_conditions[] = "a.category = :category";
    $params[':category'] = $category;
}

$where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";

// Count total
$count_query = "SELECT COUNT(*) as total FROM articles a $where_clause";
$count_stmt = $db->prepare($count_query);
foreach ($params as $key => $value) {
    $count_stmt->bindValue($key, $value);
}
$count_stmt->execute();
$total = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Get articles
$query = "SELECT a.id, a.title, a.content, a.image_url, a.category, a.views, a.created_at,
                 u.name as author_name, u.profile_image as author_image
          FROM articles a
          LEFT JOIN users u ON a.author_id = u.id
          $where_clause
          ORDER BY a.created_at DESC
          LIMIT :limit OFFSET :offset";

$stmt = $db->prepare($query);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$articles = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Truncate content for list view
    $content_preview = substr($row['content'], 0, 150) . '...';
    
    $articles[] = [
        'id' => (int)$row['id'],
        'title' => $row['title'],
        'content_preview' => $content_preview,
        'image_url' => $row['image_url'],
        'category' => $row['category'],
        'views' => (int)$row['views'],
        'author_name' => $row['author_name'],
        'author_image' => $row['author_image'],
        'created_at' => $row['created_at']
    ];
}

http_response_code(200);
echo json_encode([
    'success' => true,
    'message' => 'Data artikel berhasil diambil',
    'data' => [
        'articles' => $articles,
        'pagination' => [
            'current_page' => $page,
            'total_pages' => ceil($total / $limit),
            'total_items' => (int)$total,
            'items_per_page' => $limit
        ]
    ]
]);
?>
