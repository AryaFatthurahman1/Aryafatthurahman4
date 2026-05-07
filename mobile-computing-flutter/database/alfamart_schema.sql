-- Database untuk Sistem Pembelian Alfamart
-- Created for phpMyAdmin MySQL

-- ============================================
-- 1. TABEL PENGGUNA (USERS)
-- ============================================
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15),
    address VARCHAR(255),
    city VARCHAR(50),
    province VARCHAR(50),
    postal_code VARCHAR(10),
    user_type ENUM('customer', 'admin', 'staff') DEFAULT 'customer',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username)
);

-- ============================================
-- 2. TABEL KATEGORI PRODUK (CATEGORIES)
-- ============================================
CREATE TABLE categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_category_name (category_name)
);

-- ============================================
-- 3. TABEL PRODUK (PRODUCTS)
-- ============================================
CREATE TABLE products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(150) NOT NULL,
    category_id INT NOT NULL,
    sku VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    cost_price DECIMAL(10, 2),
    stock INT DEFAULT 0,
    image_url VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    INDEX idx_product_name (product_name),
    INDEX idx_sku (sku),
    INDEX idx_stock (stock)
);

-- ============================================
-- 4. TABEL STOK PRODUK (STOCK_LOGS)
-- ============================================
CREATE TABLE stock_logs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    quantity_change INT NOT NULL,
    log_type ENUM('purchase', 'sale', 'adjustment', 'return') NOT NULL,
    reference_id INT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    INDEX idx_product_id (product_id),
    INDEX idx_created_at (created_at)
);

-- ============================================
-- 5. TABEL PESANAN (ORDERS)
-- ============================================
CREATE TABLE orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(12, 2) NOT NULL,
    tax_amount DECIMAL(10, 2) DEFAULT 0,
    discount_amount DECIMAL(10, 2) DEFAULT 0,
    final_amount DECIMAL(12, 2) NOT NULL,
    payment_method ENUM('cash', 'debit', 'credit', 'transfer', 'e_wallet') DEFAULT 'cash',
    order_status ENUM('pending', 'confirmed', 'paid', 'packed', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    shipping_address VARCHAR(255),
    shipping_city VARCHAR(50),
    shipping_province VARCHAR(50),
    shipping_postal_code VARCHAR(10),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    INDEX idx_order_number (order_number),
    INDEX idx_user_id (user_id),
    INDEX idx_order_date (order_date),
    INDEX idx_order_status (order_status)
);

-- ============================================
-- 6. TABEL DETAIL PESANAN (ORDER_ITEMS)
-- ============================================
CREATE TABLE order_items (
    order_item_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(12, 2) NOT NULL,
    discount_item DECIMAL(10, 2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    INDEX idx_order_id (order_id),
    INDEX idx_product_id (product_id)
);

-- ============================================
-- 7. TABEL PEMBAYARAN (PAYMENTS)
-- ============================================
CREATE TABLE payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL UNIQUE,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(12, 2) NOT NULL,
    payment_method ENUM('cash', 'debit', 'credit', 'transfer', 'e_wallet') NOT NULL,
    payment_status ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    transaction_reference VARCHAR(100),
    notes TEXT,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    INDEX idx_order_id (order_id),
    INDEX idx_payment_date (payment_date),
    INDEX idx_payment_status (payment_status)
);

-- ============================================
-- 8. TABEL PENGIRIMAN (SHIPMENTS)
-- ============================================
CREATE TABLE shipments (
    shipment_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    courier_name VARCHAR(100),
    tracking_number VARCHAR(100),
    shipment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estimated_delivery DATE,
    actual_delivery DATE,
    shipment_status ENUM('pending', 'shipped', 'in_transit', 'delivered', 'failed') DEFAULT 'pending',
    notes TEXT,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    INDEX idx_order_id (order_id),
    INDEX idx_tracking_number (tracking_number)
);

-- ============================================
-- 9. TABEL PENGEMBALIAN BARANG (RETURNS)
-- ============================================
CREATE TABLE returns (
    return_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    return_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    reason TEXT NOT NULL,
    return_status ENUM('pending', 'approved', 'rejected', 'completed') DEFAULT 'pending',
    refund_amount DECIMAL(12, 2),
    notes TEXT,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    INDEX idx_order_id (order_id),
    INDEX idx_return_date (return_date)
);

-- ============================================
-- 10. TABEL PROMOSI & DISKON (PROMOTIONS)
-- ============================================
CREATE TABLE promotions (
    promo_id INT PRIMARY KEY AUTO_INCREMENT,
    promo_code VARCHAR(50) UNIQUE NOT NULL,
    promo_name VARCHAR(100) NOT NULL,
    description TEXT,
    discount_type ENUM('percentage', 'fixed_amount') NOT NULL,
    discount_value DECIMAL(10, 2) NOT NULL,
    min_purchase DECIMAL(12, 2) DEFAULT 0,
    max_discount DECIMAL(10, 2),
    start_date DATETIME,
    end_date DATETIME,
    max_usage INT,
    usage_count INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_promo_code (promo_code),
    INDEX idx_active (is_active)
);

-- ============================================
-- 11. TABEL REVIEW PRODUK (REVIEWS)
-- ============================================
CREATE TABLE reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    order_id INT,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    review_text TEXT,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    helpful_count INT DEFAULT 0,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    INDEX idx_product_id (product_id),
    INDEX idx_user_id (user_id),
    INDEX idx_rating (rating)
);

-- ============================================
-- 12. TABEL KERANJANG BELANJA (SHOPPING_CART)
-- ============================================
CREATE TABLE shopping_cart (
    cart_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    UNIQUE KEY unique_cart_item (user_id, product_id),
    INDEX idx_user_id (user_id)
);

-- ============================================
-- 13. TABEL WISHLIST
-- ============================================
CREATE TABLE wishlist (
    wishlist_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    UNIQUE KEY unique_wishlist_item (user_id, product_id),
    INDEX idx_user_id (user_id)
);

-- ============================================
-- 14. TABEL LOG AKTIVITAS (ACTIVITY_LOGS)
-- ============================================
CREATE TABLE activity_logs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    entity_type VARCHAR(50),
    entity_id INT,
    old_value TEXT,
    new_value TEXT,
    log_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    INDEX idx_log_timestamp (log_timestamp),
    INDEX idx_user_id (user_id)
);

-- ============================================
-- DATA DUMMY
-- ============================================

-- Insert Kategori
INSERT INTO categories (category_name, description) VALUES
('Makanan & Minuman', 'Produk makanan dan minuman siap konsumsi'),
('Perawatan Diri', 'Produk perawatan pribadi dan kecantikan'),
('Elektronik & Gadget', 'Perangkat elektronik dan aksesori'),
('Pakaian & Aksesori', 'Pakaian, sepatu, dan aksesori fashion'),
('Rumah Tangga', 'Peralatan dan perlengkapan rumah tangga');

-- Insert Produk
INSERT INTO products (product_name, category_id, sku, description, price, cost_price, stock) VALUES
('Mie Instan Premium', 1, 'SKU-001', 'Mie instan premium rasa ayam', 2500, 1500, 100),
('Kopi Instan', 1, 'SKU-002', 'Kopi instan arabika instant', 15000, 9000, 50),
('Sampo Rambut', 2, 'SKU-003', 'Sampo rambut anti ketombe', 25000, 12000, 75),
('Deodorant', 2, 'SKU-004', 'Deodorant spray 24 jam', 18000, 8000, 60),
('Powerbank 20000mAh', 3, 'SKU-005', 'Powerbank fast charging', 150000, 80000, 30),
('Kabel USB Type-C', 3, 'SKU-006', 'Kabel pengisian cepat', 45000, 20000, 80),
('Kaos Polos', 4, 'SKU-007', 'Kaos polos 100% katun', 50000, 25000, 100),
('Celana Jeans', 4, 'SKU-008', 'Celana jeans kasual', 120000, 60000, 50),
('Sikat Gigi', 5, 'SKU-009', 'Sikat gigi medium', 12000, 5000, 150),
('Tempat Sampah', 5, 'SKU-010', 'Tempat sampah plastik 20L', 35000, 15000, 40);

-- Insert Pengguna
INSERT INTO users (username, email, password, full_name, phone_number, address, city, province, user_type) VALUES
('customer1', 'customer1@example.com', 'hashed_password_1', 'Budi Santoso', '081234567890', 'Jl. Merdeka 123', 'Jakarta', 'DKI Jakarta', 'customer'),
('customer2', 'customer2@example.com', 'hashed_password_2', 'Siti Nurhaliza', '082345678901', 'Jl. Gatot Subroto 456', 'Bandung', 'Jawa Barat', 'customer'),
('admin1', 'admin@example.com', 'hashed_password_admin', 'Admin Alfamart', '083456789012', 'Jl. Admin Center', 'Jakarta', 'DKI Jakarta', 'admin');

-- ============================================
-- VIEWS BERGUNA
-- ============================================

-- View: Ringkasan Penjualan Harian
CREATE VIEW daily_sales_summary AS
SELECT 
    DATE(o.order_date) as sale_date,
    COUNT(DISTINCT o.order_id) as total_orders,
    SUM(o.final_amount) as total_revenue,
    COUNT(DISTINCT o.user_id) as unique_customers,
    AVG(o.final_amount) as avg_order_value
FROM orders o
WHERE o.order_status IN ('paid', 'shipped', 'delivered')
GROUP BY DATE(o.order_date);

-- View: Produk Terlaris
CREATE VIEW best_selling_products AS
SELECT 
    p.product_id,
    p.product_name,
    c.category_name,
    p.sku,
    p.price,
    SUM(oi.quantity) as total_sold,
    SUM(oi.subtotal) as total_revenue,
    COUNT(DISTINCT oi.order_id) as total_orders
FROM products p
JOIN categories c ON p.category_id = c.category_id
LEFT JOIN order_items oi ON p.product_id = oi.product_id
GROUP BY p.product_id
ORDER BY total_sold DESC;

-- View: Riwayat Pesanan Pelanggan
CREATE VIEW customer_order_history AS
SELECT 
    u.user_id,
    u.full_name,
    u.email,
    o.order_id,
    o.order_number,
    o.order_date,
    o.final_amount,
    o.order_status,
    COUNT(oi.order_item_id) as item_count
FROM users u
LEFT JOIN orders o ON u.user_id = o.user_id
LEFT JOIN order_items oi ON o.order_id = oi.order_id
GROUP BY o.order_id;

-- ============================================
-- STORED PROCEDURES
-- ============================================

-- Procedure: Membuat Pesanan Baru
DELIMITER //
CREATE PROCEDURE CreateNewOrder(
    IN p_user_id INT,
    IN p_total_amount DECIMAL(12,2),
    IN p_tax_amount DECIMAL(10,2),
    IN p_discount_amount DECIMAL(10,2),
    IN p_payment_method VARCHAR(50),
    OUT p_order_id INT
)
BEGIN
    DECLARE v_final_amount DECIMAL(12,2);
    DECLARE v_order_number VARCHAR(50);
    
    SET v_final_amount = p_total_amount + p_tax_amount - p_discount_amount;
    SET v_order_number = CONCAT('ORD-', DATE_FORMAT(NOW(), '%Y%m%d'), '-', LPAD(FLOOR(RAND() * 10000), 4, '0'));
    
    INSERT INTO orders (
        order_number, user_id, total_amount, tax_amount, 
        discount_amount, final_amount, payment_method, order_status
    ) VALUES (
        v_order_number, p_user_id, p_total_amount, p_tax_amount,
        p_discount_amount, v_final_amount, p_payment_method, 'pending'
    );
    
    SET p_order_id = LAST_INSERT_ID();
END //
DELIMITER ;

-- Procedure: Mengupdate Stok Produk
DELIMITER //
CREATE PROCEDURE UpdateProductStock(
    IN p_product_id INT,
    IN p_quantity_change INT,
    IN p_log_type VARCHAR(50),
    IN p_reference_id INT
)
BEGIN
    UPDATE products 
    SET stock = stock + p_quantity_change 
    WHERE product_id = p_product_id;
    
    INSERT INTO stock_logs (product_id, quantity_change, log_type, reference_id)
    VALUES (p_product_id, p_quantity_change, p_log_type, p_reference_id);
END //
DELIMITER ;

-- ============================================
-- INDEXES UNTUK PERFORMA
-- ============================================

CREATE INDEX idx_orders_status_date ON orders(order_status, order_date);
CREATE INDEX idx_order_items_order ON order_items(order_id);
CREATE INDEX idx_products_category ON products(category_id);
CREATE INDEX idx_reviews_product_rating ON reviews(product_id, rating);
