<?php
// Nama: Muhammad Arya Fatthurahman
// NIM: 2023230006
require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$type = $_GET['type'] ?? '';

switch ($method) {
    case 'GET':
        $user_id = $_GET['user_id'] ?? '';
        $query = mysqli_query($koneksi, "SELECT * FROM tasks WHERE user_id = '$user_id' ORDER BY month_index ASC");
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        respond("success", "Data berhasil diambil", $data);
        break;

    case 'POST':
        if ($type == 'add') {
            $user_id = $_POST['user_id'];
            $title = $_POST['title'];
            $priority = $_POST['priority'];
            $month = $_POST['month_index'];
            $date = date('Y-m-d');

            $query = mysqli_query($koneksi, "INSERT INTO tasks (user_id, title, priority, month_index, created_at) VALUES ('$user_id', '$title', '$priority', '$month', '$date')");
            if ($query) respond("success", "Tugas berhasil ditambahkan");
            else respond("error", "Gagal menambah tugas");

        } elseif ($type == 'update') {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $priority = $_POST['priority'];

            $query = mysqli_query($koneksi, "UPDATE tasks SET title = '$title', priority = '$priority' WHERE id = '$id'");
            if ($query) respond("success", "Tugas berhasil diperbarui");
            else respond("error", "Gagal memperbarui tugas");
        }
        break;

    case 'DELETE':
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "DELETE FROM tasks WHERE id = '$id'");
        if ($query) respond("success", "Tugas berhasil dihapus");
        else respond("error", "Gagal menghapus tugas");
        break;

    default:
        respond("error", "Metode tidak didukung");
        break;
}
?>
