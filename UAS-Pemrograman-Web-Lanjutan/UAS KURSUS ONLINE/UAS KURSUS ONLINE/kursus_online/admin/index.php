<?php
require_once '../config.php';

// Cek apakah user adalah admin
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../pages/login.php');
    exit();
}

$page_title = 'Admin Dashboard - Kursus Online';

// Ambil statistik
$stmt = $pdo->query("SELECT COUNT(*) as total_users FROM users WHERE role = 'student'");
$total_users = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) as total_courses FROM courses");
$total_courses = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) as total_enrollments FROM enrollments");
$total_enrollments = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) as completed_courses FROM enrollments WHERE progress = 100");
$completed_courses = $stmt->fetchColumn();

// Ambil data terbaru
$stmt = $pdo->query("SELECT u.username, u.email, u.created_at FROM users u WHERE role = 'student' ORDER BY created_at DESC LIMIT 5");
$recent_users = $stmt->fetchAll();

$stmt = $pdo->query("SELECT c.title, u.username as instructor, c.created_at FROM courses c LEFT JOIN users u ON c.instructor_id = u.id ORDER BY c.created_at DESC LIMIT 5");
$recent_courses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="text-center py-4">
                    <h5 class="text-white">Admin Panel</h5>
                    <small class="text-muted">Kursus Online</small>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="index.php">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="users.php">
                        <i class="fas fa-users me-2"></i>Kelola Pengguna
                    </a>
                    <a class="nav-link" href="courses.php">
                        <i class="fas fa-book me-2"></i>Kelola Kursus
                    </a>
                    <a class="nav-link" href="enrollments.php">
                        <i class="fas fa-user-graduate me-2"></i>Pendaftaran
                    </a>
                    <a class="nav-link" href="../pages/dashboard.php">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Website
                    </a>
                    <a class="nav-link" href="../pages/logout.php">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 content-wrapper">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Dashboard Admin</h2>
                    <span class="text-muted">Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                </div>
                
                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="stats-card">
                            <i class="fas fa-users fa-2x text-primary mb-3"></i>
                            <h3><?php echo $total_users; ?></h3>
                            <p>Total Pengguna</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stats-card">
                            <i class="fas fa-book fa-2x text-success mb-3"></i>
                            <h3><?php echo $total_courses; ?></h3>
                            <p>Total Kursus</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stats-card">
                            <i class="fas fa-user-graduate fa-2x text-warning mb-3"></i>
                            <h3><?php echo $total_enrollments; ?></h3>
                            <p>Total Pendaftaran</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stats-card">
                            <i class="fas fa-trophy fa-2x text-info mb-3"></i>
                            <h3><?php echo $completed_courses; ?></h3>
                            <p>Kursus Selesai</p>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Data -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Pengguna Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($recent_users as $user): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <a href="users.php" class="btn btn-primary btn-sm">Lihat Semua</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Kursus Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Judul</th>
                                                <th>Instruktur</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($recent_courses as $course): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($course['title']); ?></td>
                                                <td><?php echo htmlspecialchars($course['instructor']); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($course['created_at'])); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <a href="courses.php" class="btn btn-primary btn-sm">Lihat Semua</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

