CREATE DATABASE IF NOT EXISTS alfamart CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE alfamart;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    user_type ENUM('customer', 'admin', 'staff') DEFAULT 'customer',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    product_name VARCHAR(150) NOT NULL,
    sku VARCHAR(50) NOT NULL UNIQUE,
    barcode VARCHAR(50) NULL,
    description TEXT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    min_stock_level INT NOT NULL DEFAULT 5,
    rating DECIMAL(3,2) DEFAULT 0.00,
    is_featured TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_products_category
        FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_number VARCHAR(50) NOT NULL UNIQUE,
    total_amount DECIMAL(12,2) NOT NULL,
    final_amount DECIMAL(12,2) NOT NULL,
    payment_method ENUM('cash', 'transfer', 'qris', 'debit') DEFAULT 'cash',
    order_status ENUM('pending', 'paid', 'packed', 'delivered') DEFAULT 'pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_orders_user
        FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    CONSTRAINT fk_order_items_order
        FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    CONSTRAINT fk_order_items_product
        FOREIGN KEY (product_id) REFERENCES products(product_id)
);

INSERT INTO users (username, email, password, full_name, user_type) VALUES
('admin', 'admin@alfamart.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin Alfamart', 'admin'),
('pelanggan1', 'pelanggan1@alfamart.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', 'customer');

INSERT INTO categories (category_name, description, sort_order) VALUES
('Makanan & Minuman', 'Snack, kopi, mie, minuman ringan', 1),
('Perawatan Diri', 'Sabun, sampo, pasta gigi, deodorant', 2),
('Rumah Tangga', 'Tisu, deterjen, alat kebersihan', 3),
('Elektronik', 'Kabel data, lampu, baterai, powerbank', 4),
('Bayi & Anak', 'Popok, susu, minyak telon', 5);

INSERT INTO products (category_id, product_name, sku, barcode, description, price, stock, min_stock_level, rating, is_featured) VALUES
(1, 'Indomie Goreng', 'ALFA-001', '8992388111111', 'Mie instan goreng favorit', 3500.00, 120, 20, 4.80, 1),
(1, 'Aqua 600 ml', 'ALFA-002', '8992388222222', 'Air mineral botol 600 ml', 4000.00, 200, 30, 4.60, 1),
(1, 'Kopi Kapal Api Mix', 'ALFA-003', '8992388333333', 'Kopi sachet praktis', 2500.00, 85, 15, 4.40, 0),
(2, 'Sampo Pantene 135 ml', 'ALFA-004', '8992388444444', 'Sampo perawatan rambut', 28900.00, 44, 10, 4.70, 1),
(2, 'Pepsodent 190 gr', 'ALFA-005', '8992388555555', 'Pasta gigi keluarga', 12900.00, 66, 12, 4.50, 0),
(3, 'Tisu Wajah Nice', 'ALFA-006', '8992388666666', 'Tisu wajah isi 250 sheet', 10900.00, 72, 15, 4.20, 0),
(3, 'Sunlight Jeruk 755 ml', 'ALFA-007', '8992388777777', 'Sabun cuci piring cair', 18400.00, 38, 10, 4.30, 0),
(4, 'Powerbank Robot 10000mAh', 'ALFA-008', '8992388888888', 'Powerbank untuk mobile computing', 149000.00, 18, 5, 4.60, 1),
(4, 'Kabel Data Type-C', 'ALFA-009', '8992388999999', 'Kabel charging dan data', 32000.00, 52, 8, 4.10, 0),
(5, 'Popok Sweety Silver M', 'ALFA-010', '8992388000000', 'Popok bayi ukuran M', 48900.00, 27, 6, 4.55, 1);

INSERT INTO orders (user_id, order_number, total_amount, final_amount, payment_method, order_status, order_date) VALUES
(2, 'ORD-20260502-001', 56400.00, 56400.00, 'qris', 'paid', NOW()),
(2, 'ORD-20260502-002', 36000.00, 36000.00, 'cash', 'packed', NOW());

INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal) VALUES
(1, 1, 4, 3500.00, 14000.00),
(1, 4, 1, 28900.00, 28900.00),
(1, 6, 1, 10900.00, 10900.00),
(2, 2, 4, 4000.00, 16000.00),
(2, 3, 4, 2500.00, 10000.00),
(2, 5, 1, 10000.00, 10000.00);

SET FOREIGN_KEY_CHECKS = 1;

SELECT 'alfamart_laragon_ready.sql berhasil diimport' AS message;
