<?php
// Nama: Muhammad Arya Fatthurahman | NIM: 2023230006
require_once 'config.php';

$table = $_GET['table'] ?? '';

$allowed_tables = ['hotels', 'articles', 'users']; // Security whitelist

if (in_array($table, $allowed_tables)) {
    $query = mysqli_query($koneksi, "SELECT * FROM $table");
    $data = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    respond("success", "Data $table Berhasil Diambil", $data);
} else {
    respond("error", "Tabel tidak valid atau tidak diizinkan");
}
?>
