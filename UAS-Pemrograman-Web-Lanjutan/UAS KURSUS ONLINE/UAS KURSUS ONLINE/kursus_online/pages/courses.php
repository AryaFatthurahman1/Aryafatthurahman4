<?php
require_once '../config.php';
$page_title = 'Daftar Kursus - Kursus Online';

// Handle search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where_clause = '';
$params = [];

if(!empty($search)) {
    $where_clause = "WHERE c.title LIKE ? OR c.description LIKE ? OR u.username LIKE ?";
    $search_param = "%$search%";
    $params = [$search_param, $search_param, $search_param];
}

// Ambil semua kursus dengan informasi instructor
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

include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Daftar Kursus</h1>
            <p class="text-muted">Temukan kursus yang sesuai dengan minat dan kebutuhan Anda</p>
        </div>
    </div>
    
    <!-- Search Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" class="search-box">
                <div class="position-relative">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="form-control" id="searchInput" name="search" 
                           placeholder="Cari kursus, instruktur..." 
                           value="<?php echo htmlspecialchars($search); ?>">
                </div>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <span class="text-muted">Ditemukan <?php echo count($courses); ?> kursus</span>
        </div>
    </div>
    
    <!-- Courses Grid -->
    <div class="row">
        <?php if(empty($courses)): ?>
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-search fa-4x text-muted mb-3"></i>
                <h4>Tidak Ada Kursus Ditemukan</h4>
                <p class="text-muted">Coba gunakan kata kunci yang berbeda</p>
                <a href="courses.php" class="btn btn-primary">Lihat Semua Kursus</a>
            </div>
        </div>
        <?php else: ?>
        <?php foreach($courses as $course): ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card course-card h-100">
                <img src="https://via.placeholder.com/400x200/007bff/ffffff?text=<?php echo urlencode($course['title']); ?>" 
                     class="card-img-top" alt="<?php echo htmlspecialchars($course['title']); ?>">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                    <p class="card-text text-muted flex-grow-1">
                        <?php echo htmlspecialchars(substr($course['description'], 0, 120)) . '...'; ?>
                    </p>
                    
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
                        <a href="course_detail.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <!-- Call to Action -->
    <?php if(!isset($_SESSION['user_id'])): ?>
    <div class="row mt-5">
        <div class="col-12">
            <div class="text-center bg-primary text-white p-5 rounded">
                <h3>Siap Memulai Perjalanan Belajar?</h3>
                <p class="mb-4">Daftar sekarang dan dapatkan akses ke ribuan kursus berkualitas</p>
                <a href="register.php" class="btn btn-light btn-lg">Daftar Gratis</a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
// Real-time search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const courseCards = document.querySelectorAll('.course-card');
    
    courseCards.forEach(card => {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const description = card.querySelector('.card-text').textContent.toLowerCase();
        const instructor = card.querySelector('.fa-user').parentElement.textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm) || instructor.includes(searchTerm)) {
            card.parentElement.style.display = '';
        } else {
            card.parentElement.style.display = 'none';
        }
    });
});
</script>

<?php include '../includes/footer.php'; ?>

