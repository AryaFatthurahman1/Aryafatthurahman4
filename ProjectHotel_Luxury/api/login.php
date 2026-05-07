<?php
// Nama: Muhammad Arya Fatthurahman | NIM: 2023230006
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        respond("success", "Login Berhasil", $user);
    } else {
        respond("error", "Username atau Password salah");
    }
} else {
    respond("error", "Method Not Allowed");
}
?>
