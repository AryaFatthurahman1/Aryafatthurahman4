<?php
declare(strict_types=1);

function is_logged_in(): bool {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function current_user(): ?array {
    if (!is_logged_in()) return null;
    return [
        'id'    => $_SESSION['user_id'],
        'name'  => $_SESSION['user_name'] ?? 'User',
        'email' => $_SESSION['user_email'] ?? '',
        'role'  => $_SESSION['user_role'] ?? 'user',
    ];
}

function auth_login(string $email, string $password): array {
    if (empty($email) || empty($password)) {
        return ['success' => false, 'message' => 'Email dan password wajib diisi.'];
    }
    $pdo = get_pdo();
    if (!$pdo) return ['success' => false, 'message' => 'Koneksi database gagal.'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([strtolower(trim($email))]);
        $user = $stmt->fetch();
        if (!$user || !password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Email atau password salah.'];
        }
        $_SESSION['user_id']    = $user['id'];
        $_SESSION['user_name']  = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role']  = $user['role'];
        session_regenerate_id(true);
        return ['success' => true, 'message' => 'Login berhasil!'];
    } catch (Throwable $e) {
        return ['success' => false, 'message' => 'Terjadi kesalahan server.'];
    }
}

function auth_register(string $name, string $email, string $password, string $confirm): array {
    if (empty($name) || empty($email) || empty($password)) {
        return ['success' => false, 'message' => 'Semua field wajib diisi.'];
    }
    if ($password !== $confirm) {
        return ['success' => false, 'message' => 'Password tidak cocok.'];
    }
    if (strlen($password) < 6) {
        return ['success' => false, 'message' => 'Password minimal 6 karakter.'];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Format email tidak valid.'];
    }
    $pdo = get_pdo();
    if (!$pdo) return ['success' => false, 'message' => 'Koneksi database gagal.'];
    try {
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([strtolower(trim($email))]);
        if ($check->fetch()) {
            return ['success' => false, 'message' => 'Email sudah terdaftar.'];
        }
        $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?,?,?)")
            ->execute([
                trim($name),
                strtolower(trim($email)),
                password_hash($password, PASSWORD_BCRYPT)
            ]);
        return ['success' => true, 'message' => 'Akun berhasil dibuat! Silakan login.'];
    } catch (Throwable $e) {
        return ['success' => false, 'message' => 'Gagal mendaftar. Coba lagi.'];
    }
}
