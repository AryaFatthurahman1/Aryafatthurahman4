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

    $summary = $db->query("
        SELECT
            (SELECT COUNT(*) FROM products WHERE is_active = 1) AS total_products,
            (SELECT COUNT(*) FROM categories WHERE is_active = 1) AS total_categories,
            (SELECT COUNT(*) FROM products WHERE stock <= min_stock_level AND is_active = 1) AS low_stock_products,
            (SELECT COALESCE(SUM(final_amount), 0) FROM orders WHERE DATE(order_date) = CURDATE()) AS today_sales
    ")->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'message' => 'Ringkasan dashboard berhasil diambil',
        'data' => $summary,
    ]);
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Gagal mengambil ringkasan dashboard',
        'error' => $exception->getMessage(),
    ]);
}
?>
