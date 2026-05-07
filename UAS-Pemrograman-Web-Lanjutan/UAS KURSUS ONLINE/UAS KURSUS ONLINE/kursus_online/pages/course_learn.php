<?php
require_once '../config.php';

// Cek login
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$lesson_id = isset($_GET['lesson']) ? (int)$_GET['lesson'] : 0;

// Cek enrollment
$stmt = $pdo->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
$stmt->execute([$_SESSION['user_id'], $course_id]);
$enrollment = $stmt->fetch();

if(!$enrollment) {
    header('Location: course_detail.php?id=' . $course_id);
    exit();
}

// Ambil detail kursus
$stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->execute([$course_id]);
$course = $stmt->fetch();

// Ambil semua modul dan lessons
$stmt = $pdo->prepare("SELECT m.*, l.id as lesson_id, l.title as lesson_title, l.content, l.video_url, l.order_index as lesson_order
                       FROM modules m 
                       LEFT JOIN lessons l ON m.id = l.module_id 
                       WHERE m.course_id = ? 
                       ORDER BY m.order_index, l.order_index");
$stmt->execute([$course_id]);
$course_content = $stmt->fetchAll();

// Organize content by modules
$modules = [];
foreach($course_content as $item) {
    if(!isset($modules[$item['id']])) {
        $modules[$item['id']] = [
            'id' => $item['id'],
            'title' => $item['title'],
            'description' => $item['description'],
            'lessons' => []
        ];
    }
    
    if($item['lesson_id']) {
        $modules[$item['id']]['lessons'][] = [
            'id' => $item['lesson_id'],
            'title' => $item['lesson_title'],
            'content' => $item['content'],
            'video_url' => $item['video_url']
        ];
    }
}

// Get current lesson
$current_lesson = null;
if($lesson_id > 0) {
    $stmt = $pdo->prepare("SELECT l.*, m.title as module_title FROM lessons l 
                           JOIN modules m ON l.module_id = m.id 
                           WHERE l.id = ?");
    $stmt->execute([$lesson_id]);
    $current_lesson = $stmt->fetch();
} else {
    // Get first lesson
    foreach($modules as $module) {
        if(!empty($module['lessons'])) {
            $current_lesson = $module['lessons'][0];
            $lesson_id = $current_lesson['id'];
            break;
        }
    }
}

$page_title = 'Belajar: ' . htmlspecialchars($course['title']);
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
    <style>
        .learning-sidebar {
            height: 100vh;
            overflow-y: auto;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }
        .learning-content {
            height: 100vh;
            overflow-y: auto;
        }
        .lesson-item {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .lesson-item:hover {
            background-color: #e9ecef;
        }
        .lesson-item.active {
            background-color: #007bff;
            color: white;
        }
        .video-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-md-3 learning-sidebar">
                <div class="p-3 border-bottom">
                    <h6 class="mb-1"><?php echo htmlspecialchars($course['title']); ?></h6>
                    <small class="text-muted">Progress: <?php echo number_format($enrollment['progress'], 1); ?>%</small>
                    <div class="progress progress-custom mt-2">
                        <div class="progress-bar" style="width: <?php echo $enrollment['progress']; ?>%"></div>
                    </div>
                </div>
                
                <div class="p-3">
                    <a href="course_detail.php?id=<?php echo $course_id; ?>" class="btn btn-outline-primary btn-sm mb-3">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Detail
                    </a>
                    
                    <?php foreach($modules as $module): ?>
                    <div class="mb-3">
                        <h6 class="fw-bold"><?php echo htmlspecialchars($module['title']); ?></h6>
                        <?php foreach($module['lessons'] as $lesson): ?>
                        <div class="lesson-item p-2 rounded mb-1 <?php echo $lesson['id'] == $lesson_id ? 'active' : ''; ?>" 
                             onclick="location.href='course_learn.php?id=<?php echo $course_id; ?>&lesson=<?php echo $lesson['id']; ?>'">
                            <i class="fas fa-play-circle me-2"></i>
                            <small><?php echo htmlspecialchars($lesson['title']); ?></small>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 learning-content">
                <?php if($current_lesson): ?>
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3><?php echo htmlspecialchars($current_lesson['title']); ?></h3>
                            <small class="text-muted"><?php echo htmlspecialchars($current_lesson['module_title'] ?? ''); ?></small>
                        </div>
                        <button class="btn btn-success" onclick="markAsComplete()">
                            <i class="fas fa-check me-1"></i>Tandai Selesai
                        </button>
                    </div>
                    
                    <?php if($current_lesson['video_url']): ?>
                    <div class="video-container mb-4">
                        <iframe src="<?php echo htmlspecialchars($current_lesson['video_url']); ?>" 
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <?php endif; ?>
                    
                    <div class="content">
                        <?php echo nl2br(htmlspecialchars($current_lesson['content'])); ?>
                    </div>
                    
                    <!-- Navigation -->
                    <div class="d-flex justify-content-between mt-5">
                        <button class="btn btn-outline-secondary" onclick="previousLesson()">
                            <i class="fas fa-chevron-left me-1"></i>Sebelumnya
                        </button>
                        <button class="btn btn-primary" onclick="nextLesson()">
                            Selanjutnya<i class="fas fa-chevron-right ms-1"></i>
                        </button>
                    </div>
                </div>
                <?php else: ?>
                <div class="p-4 text-center">
                    <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
                    <h4>Belum Ada Materi</h4>
                    <p class="text-muted">Materi pembelajaran belum tersedia untuk kursus ini.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function markAsComplete() {
            // Implementasi untuk menandai lesson sebagai selesai
            alert('Lesson ditandai sebagai selesai!');
            // Di sini bisa ditambahkan AJAX call untuk update progress
        }
        
        function previousLesson() {
            // Implementasi navigasi ke lesson sebelumnya
            const lessons = document.querySelectorAll('.lesson-item');
            const currentIndex = Array.from(lessons).findIndex(item => item.classList.contains('active'));
            if(currentIndex > 0) {
                lessons[currentIndex - 1].click();
            }
        }
        
        function nextLesson() {
            // Implementasi navigasi ke lesson selanjutnya
            const lessons = document.querySelectorAll('.lesson-item');
            const currentIndex = Array.from(lessons).findIndex(item => item.classList.contains('active'));
            if(currentIndex < lessons.length - 1) {
                lessons[currentIndex + 1].click();
            }
        }
    </script>
</body>
</html>

