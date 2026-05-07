<?php
// Nama: Muhammad Arya Fatthurahman | NIM: 2023230006
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update Profile
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    // Optional: Update password / photo logic could be added here

    $query = "UPDATE users SET full_name='$full_name', email='$email', phone='$phone', address='$address' WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        // Return updated user data
        $userQuery = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$id'");
        $userData = mysqli_fetch_assoc($userQuery);
        respond("success", "Profil Berhasil Diupdate", $userData);
    } else {
        respond("error", "Gagal Update Profil: " . mysqli_error($koneksi));
    }
} else {
    // Get Profile
    $id = $_GET['id'] ?? null;
    if ($id) {
        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$id'");
        $data = mysqli_fetch_assoc($query);
        if ($data) {
            respond("success", "Profil Ditemukan", $data);
        } else {
            respond("error", "User tidak ditemukan");
        }
    } else {
        respond("error", "ID diperlukan");
    }
}
?>
