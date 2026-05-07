<?php
include_once __DIR__ . '/config/cors.php';
include_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

try {
    $database = new Database();
    $db = $database->getConnection();
    $db->query('SELECT 1');

    echo json_encode([
        'success' => true,
        'status' => 'ok',
        'message' => 'API PHP dan database aktif',
        'timestamp' => date('c'),
    ]);
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'status' => 'error',
        'message' => 'Koneksi database gagal',
        'error' => $exception->getMessage(),
        'timestamp' => date('c'),
    ]);
}
?>
