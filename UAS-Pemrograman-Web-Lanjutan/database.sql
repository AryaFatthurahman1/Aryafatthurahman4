-- Database: kursus_online
-- Membuat database dan tabel untuk sistem kursus online

CREATE DATABASE IF NOT EXISTS kursus_online;
USE kursus_online;

-- Tabel users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role ENUM('student', 'admin') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel courses
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    instructor_id INT,
    price DECIMAL(10, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (instructor_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Tabel modules
CREATE TABLE modules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    order_index INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Tabel lessons
CREATE TABLE lessons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    module_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT,
    video_url VARCHAR(255),
    order_index INT NOT NULL,
    FOREIGN KEY (module_id) REFERENCES modules(id) ON DELETE CASCADE
);

-- Tabel enrollments
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    progress DECIMAL(5, 2) DEFAULT 0.00,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY unique_enrollment (user_id, course_id)
);

-- Insert data sample
-- Admin user (password: admin123)
INSERT INTO users (username, password, email, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@kursusonline.com', 'admin');

-- Instructor users (password: instructor123)
INSERT INTO users (username, password, email, role) VALUES 
('john_doe', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'john@kursusonline.com', 'student'),
('jane_smith', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jane@kursusonline.com', 'student'),
('mike_wilson', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mike@kursusonline.com', 'student');

-- Student users (password: student123)
INSERT INTO users (username, password, email, role) VALUES 
('student1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student1@example.com', 'student'),
('student2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student2@example.com', 'student'),
('student3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student3@example.com', 'student');

-- Sample courses
INSERT INTO courses (title, description, instructor_id, price) VALUES 
('Pemrograman Web dengan PHP', 'Belajar membuat website dinamis menggunakan PHP dan MySQL dari dasar hingga mahir.', 2, 299000),
('JavaScript untuk Pemula', 'Kursus lengkap JavaScript dari dasar hingga advanced untuk pengembangan web modern.', 3, 199000),
('Database Design dengan MySQL', 'Pelajari cara merancang dan mengelola database MySQL yang efisien dan optimal.', 4, 249000),
('HTML & CSS Responsive', 'Membuat website responsive yang menarik dengan HTML5 dan CSS3.', 2, 0),
('React.js Development', 'Bangun aplikasi web modern menggunakan React.js dan ecosystem-nya.', 3, 399000),
('Python untuk Data Science', 'Analisis data dan machine learning menggunakan Python, Pandas, dan Scikit-learn.', 4, 349000);

-- Sample modules untuk course 1 (Pemrograman Web dengan PHP)
INSERT INTO modules (course_id, title, description, order_index) VALUES 
(1, 'Pengenalan PHP', 'Dasar-dasar pemrograman PHP dan setup environment', 1),
(1, 'PHP Fundamental', 'Variabel, tipe data, operator, dan control structure', 2),
(1, 'PHP & MySQL', 'Koneksi database dan operasi CRUD', 3),
(1, 'Project Akhir', 'Membuat aplikasi web lengkap dengan PHP', 4);

-- Sample modules untuk course 2 (JavaScript untuk Pemula)
INSERT INTO modules (course_id, title, description, order_index) VALUES 
(2, 'JavaScript Basics', 'Sintaks dasar dan konsep fundamental JavaScript', 1),
(2, 'DOM Manipulation', 'Mengubah dan berinteraksi dengan elemen HTML', 2),
(2, 'Asynchronous JavaScript', 'Promise, async/await, dan AJAX', 3);

-- Sample lessons untuk module 1 (Pengenalan PHP)
INSERT INTO lessons (module_id, title, content, video_url, order_index) VALUES 
(1, 'Apa itu PHP?', 'PHP (PHP: Hypertext Preprocessor) adalah bahasa pemrograman server-side yang sangat populer untuk pengembangan web. PHP dapat digunakan untuk membuat website dinamis dan interaktif.', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 1),
(1, 'Instalasi XAMPP', 'XAMPP adalah paket software yang berisi Apache, MySQL, PHP, dan Perl. Dengan XAMPP, kita dapat menjalankan server lokal untuk development.', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 2),
(1, 'Hello World PHP', 'Mari kita buat program PHP pertama dengan menampilkan "Hello World" di browser.', NULL, 3);

-- Sample lessons untuk module 2 (PHP Fundamental)
INSERT INTO lessons (module_id, title, content, video_url, order_index) VALUES 
(2, 'Variabel dan Tipe Data', 'Pelajari cara mendeklarasikan variabel dan berbagai tipe data dalam PHP seperti string, integer, float, boolean, dan array.', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 1),
(2, 'Operator dalam PHP', 'Operator aritmatika, perbandingan, logika, dan assignment dalam PHP.', NULL, 2),
(2, 'Control Structure', 'If-else, switch, for, while, dan foreach untuk mengontrol alur program.', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 3);

-- Sample enrollments
INSERT INTO enrollments (user_id, course_id, progress) VALUES 
(5, 1, 75.5),
(5, 2, 45.0),
(6, 1, 100.0),
(6, 3, 30.0),
(7, 2, 60.0),
(7, 4, 85.0);

-- Indexes untuk optimasi
CREATE INDEX idx_courses_instructor ON courses(instructor_id);
CREATE INDEX idx_modules_course ON modules(course_id);
CREATE INDEX idx_lessons_module ON lessons(module_id);
CREATE INDEX idx_enrollments_user ON enrollments(user_id);
CREATE INDEX idx_enrollments_course ON enrollments(course_id);

