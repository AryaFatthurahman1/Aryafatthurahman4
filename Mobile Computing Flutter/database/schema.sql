-- EduConnect Database Schema
-- Database untuk aplikasi UAS Mobile Computing
-- Create Database
CREATE DATABASE IF NOT EXISTS educonnect_db;
USE educonnect_db;
-- Table 1: Users (untuk authentication dan profile)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    profile_image VARCHAR(255),
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- Table 2: Articles (untuk konten artikel pendidikan)
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255),
    author_id INT NOT NULL,
    category VARCHAR(50),
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
);
-- Table 3: Discussions (untuk forum diskusi)
CREATE TABLE IF NOT EXISTS discussions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
-- Sample Data untuk Testing
-- Insert sample users
INSERT INTO users (name, email, password, phone, profile_image, bio)
VALUES (
        'Admin User',
        'admin@educonnect.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        '081234567890',
        'https://ui-avatars.com/api/?name=Admin+User&background=4F46E5&color=fff',
        'Administrator EduConnect'
    ),
    (
        'Budi Santoso',
        'budi@student.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        '081234567891',
        'https://ui-avatars.com/api/?name=Budi+Santoso&background=10B981&color=fff',
        'Mahasiswa Teknik Informatika'
    ),
    (
        'Siti Nurhaliza',
        'siti@student.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        '081234567892',
        'https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=F59E0B&color=fff',
        'Mahasiswa Sistem Informasi'
    );
-- Insert sample articles
INSERT INTO articles (
        title,
        content,
        image_url,
        author_id,
        category,
        views
    )
VALUES (
        'Pengenalan Flutter untuk Pemula',
        'Flutter adalah framework open-source yang dikembangkan oleh Google untuk membuat aplikasi mobile cross-platform. Dengan Flutter, developer dapat membuat aplikasi untuk iOS dan Android menggunakan satu codebase.\n\nKeunggulan Flutter:\n1. Hot Reload - mempercepat development\n2. Widget-based - UI yang fleksibel\n3. Performance tinggi - compiled ke native code\n4. Komunitas besar - banyak package tersedia',
        'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800',
        1,
        'Mobile Development',
        150
    ),
    (
        'Dart Programming Language',
        'Dart adalah bahasa pemrograman yang digunakan oleh Flutter. Dart adalah bahasa yang mudah dipelajari, terutama jika Anda sudah familiar dengan Java atau JavaScript.\n\nFitur Dart:\n- Strongly typed\n- Object-oriented\n- Null safety\n- Async/await support\n- Rich standard library',
        'https://images.unsplash.com/photo-1516116216624-53e697fedbea?w=800',
        1,
        'Programming',
        230
    ),
    (
        'State Management di Flutter',
        'State management adalah salah satu konsep penting dalam Flutter. Ada berbagai pendekatan untuk mengelola state:\n\n1. setState - untuk state sederhana\n2. Provider - recommended oleh Flutter team\n3. Bloc - untuk aplikasi kompleks\n4. Riverpod - evolusi dari Provider\n5. GetX - all-in-one solution',
        'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800',
        1,
        'Mobile Development',
        189
    ),
    (
        'RESTful API dengan PHP',
        'Membuat RESTful API menggunakan PHP murni untuk backend aplikasi mobile. API yang baik harus memiliki:\n\n- Endpoint yang jelas dan konsisten\n- Proper HTTP methods (GET, POST, PUT, DELETE)\n- JSON response format\n- Error handling yang baik\n- Authentication & Authorization',
        'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800',
        2,
        'Backend',
        167
    ),
    (
        'Database Design Best Practices',
        'Merancang database yang efisien adalah kunci aplikasi yang scalable:\n\n1. Normalisasi data\n2. Indexing yang tepat\n3. Foreign key relationships\n4. Naming conventions yang konsisten\n5. Dokumentasi schema',
        'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=800',
        2,
        'Database',
        145
    );
-- Insert sample discussions
INSERT INTO discussions (user_id, title, message)
VALUES (
        2,
        'Cara install Flutter di Windows?',
        'Halo teman-teman, saya baru mau belajar Flutter. Ada yang bisa bantu cara install Flutter di Windows? Terima kasih!'
    ),
    (
        3,
        'Rekomendasi IDE untuk Flutter',
        'Mau tanya dong, lebih baik pakai Android Studio atau VS Code untuk development Flutter? Apa kelebihan masing-masing?'
    ),
    (
        2,
        'Error: Gradle build failed',
        'Saya dapat error saat build aplikasi Flutter: "Gradle build failed". Sudah coba clean tapi masih error. Ada solusi?'
    ),
    (
        3,
        'Tips belajar Dart untuk pemula',
        'Bagi yang sudah mahir Dart, ada tips belajar Dart untuk pemula? Resource apa yang recommended?'
    ),
    (
        1,
        'Pengumuman: Workshop Flutter',
        'Halo semua! Akan ada workshop Flutter gratis minggu depan. Yang berminat bisa daftar di link yang akan saya share nanti.'
    );
-- Create indexes for better performance
CREATE INDEX idx_articles_author ON articles(author_id);
CREATE INDEX idx_articles_category ON articles(category);
CREATE INDEX idx_discussions_user ON discussions(user_id);
CREATE INDEX idx_users_email ON users(email);
-- Note: Default password untuk semua user adalah "password"
-- Gunakan untuk testing: email: admin@educonnect.com, password: password