<?php
// Nama: Muhammad Arya Fatthurahman | NIM: 2023230006
require_once 'config.php';

$type = $_GET['type'] ?? '';

if ($type == 'login') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        respond("success", "Login Berhasil", $user);
    } else {
        respond("error", "Username atau Password salah");
    }
} elseif ($type == 'register') {
    $full_name = $_POST['full_name'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $photo = "https://i.pravatar.cc/150?u=" . $username;

    $query = mysqli_query($koneksi, "INSERT INTO users (full_name, nim, email, username, password, photo) VALUES ('$full_name', '$nim', '$email', '$username', '$password', '$photo')");
    
    if ($query) respond("success", "Registrasi Berhasil");
    else respond("error", "Gagal Registrasi");
}
?>
