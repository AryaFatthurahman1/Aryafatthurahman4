<?php
// Konfigurasi Base URL
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    define('BASE_URL', '/kursus_online/');
} else {
    define('BASE_URL', '/');
}

// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kursus_online');

// Koneksi ke database
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Memulai session
session_start();
?>

