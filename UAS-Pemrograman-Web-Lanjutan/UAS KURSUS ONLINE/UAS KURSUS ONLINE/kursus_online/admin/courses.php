<?php
require_once '../config.php';

// Cek apakah user adalah admin
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../pages/login.php');
    exit();
}

$success = '';
$error = '';

// Handle delete course
if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $course_id = (int)$_GET['delete'];
    
    $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
    if($stmt->execute([$course_id])) {
        $success = 'Kursus berhasil dihapus!';
    } else {
        $error = 'Gagal menghapus kursus!';
    }
}

// Handle search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where_clause = '';
$params = [];

if(!empty($search)) {
    $where_clause = "WHERE c.title LIKE ? OR c.description LIKE ? OR u.username LIKE ?";
    $search_param = "%$search%";
    $params = [$search_param, $search_param, $search_param];
}

// Ambil data courses dengan informasi instructor dan jumlah enrollment
$sql = "SELECT c.*, u.username as instructor_name, 
        COUNT(e.id) as total_enrollments 
        FROM courses c 
        LEFT JOIN users u ON c.instructor_id = u.id 
        LEFT JOIN enrollments e ON c.id = e.course_id 
        $where_clause
        GROUP BY c.id 
        ORDER BY c.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$courses = $stmt->fetchAll();

$page_title = 'Kelola Kursus - Admin';
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
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="users.php">
                        <i class="fas fa-users me-2"></i>Kelola Pengguna
                    </a>
                    <a class="nav-link active" href="courses.php">
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
                    <h2>Kelola Kursus</h2>
                    <a href="course_add.php" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Tambah Kursus
                    </a>
                </div>
                
                <?php if($success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <?php if($error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <!-- Search -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <form method="GET" class="search-box">
                            <div class="position-relative">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" class="form-control" id="searchInput" name="search" 
                                       placeholder="Cari judul kursus atau instruktur..." 
                                       value="<?php echo htmlspecialchars($search); ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-end">
                        <span class="text-muted">Total: <?php echo count($courses); ?> kursus</span>
                    </div>
                </div>
                
                <!-- Courses Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul</th>
                                        <th>Instruktur</th>
                                        <th>Harga</th>
                                        <th>Siswa</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(empty($courses)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Tidak ada data kursus</td>
                                    </tr>
                                    <?php else: ?>
                                    <?php foreach($courses as $course): ?>
                                    <tr class="course-row">
                                        <td><?php echo $course['id']; ?></td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($course['title']); ?></strong>
                                            <br>
                                            <small class="text-muted">
                                                <?php echo htmlspecialchars(substr($course['description'], 0, 50)) . '...'; ?>
                                            </small>
                                        </td>
                                        <td><?php echo htmlspecialchars($course['instructor_name'] ?: 'Tidak ada'); ?></td>
                                        <td>
                                            <?php if($course['price'] > 0): ?>
                                            <span class="text-success fw-bold">
                                                Rp <?php echo number_format($course['price'], 0, ',', '.'); ?>
                                            </span>
                                            <?php else: ?>
                                            <span class="badge bg-success">Gratis</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                <?php echo $course['total_enrollments']; ?> siswa
                                            </span>
                                        </td>
                                        <td><?php echo date('d M Y', strtotime($course['created_at'])); ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="../pages/course_detail.php?id=<?php echo $course['id']; ?>" 
                                                   class="btn btn-outline-info" title="Lihat" target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="course_edit.php?id=<?php echo $course['id']; ?>" 
                                                   class="btn btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="courses.php?delete=<?php echo $course['id']; ?>" 
                                                   class="btn btn-outline-danger" title="Hapus"
                                                   onclick="return confirmDelete('Apakah Anda yakin ingin menghapus kursus ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/script.js"></script>
    
    <script>
    // Real-time search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const courseRows = document.querySelectorAll('.course-row');
        
        courseRows.forEach(row => {
            const title = row.cells[1].textContent.toLowerCase();
            const instructor = row.cells[2].textContent.toLowerCase();
            
            if (title.includes(searchTerm) || instructor.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>

