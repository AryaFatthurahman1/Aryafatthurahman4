<?php
require_once '../config.php';

// Hapus semua session
session_destroy();

// Redirect ke halaman login dengan pesan
header('Location: login.php?logout=1');
exit();
?>

