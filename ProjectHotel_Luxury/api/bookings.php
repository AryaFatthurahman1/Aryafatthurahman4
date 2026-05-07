<?php
// Nama: Muhammad Arya Fatthurahman | NIM: 2023230006
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create New Booking
    $user_id = $_POST['user_id'];
    $hotel_id = $_POST['hotel_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $total_price = $_POST['total_price'];

    $query = "INSERT INTO bookings (user_id, hotel_id, check_in, check_out, total_price) 
              VALUES ('$user_id', '$hotel_id', '$check_in', '$check_out', '$total_price')";
    
    if (mysqli_query($koneksi, $query)) {
        respond("success", "Booking Berhasil Dibuat");
    } else {
        respond("error", "Gagal Membuat Booking: " . mysqli_error($koneksi));
    }
} else {
    // Get User Bookings
    $user_id = $_GET['user_id'] ?? null;
    if ($user_id) {
        $sql = "SELECT b.*, h.name as hotel_name, h.image_url as hotel_image 
                FROM bookings b 
                JOIN hotels h ON b.hotel_id = h.id 
                WHERE b.user_id = '$user_id' 
                ORDER BY b.created_at DESC";
        $result = mysqli_query($koneksi, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        respond("success", "Riwayat Booking Ditemukan", $data);
    } else {
        respond("error", "User ID diperlukan");
    }
}
?>
