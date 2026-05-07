<?php
require_once 'config.php';
$page_title = 'Beranda - Kursus Online';
include 'includes/header.php';

// Ambil data kursus terpopuler
$stmt = $pdo->query("SELECT c.*, u.username as instructor_name, 
                     COUNT(e.id) as total_enrollments 
                     FROM courses c 
                     LEFT JOIN users u ON c.instructor_id = u.id 
                     LEFT JOIN enrollments e ON c.id = e.course_id 
                     GROUP BY c.id 
                     ORDER BY total_enrollments DESC 
                     LIMIT 6");
$popular_courses = $stmt->fetchAll();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Belajar Skill Baru dengan Kursus Online</h1>
                <p class="lead mb-4">Platform pembelajaran online terbaik untuk mengembangkan kemampuan Anda. Ribuan kursus berkualitas dari instruktur terpercaya.</p>
                <div class="d-flex gap-3">
                    <a href="pages/courses.php" class="btn btn-light btn-lg">Jelajahi Kursus</a>
                    <?php if(!isset($_SESSION['user_id'])): ?>
                    <a href="pages/register.php" class="btn btn-outline-light btn-lg">Daftar Gratis</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/600x400/667eea/ffffff?text=Online+Learning" class="img-fluid rounded" alt="Online Learning">
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="stats-card">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h3>1000+</h3>
                    <p>Siswa Aktif</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stats-card">
                    <i class="fas fa-book fa-3x text-success mb-3"></i>
                    <h3>50+</h3>
                    <p>Kursus Tersedia</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stats-card">
                    <i class="fas fa-chalkboard-teacher fa-3x text-warning mb-3"></i>
                    <h3>25+</h3>
                    <p>Instruktur Ahli</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stats-card">
                    <i class="fas fa-certificate fa-3x text-info mb-3"></i>
                    <h3>500+</h3>
                    <p>Sertifikat Diterbitkan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Courses Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Kursus Terpopuler</h2>
            <p class="text-muted">Kursus yang paling banyak diminati oleh siswa</p>
        </div>
        <div class="row">
            <?php foreach($popular_courses as $course): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card course-card h-100">
                    <img src="https://via.placeholder.com/400x200/007bff/ffffff?text=<?php echo urlencode($course['title']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($course['title']); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                        <p class="card-text text-muted flex-grow-1"><?php echo htmlspecialchars(substr($course['description'], 0, 100)) . '...'; ?></p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <small class="text-muted">
                                <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($course['instructor_name']); ?>
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-users me-1"></i><?php echo $course['total_enrollments']; ?> siswa
                            </small>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 text-primary mb-0">
                                <?php echo $course['price'] > 0 ? 'Rp ' . number_format($course['price'], 0, ',', '.') : 'Gratis'; ?>
                            </span>
                            <a href="pages/course_detail.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="pages/courses.php" class="btn btn-outline-primary btn-lg">Lihat Semua Kursus</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Mengapa Memilih Kami?</h2>
            <p class="text-muted">Keunggulan platform pembelajaran kami</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                    <h4>Belajar Kapan Saja</h4>
                    <p class="text-muted">Akses kursus 24/7 sesuai dengan jadwal Anda</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <i class="fas fa-mobile-alt fa-3x text-primary mb-3"></i>
                    <h4>Akses Multi-Device</h4>
                    <p class="text-muted">Belajar di smartphone, tablet, atau komputer</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <i class="fas fa-award fa-3x text-primary mb-3"></i>
                    <h4>Sertifikat Resmi</h4>
                    <p class="text-muted">Dapatkan sertifikat setelah menyelesaikan kursus</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

