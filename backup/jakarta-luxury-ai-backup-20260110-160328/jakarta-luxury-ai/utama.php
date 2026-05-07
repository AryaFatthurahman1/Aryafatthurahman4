<?php
/**
 * Jakarta Luxury AI - Titik Masuk Utama
 * File ini menangani routing dan melayani aplikasi React dari publik/dist.
 */

// Header dasar
header("Access-Control-Allow-Origin: *");

$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];
$base_dir = dirname($script_name);

// Bersihkan URI permintaan dan direktori dasar untuk pencocokan jalur
$request_path = parse_url($request_uri, PHP_URL_PATH);

// Tentukan jalur relatif dari direktori dasar
if ($base_dir !== '/' && strpos($request_path, $base_dir) === 0) {
    $relative_path = substr($request_path, strlen($base_dir));
} else {
    $relative_path = $request_path;
}

$relative_path = ltrim($relative_path, '/');

// Tentukan jalur fisik ke direktori build
$dist_path = __DIR__ . '/publik/dist/';
$file_to_serve = $dist_path . $relative_path;

// 1. Layani file statis jika ada di folder dist
if (!empty($relative_path) && file_exists($file_to_serve) && !is_dir($file_to_serve)) {
    // Deteksi tipe MIME
    $extension = pathinfo($file_to_serve, PATHINFO_EXTENSION);
    $mime_types = [
        'js'   => 'application/javascript',
        'css'  => 'text/css',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
        'ico'  => 'image/x-icon',
        'json' => 'application/json',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
        'ttf'  => 'font/ttf'
    ];
    
    $mime = isset($mime_types[$extension]) ? $mime_types[$extension] : mime_content_type($file_to_serve);
    header("Content-Type: $mime");
    readfile($file_to_serve);
    exit;
}

// 2. Layani file utama index.html untuk rute lain (SPA)
$index_file = $dist_path . 'index.html';
if (file_exists($index_file)) {
    header("Content-Type: text/html; charset=UTF-8");
    readfile($index_file);
} else {
    http_response_code(404);
    echo "<h1>Jakarta Luxury AI</h1>";
    echo "<p>Kesalahan: Build React tidak ditemukan di <code>publik/dist/index.html</code>.</p>";
    echo "<p>Silakan jalankan <code>npm run build</code> untuk membuat aplikasi.</p>";
}
?>
