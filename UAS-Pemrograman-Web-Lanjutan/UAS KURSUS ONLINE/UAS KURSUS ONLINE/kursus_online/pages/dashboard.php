<?php
require_once '../config.php';

// Cek apakah user sudah login
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$page_title = 'Dashboard - Kursus Online';

// Ambil data kursus yang diikuti user
$stmt = $pdo->prepare("SELECT c.*, e.enrollment_date, e.progress 
                       FROM courses c 
                       JOIN enrollments e ON c.id = e.course_id 
                       WHERE e.user_id = ? 
                       ORDER BY e.enrollment_date DESC");
$stmt->execute([$_SESSION['user_id']]);
$enrolled_courses = $stmt->fetchAll();

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

include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Dashboard</h1>
            <p class="text-muted">Selamat datang kembali, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="row mb-5">
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <i class="fas fa-book fa-2x text-primary mb-3"></i>
                <h3><?php echo $total_courses; ?></h3>
                <p>Kursus Diikuti</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <i class="fas fa-chart-line fa-2x text-success mb-3"></i>
                <h3><?php echo number_format($avg_progress, 1); ?>%</h3>
                <p>Progress Rata-rata</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <i class="fas fa-trophy fa-2x text-warning mb-3"></i>
                <h3><?php echo $completed_courses; ?></h3>
                <p>Kursus Selesai</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <i class="fas fa-certificate fa-2x text-info mb-3"></i>
                <h3><?php echo $completed_courses; ?></h3>
                <p>Sertifikat</p>
            </div>
        </div>
    </div>
    
    <!-- My Courses Section -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Kursus Saya</h2>
                <a href="courses.php" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Cari Kursus Baru
                </a>
            </div>
            
            <?php if(empty($enrolled_courses)): ?>
            <div class="text-center py-5">
                <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
                <h4>Belum Ada Kursus</h4>
                <p class="text-muted">Anda belum mengikuti kursus apapun. Mulai belajar sekarang!</p>
                <a href="courses.php" class="btn btn-primary">Jelajahi Kursus</a>
            </div>
            <?php else: ?>
            <div class="row">
                <?php foreach($enrolled_courses as $course): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card course-card h-100">
                        <img src="https://via.placeholder.com/400x200/007bff/ffffff?text=<?php echo urlencode($course['title']); ?>" 
                             class="card-img-top" alt="<?php echo htmlspecialchars($course['title']); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                            <p class="card-text text-muted flex-grow-1">
                                <?php echo htmlspecialchars(substr($course['description'], 0, 100)) . '...'; ?>
                            </p>
                            
                            <!-- Progress Bar -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <small class="text-muted">Progress</small>
                                    <small class="text-muted"><?php echo number_format($course['progress'], 1); ?>%</small>
                                </div>
                                <div class="progress progress-custom">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: <?php echo $course['progress']; ?>%" 
                                         aria-valuenow="<?php echo $course['progress']; ?>" 
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    Bergabung: <?php echo date('d M Y', strtotime($course['enrollment_date'])); ?>
                                </small>
                                <a href="course_detail.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">
                                    <?php echo $course['progress'] == 100 ? 'Review' : 'Lanjutkan'; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

