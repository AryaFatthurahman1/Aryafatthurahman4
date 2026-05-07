<?php
include_once __DIR__ . '/../config/cors.php';
include_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

try {
    $database = new Database();
    $db = $database->getConnection();

    $search = trim($_GET['search'] ?? '');
    $categoryId = isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;
    $featuredOnly = isset($_GET['featured']) && $_GET['featured'] === '1';
    $limit = isset($_GET['limit']) ? max(1, min(50, (int) $_GET['limit'])) : 12;

    $conditions = ['p.is_active = 1'];
    $params = [];

    if ($search !== '') {
        $conditions[] = '(p.product_name LIKE :search OR p.sku LIKE :search)';
        $params[':search'] = '%' . $search . '%';
    }

    if ($categoryId > 0) {
        $conditions[] = 'p.category_id = :category_id';
        $params[':category_id'] = $categoryId;
    }

    if ($featuredOnly) {
        $conditions[] = 'p.is_featured = 1';
    }

    $whereClause = 'WHERE ' . implode(' AND ', $conditions);

    $sql = "
        SELECT
            p.product_id,
            p.product_name,
            p.sku,
            p.description,
            p.price,
            p.stock,
            p.rating,
            p.is_featured,
            c.category_name
        FROM products p
        INNER JOIN categories c ON c.category_id = p.category_id
        $whereClause
        ORDER BY p.is_featured DESC, p.rating DESC, p.product_name ASC
        LIMIT :limit
    ";

    $stmt = $db->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'message' => 'Produk berhasil diambil',
        'data' => [
            'products' => $products,
        ],
    ]);
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Gagal mengambil produk',
        'error' => $exception->getMessage(),
    ]);
}
?>
