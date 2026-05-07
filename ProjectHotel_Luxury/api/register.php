<?php
// Nama: Muhammad Arya Fatthurahman | NIM: 2023230006
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $photo = "https://i.pravatar.cc/150?u=" . $username;

    // Check if username exists
    $check = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        respond("error", "Username sudah digunakan");
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO users (full_name, nim, email, username, password, photo) VALUES ('$full_name', '$nim', '$email', '$username', '$password', '$photo')");
        
        if ($query) respond("success", "Registrasi Berhasil");
        else respond("error", "Gagal Registrasi: " . mysqli_error($koneksi));
    }
} else {
    respond("error", "Method Not Allowed");
}
?>
