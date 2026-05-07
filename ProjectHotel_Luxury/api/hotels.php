<?php
// Nama: Muhammad Arya Fatthurahman | NIM: 2023230006
require_once 'config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Get Hotel Detail
    $query = mysqli_query($koneksi, "SELECT * FROM hotels WHERE id = $id");
    $data = mysqli_fetch_assoc($query);
    if ($data) {
        respond("success", "Detail Hotel Ditemukan", $data);
    } else {
        respond("error", "Hotel tidak ditemukan");
    }
} else {
    // Get All Hotels
    $query = mysqli_query($koneksi, "SELECT * FROM hotels ORDER BY id DESC");
    $data = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    respond("success", "List Hotel Berhasil Diambil", $data);
}
?>
