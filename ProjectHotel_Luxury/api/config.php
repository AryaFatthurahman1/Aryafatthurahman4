<?php
// Nama: Muhammad Arya Fatthurahman
// NIM: 2023230006
// API Hosting: arya.bersama.cloud

$host = "localhost";
$user = "root";      // Sesuaikan saat di hosting
$pass = "";          // Sesuaikan saat di hosting
$db   = "project_hotel";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    echo json_encode(["status" => "error", "message" => "Koneksi Database Gagal: " . mysqli_connect_error()]);
    exit;
}

// Header untuk CORS & JSON Response
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json; charset=utf-8');

// Handle Preflight Request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Fungsi helper untuk respond API
function respond($status, $message, $data = null) {
    echo json_encode([
        "status" => $status,
        "message" => $message,
        "data" => $data,
        "author" => "Muhammad Arya Fatthurahman"
    ]);
    exit;
}
?>
