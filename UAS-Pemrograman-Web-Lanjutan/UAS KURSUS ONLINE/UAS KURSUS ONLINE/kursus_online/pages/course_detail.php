<?php
require_once '../config.php';

// Ambil ID kursus dari URL
$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($course_id == 0) {
    header('Location: courses.php');
    exit();
}

// Ambil detail kursus
$stmt = $pdo->prepare("SELECT c.*, u.username as instructor_name, u.email as instructor_email 
                       FROM courses c 
                       LEFT JOIN users u ON c.instructor_id = u.id 
                       WHERE c.id = ?");
$stmt->execute([$course_id]);
$course = $stmt->fetch();

if(!$course) {
    header('Location: courses.php');
    exit();
}

// Cek apakah user sudah enroll
$is_enrolled = false;
$enrollment = null;
if(isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
    $stmt->execute([$_SESSION['user_id'], $course_id]);
    $enrollment = $stmt->fetch();
    $is_enrolled = $enrollment ? true : false;
}

// Ambil modul kursus
$stmt = $pdo->prepare("SELECT * FROM modules WHERE course_id = ? ORDER BY order_index");
$stmt->execute([$course_id]);
$modules = $stmt->fetchAll();

// Ambil total siswa yang enroll
$stmt = $pdo->prepare("SELECT COUNT(*) as total_students FROM enrollments WHERE course_id = ?");
$stmt->execute([$course_id]);
$total_students = $stmt->fetchColumn();

// Handle enrollment
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enroll'])) {
    if(!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
    
    if(!$is_enrolled) {
        $stmt = $pdo->prepare("INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)");
        if($stmt->execute([$_SESSION['user_id'], $course_id])) {
            header('Location: course_detail.php?id=' . $course_id . '&enrolled=1');
            exit();
        }
    }
}

$page_title = htmlspecialchars($course['title']) . ' - Kursus Online';
include '../includes/header.php';
?>

<div class="container my-5">
    <!-- Course Header -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="courses.php">Kursus</a></li>
                    <li class="breadcrumb-item active"><?php echo htmlspecialchars($course['title']); ?></li>
                </ol>
            </nav>
            
            <h1 class="display-5 fw-bold mb-3"><?php echo htmlspecialchars($course['title']); ?></h1>
            <p class="lead text-muted mb-4"><?php echo htmlspecialchars($course['description']); ?></p>
            
            <div class="d-flex align-items-center mb-4">
                <img src="https://via.placeholder.com/50x50/6c757d/ffffff?text=<?php echo strtoupper(substr($course['instructor_name'], 0, 1)); ?>" 
                     class="rounded-circle me-3" alt="Instructor">
                <div>
                    <h6 class="mb-0"><?php echo htmlspecialchars($course['instructor_name']); ?></h6>
                    <small class="text-muted">Instruktur</small>
                </div>
            </div>
            
            <?php if(isset($_GET['enrolled'])): ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle me-2"></i>Selamat! Anda berhasil mendaftar ke kursus ini.
            </div>
            <?php endif; ?>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <img src="https://via.placeholder.com/400x250/007bff/ffffff?text=<?php echo urlencode($course['title']); ?>" 
                     class="card-img-top" alt="<?php echo htmlspecialchars($course['title']); ?>">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-primary mb-0">
                            <?php echo $course['price'] > 0 ? 'Rp ' . number_format($course['price'], 0, ',', '.') : 'Gratis'; ?>
                        </h3>
                        <div class="text-end">
                            <small class="text-muted d-block">
                                <i class="fas fa-users me-1"></i><?php echo $total_students; ?> siswa
                            </small>
                        </div>
                    </div>
                    
                    <?php if($is_enrolled): ?>
                    <div class="d-grid mb-3">
                        <a href="course_learn.php?id=<?php echo $course_id; ?>" class="btn btn-success btn-lg">
                            <i class="fas fa-play me-2"></i>Lanjutkan Belajar
                        </a>
                    </div>
                    <div class="text-center">
                        <small class="text-muted">
                            Progress: <?php echo number_format($enrollment['progress'], 1); ?>%
                        </small>
                        <div class="progress progress-custom mt-2">
                            <div class="progress-bar" style="width: <?php echo $enrollment['progress']; ?>%"></div>
                        </div>
                    </div>
                    <?php else: ?>
                    <form method="POST">
                        <div class="d-grid mb-3">
                            <?php if(isset($_SESSION['user_id'])): ?>
                            <button type="submit" name="enroll" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Daftar Kursus
                            </button>
                            <?php else: ?>
                            <a href="login.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login untuk Mendaftar
                            </a>
                            <?php endif; ?>
                        </div>
                    </form>
                    <?php endif; ?>
                    
                    <hr>
                    <div class="course-info">
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-clock me-2"></i>Durasi</span>
                            <span>Fleksibel</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-signal me-2"></i>Level</span>
                            <span>Pemula</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-language me-2"></i>Bahasa</span>
                            <span>Indonesia</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-certificate me-2"></i>Sertifikat</span>
                            <span>Ya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Course Content -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Materi Kursus</h5>
                </div>
                <div class="card-body">
                    <?php if(empty($modules)): ?>
                    <p class="text-muted">Materi kursus belum tersedia.</p>
                    <?php else: ?>
                    <div class="accordion" id="moduleAccordion">
                        <?php foreach($modules as $index => $module): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?php echo $module['id']; ?>">
                                <button class="accordion-button <?php echo $index > 0 ? 'collapsed' : ''; ?>" 
                                        type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse<?php echo $module['id']; ?>">
                                    <i class="fas fa-book me-2"></i>
                                    <?php echo htmlspecialchars($module['title']); ?>
                                </button>
                            </h2>
                            <div id="collapse<?php echo $module['id']; ?>" 
                                 class="accordion-collapse collapse <?php echo $index == 0 ? 'show' : ''; ?>" 
                                 data-bs-parent="#moduleAccordion">
                                <div class="accordion-body">
                                    <p><?php echo htmlspecialchars($module['description']); ?></p>
                                    
                                    <?php
                                    // Ambil lessons untuk modul ini
                                    $stmt = $pdo->prepare("SELECT * FROM lessons WHERE module_id = ? ORDER BY order_index");
                                    $stmt->execute([$module['id']]);
                                    $lessons = $stmt->fetchAll();
                                    ?>
                                    
                                    <?php if(!empty($lessons)): ?>
                                    <ul class="list-unstyled">
                                        <?php foreach($lessons as $lesson): ?>
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="fas fa-play-circle text-primary me-2"></i>
                                            <span><?php echo htmlspecialchars($lesson['title']); ?></span>
                                            <?php if($lesson['video_url']): ?>
                                            <i class="fas fa-video text-muted ms-2" title="Video"></i>
                                            <?php endif; ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Tentang Instruktur</h5>
                </div>
                <div class="card-body text-center">
                    <img src="https://via.placeholder.com/100x100/6c757d/ffffff?text=<?php echo strtoupper(substr($course['instructor_name'], 0, 1)); ?>" 
                         class="rounded-circle mb-3" alt="Instructor">
                    <h6><?php echo htmlspecialchars($course['instructor_name']); ?></h6>
                    <p class="text-muted">Instruktur Berpengalaman</p>
                    <p class="small">Instruktur dengan pengalaman bertahun-tahun di bidangnya.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

