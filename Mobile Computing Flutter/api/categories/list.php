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

    $sql = "
        SELECT
            c.category_id,
            c.category_name,
            c.description,
            COUNT(p.product_id) AS total_products
        FROM categories c
        LEFT JOIN products p ON p.category_id = c.category_id AND p.is_active = 1
        WHERE c.is_active = 1
        GROUP BY c.category_id, c.category_name, c.description
        ORDER BY c.sort_order ASC, c.category_name ASC
    ";

    $rows = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'message' => 'Kategori berhasil diambil',
        'data' => [
            'categories' => $rows,
        ],
    ]);
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Gagal mengambil kategori',
        'error' => $exception->getMessage(),
    ]);
}
?>
