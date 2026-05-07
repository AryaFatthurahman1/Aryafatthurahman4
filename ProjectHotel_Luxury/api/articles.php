<?php
// Nama: Muhammad Arya Fatthurahman | NIM: 2023230006
require_once 'config.php';

// Get All Articles
$query = mysqli_query($koneksi, "SELECT * FROM articles ORDER BY published_date DESC");
$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

respond("success", "List Artikel Berhasil Diambil", $data);
?>
