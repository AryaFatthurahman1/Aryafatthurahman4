-- Enhanced Database untuk Sistem Pembelian Alfamart Mobile Computing
-- Created for phpMyAdmin MySQL dengan fitur lengkap mobile commerce
-- Includes: Dynamic Pricing, Stock Management, Analytics, Mobile API Support

-- ============================================
-- 1. TABEL PENGGUNA (USERS) - Enhanced
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
    user_type ENUM('customer', 'admin', 'staff', 'delivery') DEFAULT 'customer',
    is_active BOOLEAN DEFAULT TRUE,
    is_verified BOOLEAN DEFAULT FALSE,
    last_login TIMESTAMP NULL,
    device_token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username),
    INDEX idx_user_type (user_type)
);

-- ============================================
-- 2. TABEL KATEGORI PRODUK (CATEGORIES) - Enhanced
-- ============================================
CREATE TABLE categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    parent_category_id INT NULL,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_category_id) REFERENCES categories(category_id),
    INDEX idx_category_name (category_name),
    INDEX idx_parent_category (parent_category_id)
);

-- ============================================
-- 3. TABEL PRODUK (PRODUCTS) - Enhanced with Mobile Features
-- ============================================
CREATE TABLE products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(150) NOT NULL,
    category_id INT NOT NULL,
    sku VARCHAR(50) UNIQUE NOT NULL,
    barcode VARCHAR(50),
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    cost_price DECIMAL(10, 2),
    stock INT DEFAULT 0,
    min_stock_level INT DEFAULT 5,
    weight DECIMAL(8, 2),
    dimensions VARCHAR(50),
    image_url VARCHAR(255),
    images JSON,
    is_active BOOLEAN DEFAULT TRUE,
    is_featured BOOLEAN DEFAULT FALSE,
    view_count INT DEFAULT 0,
    rating DECIMAL(3, 2) DEFAULT 0.00,
    review_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    INDEX idx_product_name (product_name),
    INDEX idx_sku (sku),
    INDEX idx_stock (stock),
    INDEX idx_category_id (category_id),
    INDEX idx_is_featured (is_featured),
    FULLTEXT idx_search (product_name, description)
);

-- ============================================
-- 4. TABEL HARGA DINAMIS (PRODUCT_PRICING) - NEW
-- ============================================
CREATE TABLE product_pricing (
    pricing_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    price_type ENUM('regular', 'promo', 'bulk', 'member', 'flash_sale') NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    start_date DATETIME,
    end_date DATETIME,
    min_quantity INT DEFAULT 1,
    max_quantity INT,
    user_type ENUM('all', 'member', 'vip') DEFAULT 'all',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    INDEX idx_product_id (product_id),
    INDEX idx_price_type (price_type),
    INDEX idx_dates (start_date, end_date)
);

-- ============================================
-- 5. TABEL STOK PRODUK (STOCK_LOGS) - Enhanced
-- ============================================
CREATE TABLE stock_logs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    quantity_change INT NOT NULL,
    log_type ENUM('purchase', 'sale', 'adjustment', 'return', 'damage', 'transfer') NOT NULL,
    reference_id INT,
    reference_type VARCHAR(50),
    notes TEXT,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    INDEX idx_product_id (product_id),
    INDEX idx_created_at (created_at),
    INDEX idx_log_type (log_type)
);

-- ============================================
-- 6. TABEL PESANAN (ORDERS) - Enhanced with Mobile Support
-- ============================================
CREATE TABLE orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(12, 2) NOT NULL,
    tax_amount DECIMAL(10, 2) DEFAULT 0,
    discount_amount DECIMAL(10, 2) DEFAULT 0,
    shipping_cost DECIMAL(10, 2) DEFAULT 0,
    final_amount DECIMAL(12, 2) NOT NULL,
    payment_method ENUM('cash', 'debit', 'credit', 'transfer', 'e_wallet', 'cod') DEFAULT 'cash',
    order_status ENUM('pending', 'confirmed', 'paid', 'packed', 'shipped', 'delivered', 'cancelled', 'returned') DEFAULT 'pending',
    payment_status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    shipping_address VARCHAR(255),
    shipping_city VARCHAR(50),
    shipping_province VARCHAR(50),
    shipping_postal_code VARCHAR(10),
    shipping_lat DECIMAL(10, 8),
    shipping_lng DECIMAL(11, 8),
    notes TEXT,
    device_info JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    INDEX idx_order_number (order_number),
    INDEX idx_user_id (user_id),
    INDEX idx_order_date (order_date),
    INDEX idx_order_status (order_status),
    INDEX idx_payment_status (payment_status)
);

-- ============================================
-- 7. TABEL DETAIL PESANAN (ORDER_ITEMS) - Enhanced
-- ============================================
CREATE TABLE order_items (
    order_item_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(12, 2) NOT NULL,
    discount_item DECIMAL(10, 2) DEFAULT 0,
    product_snapshot JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    INDEX idx_order_id (order_id),
    INDEX idx_product_id (product_id)
);

-- ============================================
-- 8. TABEL PEMBAYARAN (PAYMENTS) - Enhanced
-- ============================================
CREATE TABLE payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL UNIQUE,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(12, 2) NOT NULL,
    payment_method ENUM('cash', 'debit', 'credit', 'transfer', 'e_wallet', 'cod', 'qris') NOT NULL,
    payment_status ENUM('pending', 'completed', 'failed', 'refunded', 'partial') DEFAULT 'pending',
    transaction_reference VARCHAR(100),
    payment_gateway VARCHAR(50),
    gateway_response JSON,
    paid_amount DECIMAL(12, 2) DEFAULT 0,
    change_amount DECIMAL(10, 2) DEFAULT 0,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    INDEX idx_order_id (order_id),
    INDEX idx_payment_date (payment_date),
    INDEX idx_payment_status (payment_status),
    INDEX idx_transaction_reference (transaction_reference)
);

-- ============================================
-- 9. TABEL PENGIRIMAN (SHIPMENTS) - Enhanced with Tracking
-- ============================================
CREATE TABLE shipments (
    shipment_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    courier_name VARCHAR(100),
    courier_service VARCHAR(100),
    tracking_number VARCHAR(100),
    shipment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estimated_delivery DATE,
    actual_delivery DATE,
    shipment_status ENUM('pending', 'shipped', 'in_transit', 'delivered', 'failed', 'returned') DEFAULT 'pending',
    shipping_cost DECIMAL(10, 2) DEFAULT 0,
    tracking_history JSON,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    INDEX idx_order_id (order_id),
    INDEX idx_tracking_number (tracking_number),
    INDEX idx_shipment_status (shipment_status)
);

-- ============================================
-- 10. TABEL PENGEMBALIAN BARANG (RETURNS) - Enhanced
-- ============================================
CREATE TABLE returns (
    return_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    return_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    reason TEXT NOT NULL,
    return_status ENUM('pending', 'approved', 'rejected', 'completed', 'received') DEFAULT 'pending',
    refund_amount DECIMAL(12, 2),
    refund_method ENUM('original', 'bank_transfer', 'e_wallet', 'store_credit'),
    refund_status ENUM('pending', 'processed', 'completed') DEFAULT 'pending',
    images JSON,
    notes TEXT,
    processed_by INT,
    processed_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (processed_by) REFERENCES users(user_id),
    INDEX idx_order_id (order_id),
    INDEX idx_return_date (return_date),
    INDEX idx_return_status (return_status)
);

-- ============================================
-- 11. TABEL PROMOSI & DISKON (PROMOTIONS) - Enhanced
-- ============================================
CREATE TABLE promotions (
    promo_id INT PRIMARY KEY AUTO_INCREMENT,
    promo_code VARCHAR(50) UNIQUE NOT NULL,
    promo_name VARCHAR(100) NOT NULL,
    description TEXT,
    discount_type ENUM('percentage', 'fixed_amount', 'buy_one_get_one', 'free_shipping') NOT NULL,
    discount_value DECIMAL(10, 2) NOT NULL,
    min_purchase DECIMAL(12, 2) DEFAULT 0,
    max_discount DECIMAL(10, 2),
    applicable_products JSON,
    applicable_categories JSON,
    start_date DATETIME,
    end_date DATETIME,
    max_usage INT,
    usage_count INT DEFAULT 0,
    usage_per_user INT DEFAULT 1,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_promo_code (promo_code),
    INDEX idx_active (is_active),
    INDEX idx_dates (start_date, end_date)
);

-- ============================================
-- 12. TABEL REVIEW PRODUK (REVIEWS) - Enhanced
-- ============================================
CREATE TABLE reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    order_id INT,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    review_text TEXT,
    images JSON,
    is_verified_purchase BOOLEAN DEFAULT FALSE,
    helpful_count INT DEFAULT 0,
    is_visible BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    INDEX idx_product_id (product_id),
    INDEX idx_user_id (user_id),
    INDEX idx_rating (rating),
    UNIQUE KEY unique_user_product_review (user_id, product_id)
);

-- ============================================
-- 13. TABEL KERANJANG BELANJA (SHOPPING_CART) - Enhanced
-- ============================================
CREATE TABLE shopping_cart (
    cart_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    UNIQUE KEY unique_user_product (user_id, product_id),
    INDEX idx_user_id (user_id)
);

-- ============================================
-- 14. TABEL DAFTAR KEINGINAN (WISHLIST) - Enhanced
-- ============================================
CREATE TABLE wishlist (
    wishlist_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    UNIQUE KEY unique_user_product_wishlist (user_id, product_id),
    INDEX idx_user_id (user_id)
);

-- ============================================
-- 15. TABEL LOG AKTIVITAS (ACTIVITY_LOGS) - Enhanced
-- ============================================
CREATE TABLE activity_logs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    action VARCHAR(50) NOT NULL,
    table_name VARCHAR(50),
    record_id INT,
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    device_info JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    INDEX idx_user_id (user_id),
    INDEX idx_action (action),
    INDEX idx_created_at (created_at),
    INDEX idx_table_record (table_name, record_id)
);

-- ============================================
-- 16. TABEL NOTIFIKASI (NOTIFICATIONS) - NEW for Mobile
-- ============================================
CREATE TABLE notifications (
    notification_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    title VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    type ENUM('order', 'payment', 'shipment', 'promo', 'system') NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    data JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    read_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    INDEX idx_user_id (user_id),
    INDEX idx_is_read (is_read),
    INDEX idx_type (type),
    INDEX idx_created_at (created_at)
);

-- ============================================
-- 17. TABEL ALAMAT PENGIRIMAN (ADDRESSES) - NEW for Mobile
-- ============================================
CREATE TABLE addresses (
    address_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    label VARCHAR(50),
    recipient_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(50) NOT NULL,
    province VARCHAR(50) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    is_default BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    INDEX idx_user_id (user_id),
    INDEX idx_is_default (is_default)
);

-- ============================================
-- 18. TABEL SESSION USER (USER_SESSIONS) - NEW for Mobile Auth
-- ============================================
CREATE TABLE user_sessions (
    session_id VARCHAR(128) PRIMARY KEY,
    user_id INT NOT NULL,
    device_info JSON,
    ip_address VARCHAR(45),
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    INDEX idx_user_id (user_id),
    INDEX idx_expires_at (expires_at),
    INDEX idx_last_activity (last_activity)
);

-- ============================================
-- VIEWS FOR REPORTING & ANALYTICS
-- ============================================

-- View: Daily Sales Summary
CREATE VIEW daily_sales_summary AS
SELECT 
    DATE(o.order_date) as sale_date,
    COUNT(DISTINCT o.order_id) as total_orders,
    COUNT(DISTINCT o.user_id) as unique_customers,
    SUM(o.final_amount) as total_revenue,
    AVG(o.final_amount) as avg_order_value,
    SUM(CASE WHEN o.order_status = 'delivered' THEN 1 ELSE 0 END) as delivered_orders
FROM orders o
WHERE o.order_status IN ('paid', 'shipped', 'delivered')
GROUP BY DATE(o.order_date);

-- View: Best Selling Products
CREATE VIEW best_selling_products AS
SELECT 
    p.product_id,
    p.product_name,
    p.category_id,
    c.category_name,
    SUM(oi.quantity) as total_sold,
    SUM(oi.subtotal) as total_revenue,
    COUNT(DISTINCT oi.order_id) as order_count,
    AVG(r.rating) as avg_rating
FROM products p
LEFT JOIN order_items oi ON p.product_id = oi.product_id
LEFT JOIN orders o ON oi.order_id = o.order_id AND o.order_status = 'delivered'
LEFT JOIN categories c ON p.category_id = c.category_id
LEFT JOIN reviews r ON p.product_id = r.product_id
GROUP BY p.product_id, p.product_name, p.category_id, c.category_name
ORDER BY total_sold DESC;

-- View: Customer Order History
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
    o.payment_status,
    COUNT(oi.order_item_id) as item_count,
    s.shipment_status,
    s.tracking_number
FROM users u
LEFT JOIN orders o ON u.user_id = o.user_id
LEFT JOIN order_items oi ON o.order_id = oi.order_id
LEFT JOIN shipments s ON o.order_id = s.order_id
ORDER BY u.user_id, o.order_date DESC;

-- View: Product Inventory Status
CREATE VIEW product_inventory_status AS
SELECT 
    p.product_id,
    p.product_name,
    p.stock,
    p.min_stock_level,
    p.price,
    p.is_active,
    c.category_name,
    CASE 
        WHEN p.stock = 0 THEN 'Out of Stock'
        WHEN p.stock <= p.min_stock_level THEN 'Low Stock'
        ELSE 'In Stock'
    END as stock_status,
    (SELECT SUM(quantity_change) FROM stock_logs sl WHERE sl.product_id = p.product_id AND sl.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)) as monthly_movement
FROM products p
JOIN categories c ON p.category_id = c.category_id;

-- ============================================
-- STORED PROCEDURES
-- ============================================

DELIMITER //

-- Procedure: Create New Order with Stock Management
CREATE PROCEDURE CreateNewOrder(
    IN p_user_id INT,
    IN p_total_amount DECIMAL(12,2),
    IN p_tax_amount DECIMAL(10,2),
    IN p_discount_amount DECIMAL(10,2),
    IN p_shipping_cost DECIMAL(10,2),
    IN p_final_amount DECIMAL(12,2),
    IN p_payment_method VARCHAR(20),
    IN p_shipping_address VARCHAR(255),
    IN p_notes TEXT,
    OUT p_order_id INT
)
BEGIN
    DECLARE v_order_number VARCHAR(50);
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;
    
    START TRANSACTION;
    
    -- Generate order number
    SET v_order_number = CONCAT('ORD', DATE_FORMAT(NOW(), '%Y%m%d'), LPAD(CONNECTION_ID(), 6, '0'));
    
    -- Insert order
    INSERT INTO orders (
        order_number, user_id, total_amount, tax_amount, 
        discount_amount, shipping_cost, final_amount, 
        payment_method, shipping_address, notes
    ) VALUES (
        v_order_number, p_user_id, p_total_amount, p_tax_amount,
        p_discount_amount, p_shipping_cost, p_final_amount,
        p_payment_method, p_shipping_address, p_notes
    );
    
    SET p_order_id = LAST_INSERT_ID();
    
    COMMIT;
END //

-- Procedure: Update Product Stock with Logging
CREATE PROCEDURE UpdateProductStock(
    IN p_product_id INT,
    IN p_quantity_change INT,
    IN p_log_type VARCHAR(20),
    IN p_reference_id INT,
    IN p_reference_type VARCHAR(50),
    IN p_notes TEXT,
    IN p_user_id INT
)
BEGIN
    DECLARE v_current_stock INT;
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;
    
    START TRANSACTION;
    
    -- Get current stock
    SELECT stock INTO v_current_stock FROM products WHERE product_id = p_product_id FOR UPDATE;
    
    -- Check if stock will be negative
    IF v_current_stock + p_quantity_change < 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Insufficient stock';
    END IF;
    
    -- Update product stock
    UPDATE products 
    SET stock = stock + p_quantity_change,
        updated_at = NOW()
    WHERE product_id = p_product_id;
    
    -- Log the change
    INSERT INTO stock_logs (
        product_id, quantity_change, log_type, 
        reference_id, reference_type, notes, user_id
    ) VALUES (
        p_product_id, p_quantity_change, p_log_type,
        p_reference_id, p_reference_type, p_notes, p_user_id
    );
    
    COMMIT;
END //

-- Procedure: Get Product Price with Dynamic Pricing
CREATE PROCEDURE GetProductPrice(
    IN p_product_id INT,
    IN p_user_type VARCHAR(20),
    IN p_quantity INT,
    OUT p_price DECIMAL(10,2),
    OUT p_price_type VARCHAR(20)
)
BEGIN
    -- Default to regular price
    SELECT price, 'regular' INTO p_price, p_price_type
    FROM products 
    WHERE product_id = p_product_id AND is_active = 1;
    
    -- Check for better pricing
    SELECT pp.price, pp.price_type INTO p_price, p_price_type
    FROM product_pricing pp
    WHERE pp.product_id = p_product_id 
        AND pp.is_active = 1
        AND (pp.start_date IS NULL OR pp.start_date <= NOW())
        AND (pp.end_date IS NULL OR pp.end_date >= NOW())
        AND p_quantity >= pp.min_quantity
        AND (pp.max_quantity IS NULL OR p_quantity <= pp.max_quantity)
        AND (pp.user_type = 'all' OR pp.user_type = p_user_type)
    ORDER BY 
        CASE pp.price_type 
            WHEN 'flash_sale' THEN 1
            WHEN 'promo' THEN 2
            WHEN 'bulk' THEN 3
            WHEN 'member' THEN 4
            ELSE 5
        END,
        pp.price ASC
    LIMIT 1;
END //

DELIMITER ;

-- ============================================
-- TRIGGERS FOR AUTOMATIC UPDATES
-- ============================================

DELIMITER //

-- Trigger: Update product rating when review is added/updated
CREATE TRIGGER update_product_rating_after_review
AFTER INSERT ON reviews
FOR EACH ROW
BEGIN
    UPDATE products 
    SET 
        rating = (SELECT AVG(rating) FROM reviews WHERE product_id = NEW.product_id AND is_visible = 1),
        review_count = (SELECT COUNT(*) FROM reviews WHERE product_id = NEW.product_id AND is_visible = 1),
        updated_at = NOW()
    WHERE product_id = NEW.product_id;
END //

CREATE TRIGGER update_product_rating_after_review_update
AFTER UPDATE ON reviews
FOR EACH ROW
BEGIN
    UPDATE products 
    SET 
        rating = (SELECT AVG(rating) FROM reviews WHERE product_id = NEW.product_id AND is_visible = 1),
        review_count = (SELECT COUNT(*) FROM reviews WHERE product_id = NEW.product_id AND is_visible = 1),
        updated_at = NOW()
    WHERE product_id = NEW.product_id;
END //

-- Trigger: Log activity for order changes
CREATE TRIGGER log_order_activity
AFTER UPDATE ON orders
FOR EACH ROW
BEGIN
    IF OLD.order_status != NEW.order_status THEN
        INSERT INTO activity_logs (user_id, action, table_name, record_id, old_values, new_values)
        VALUES (
            NEW.user_id, 
            'status_change', 
            'orders', 
            NEW.order_id,
            JSON_OBJECT('order_status', OLD.order_status),
            JSON_OBJECT('order_status', NEW.order_status)
        );
    END IF;
END //

DELIMITER ;

-- ============================================
-- INSERT SAMPLE DATA FOR TESTING
-- ============================================

-- Insert Categories
INSERT INTO categories (category_name, description, sort_order) VALUES
('Makanan & Minuman', 'Berbagai macam makanan dan minuman', 1),
('Perawatan Diri', 'Produk perawatan pribadi dan kecantikan', 2),
('Elektronik & Gadget', 'Elektronik dan gadget modern', 3),
('Pakaian & Aksesori', 'Fashion dan aksesori', 4),
('Rumah Tangga', 'Peralatan rumah tangga', 5),
('Kesehatan', 'Produk kesehatan dan obat-obatan', 6),
('Bayi & Anak', 'Kebutuhan bayi dan anak-anak', 7),
('Olahraga', 'Peralatan olahraga', 8);

-- Insert Users
INSERT INTO users (username, email, password, full_name, phone_number, address, city, province, postal_code, user_type, is_verified) VALUES
('customer1', 'customer1@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ahmad Wijaya', '08123456789', 'Jl. Merdeka No. 123', 'Jakarta', 'DKI Jakarta', '12345', 'customer', TRUE),
('customer2', 'customer2@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Siti Nurhaliza', '08234567890', 'Jl. Sudirman No. 456', 'Bandung', 'Jawa Barat', '40123', 'customer', TRUE),
('admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin Alfamart', '08345678901', 'Jl. Gatot Subroto No. 789', 'Surabaya', 'Jawa Timur', '60234', 'admin', TRUE);

-- Insert Products with Enhanced Data
INSERT INTO products (product_name, category_id, sku, barcode, description, price, cost_price, stock, min_stock_level, weight, image_url, is_active, is_featured, rating, review_count) VALUES
('Mie Instan Sedaap', 1, 'MIE001', '8999999001234', 'Mie instan rasa ayam bawang', 2500.00, 1800.00, 150, 20, 0.08, 'https://example.com/mie1.jpg', TRUE, TRUE, 4.5, 12),
('Kopi Kapal Api', 1, 'KOP001', '8999999002345', 'Kopi instan sachet', 15000.00, 12000.00, 80, 15, 0.02, 'https://example.com/kopi1.jpg', TRUE, FALSE, 4.2, 8),
('Sampo Pantene', 2, 'SHP001', '8999999003456', 'Sampo perawatan rambut', 25000.00, 20000.00, 45, 10, 0.34, 'https://example.com/sampo1.jpg', TRUE, TRUE, 4.7, 15),
('Deodorant Rexona', 2, 'DEO001', '8999999004567', 'Deodorant roll-on', 18000.00, 14000.00, 60, 12, 0.05, 'https://example.com/deo1.jpg', TRUE, FALSE, 4.3, 9),
('Powerbank ROBOT', 3, 'PWB001', '8999999005678', 'Powerbank 10000mAh', 150000.00, 120000.00, 25, 5, 0.25, 'https://example.com/powerbank1.jpg', TRUE, TRUE, 4.6, 7),
('Kabel USB Type C', 3, 'KBL001', '8999999006789', 'Kabel USB Type C 1.5m', 45000.00, 35000.00, 70, 15, 0.08, 'https://example.com/kabel1.jpg', TRUE, FALSE, 4.1, 6),
('Kaos Polos Cotton', 4, 'KAO001', '8999999007890', 'Kaos polos 100% cotton', 50000.00, 35000.00, 40, 8, 0.20, 'https://example.com/kaos1.jpg', TRUE, TRUE, 4.4, 11),
('Celana Jeans Levis', 4, 'JEN001', '8999999008901', 'Celana jeans slim fit', 120000.00, 90000.00, 20, 5, 0.45, 'https://example.com/jeans1.jpg', TRUE, FALSE, 4.8, 4),
('Sikat Gigi Pepsodent', 2, 'SGT001', '8999999009012', 'Sikat gigi soft', 12000.00, 9000.00, 100, 20, 0.03, 'https://example.com/sikat1.jpg', TRUE, FALSE, 4.0, 5),
('Tempat Sampah Lipat', 5, 'TSK001', '8999999000123', 'Tempat sampah plastik lipat', 35000.00, 28000.00, 30, 8, 0.80, 'https://example.com/tempat1.jpg', TRUE, TRUE, 4.2, 3);

-- Insert Dynamic Pricing
INSERT INTO product_pricing (product_id, price_type, price, start_date, end_date, min_quantity, max_quantity, user_type) VALUES
(1, 'bulk', 2200.00, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 10, NULL, 'all'),
(1, 'flash_sale', 1999.00, NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY), 1, NULL, 'all'),
(3, 'promo', 22500.00, NOW(), DATE_ADD(NOW(), INTERVAL 14 DAY), 1, NULL, 'member'),
(5, 'bulk', 135000.00, NOW(), DATE_ADD(NOW(), INTERVAL 60 DAY), 5, NULL, 'all'),
(7, 'member', 45000.00, NOW(), NULL, 1, NULL, 'member');

-- Insert Addresses for Users
INSERT INTO addresses (user_id, label, recipient_name, phone_number, address, city, province, postal_code, is_default) VALUES
(1, 'Rumah', 'Ahmad Wijaya', '08123456789', 'Jl. Merdeka No. 123 RT 01 RW 02', 'Jakarta', 'DKI Jakarta', '12345', TRUE),
(1, 'Kantor', 'Ahmad Wijaya', '08123456789', 'Jl. Thamrin No. 456', 'Jakarta', 'DKI Jakarta', '12346', FALSE),
(2, 'Rumah', 'Siti Nurhaliza', '08234567890', 'Jl. Sudirman No. 456', 'Bandung', 'Jawa Barat', '40123', TRUE);

-- Insert Sample Notifications
INSERT INTO notifications (user_id, title, message, type, data) VALUES
(1, 'Pesanan Dikonfirmasi', 'Pesanan ORD2024120100001 telah dikonfirmasi', 'order', JSON_OBJECT('order_id', 1, 'order_number', 'ORD2024120100001')),
(2, 'Promo Spesial', 'Dapatkan diskon 20% untuk semua produk elektronik', 'promo', JSON_OBJECT('promo_code', 'ELEKTRONIK20')),
(1, 'Pengiriman', 'Pesanan Anda sedang dalam perjalanan', 'shipment', JSON_OBJECT('order_id', 1, 'tracking_number', 'TRK123456789'));

-- ============================================
-- DATABASE SETUP COMPLETE
-- ============================================

-- Create indexes for better performance
CREATE INDEX idx_products_search ON products(product_name, description);
CREATE INDEX idx_orders_user_date ON orders(user_id, order_date);
CREATE INDEX idx_notifications_unread ON notifications(user_id, is_read, created_at);

-- Set foreign key checks
SET FOREIGN_KEY_CHECKS = 1;

-- Display setup completion message
SELECT 'Enhanced Alfamart Database setup completed successfully!' as message,
       (SELECT COUNT(*) FROM categories) as categories_created,
       (SELECT COUNT(*) FROM products) as products_created,
       (SELECT COUNT(*) FROM users) as users_created,
       (SELECT COUNT(*) FROM product_pricing) as pricing_rules_created;
