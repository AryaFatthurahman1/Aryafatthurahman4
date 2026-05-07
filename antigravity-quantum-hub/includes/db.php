<?php
declare(strict_types=1);

function get_pdo(): ?PDO {
    static $pdo = false;
    if ($pdo !== false) return $pdo instanceof PDO ? $pdo : null;
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;charset=utf8mb4', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        // Create hub database + tables if not exists
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `antigravity_hub` DEFAULT CHARSET=utf8mb4");
        $pdo->exec("USE `antigravity_hub`");
        $pdo->exec("CREATE TABLE IF NOT EXISTS `users` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(150) NOT NULL,
            `email` VARCHAR(200) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `role` ENUM('user','admin') DEFAULT 'user',
            `avatar` VARCHAR(255) DEFAULT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        $pdo->exec("CREATE TABLE IF NOT EXISTS `orders` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `service` VARCHAR(200) NOT NULL,
            `package` VARCHAR(200) NOT NULL,
            `notes` TEXT,
            `price` DECIMAL(15,2) DEFAULT 0,
            `status` ENUM('pending','processing','done','cancelled') DEFAULT 'pending',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    } catch (Throwable $e) {
        $pdo = null;
    }
    return $pdo instanceof PDO ? $pdo : null;
}

function save_order(int $userId, string $service, string $package, string $notes, float $price): array {
    $pdo = get_pdo();
    if (!$pdo) return ['success' => false, 'message' => 'Database tidak tersedia.'];
    try {
        $pdo->prepare("INSERT INTO orders (user_id, service, package, notes, price) VALUES (?,?,?,?,?)")
            ->execute([$userId, $service, $package, $notes, $price]);
        return ['success' => true, 'message' => 'Pesanan berhasil dibuat!'];
    } catch (Throwable $e) {
        return ['success' => false, 'message' => 'Gagal menyimpan pesanan.'];
    }
}

function get_user_orders(int $userId): array {
    $pdo = get_pdo();
    if (!$pdo) return [];
    try {
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    } catch (Throwable) { return []; }
}

function get_all_stats(): array {
    $pdo = get_pdo();
    if (!$pdo) return ['users' => 0, 'orders' => 0];
    try {
        $users = (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $orders = (int)$pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
        return ['users' => $users, 'orders' => $orders];
    } catch (Throwable) { return ['users' => 0, 'orders' => 0]; }
}
