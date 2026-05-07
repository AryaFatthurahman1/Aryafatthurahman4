<?php
require_once '../config.php';

// Cek login
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$success = '';
$error = '';

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validasi input
    if(empty($username) || empty($email)) {
        $error = 'Username dan email harus diisi!';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } else {
        // Cek apakah username atau email sudah digunakan user lain
        $stmt = $pdo->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
        $stmt->execute([$username, $email, $_SESSION['user_id']]);
        
        if($stmt->fetch()) {
            $error = 'Username atau email sudah digunakan!';
        } else {
            // Update data dasar
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            if($stmt->execute([$username, $email, $_SESSION['user_id']])) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $success = 'Profil berhasil diperbarui!';
                
                // Update password jika diisi
                if(!empty($new_password)) {
                    if(empty($current_password)) {
                        $error = 'Password saat ini harus diisi untuk mengubah password!';
                    } elseif($new_password !== $confirm_password) {
                        $error = 'Konfirmasi password baru tidak cocok!';
                    } elseif(strlen($new_password) < 6) {
                        $error = 'Password baru minimal 6 karakter!';
                    } else {
                        // Verifikasi password saat ini
                        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
                        $stmt->execute([$_SESSION['user_id']]);
                        $user = $stmt->fetch();
                        
                        if(password_verify($current_password, $user['password'])) {
                            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
                            if($stmt->execute([$hashed_password, $_SESSION['user_id']])) {
                                $success = 'Profil dan password berhasil diperbarui!';
                            } else {
                                $error = 'Gagal memperbarui password!';
                            }
                        } else {
                            $error = 'Password saat ini salah!';
                        }
                    }
                }
            } else {
                $error = 'Gagal memperbarui profil!';
            }
        }
    }
}

// Ambil data user
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$page_title = 'Profil - Kursus Online';
include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-user me-2"></i>Profil Saya
                    </h4>
                </div>
                <div class="card-body">
                    <?php if($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($success): ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" 
                                       value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                <div class="invalid-feedback">
                                    Username harus diisi.
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                <div class="invalid-feedback">
                                    Email harus diisi dengan format yang benar.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" value="<?php echo ucfirst($user['role']); ?>" readonly>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="created_at" class="form-label">Bergabung Sejak</label>
                                <input type="text" class="form-control" 
                                       value="<?php echo date('d M Y', strtotime($user['created_at'])); ?>" readonly>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h5 class="mb-3">Ubah Password</h5>
                        <p class="text-muted small">Kosongkan jika tidak ingin mengubah password</p>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="current_password" class="form-label">Password Saat Ini</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" minlength="6">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="6">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="dashboard.php" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Statistics Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Statistik Belajar</h5>
                </div>
                <div class="card-body">
                    <?php
                    // Ambil statistik user
                    $stmt = $pdo->prepare("SELECT COUNT(*) as total_courses FROM enrollments WHERE user_id = ?");
                    $stmt->execute([$_SESSION['user_id']]);
                    $total_courses = $stmt->fetchColumn();
                    
                    $stmt = $pdo->prepare("SELECT AVG(progress) as avg_progress FROM enrollments WHERE user_id = ?");
                    $stmt->execute([$_SESSION['user_id']]);
                    $avg_progress = $stmt->fetchColumn() ?: 0;
                    
                    $stmt = $pdo->prepare("SELECT COUNT(*) as completed_courses FROM enrollments WHERE user_id = ? AND progress = 100");
                    $stmt->execute([$_SESSION['user_id']]);
                    $completed_courses = $stmt->fetchColumn();
                    ?>
                    
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h3 class="text-primary"><?php echo $total_courses; ?></h3>
                            <p class="text-muted">Kursus Diikuti</p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-success"><?php echo number_format($avg_progress, 1); ?>%</h3>
                            <p class="text-muted">Progress Rata-rata</p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-warning"><?php echo $completed_courses; ?></h3>
                            <p class="text-muted">Kursus Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

