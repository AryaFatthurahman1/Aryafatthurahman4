<?php
declare(strict_types=1);
session_start();

// ─── Simple Router ────────────────────────────────────────────────────────────
$page = $_GET['page'] ?? 'home';
$allowedPages = ['home', 'login', 'register', 'dashboard', 'services', 'order', 'projects', 'quantum', 'logout'];
if (!in_array($page, $allowedPages, true)) {
    $page = 'home';
}

// ─── Auth Helpers ─────────────────────────────────────────────────────────────
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';

// Handle logout
if ($page === 'logout') {
    session_destroy();
    header('Location: ?page=home');
    exit;
}

// Handle login form
if ($page === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = auth_login($_POST['email'] ?? '', $_POST['password'] ?? '');
    if ($result['success']) {
        header('Location: ?page=dashboard');
        exit;
    }
    $loginError = $result['message'];
}

// Handle register form
if ($page === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = auth_register(
        $_POST['name'] ?? '',
        $_POST['email'] ?? '',
        $_POST['password'] ?? '',
        $_POST['password_confirm'] ?? ''
    );
    if ($result['success']) {
        $registerSuccess = $result['message'];
    } else {
        $registerError = $result['message'];
    }
}

// Handle order form
if ($page === 'order' && $_SERVER['REQUEST_METHOD'] === 'POST' && is_logged_in()) {
    $result = save_order(
        $_SESSION['user_id'],
        $_POST['service'] ?? '',
        $_POST['package'] ?? '',
        $_POST['notes'] ?? '',
        (float)($_POST['price'] ?? 0)
    );
    $orderResult = $result;
}

// Protect dashboard
if ($page === 'dashboard' && !is_logged_in()) {
    header('Location: ?page=login');
    exit;
}

$pageTitle = match($page) {
    'home'      => 'AntiGravity Quantum Hub — Unified Dev Ecosystem',
    'login'     => 'Masuk — AntiGravity',
    'register'  => 'Daftar — AntiGravity',
    'dashboard' => 'Dashboard — AntiGravity',
    'services'  => 'Layanan — AntiGravity',
    'order'     => 'Pemesanan — AntiGravity',
    'projects'  => 'Semua Proyek — AntiGravity',
    'quantum'   => 'Hybrid Quantum Systems — AntiGravity',
    default     => 'AntiGravity Quantum Hub',
};

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/pages/' . $page . '.php';
require_once __DIR__ . '/includes/footer.php';
