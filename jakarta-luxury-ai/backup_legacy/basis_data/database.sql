-- Jakarta Luxury AI Database Schema
SET FOREIGN_KEY_CHECKS = 0;
CREATE DATABASE IF NOT EXISTS jakarta_luxury_ai;
USE jakarta_luxury_ai;

-- Users table
-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    role ENUM('user', 'admin') DEFAULT 'user',
    avatar_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Travel destinations
CREATE TABLE IF NOT EXISTS travel_destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    price_range VARCHAR(50),
    location VARCHAR(100),
    image_url VARCHAR(255),
    rating DECIMAL(3,2) DEFAULT 0.00,
    featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Culinary items
CREATE TABLE IF NOT EXISTS culinary_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    price DECIMAL(10,2),
    restaurant_name VARCHAR(100),
    location VARCHAR(100),
    image_url VARCHAR(255),
    rating DECIMAL(3,2) DEFAULT 0.00,
    featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Reservations
CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('travel', 'culinary', 'ai_design') NOT NULL,
    item_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME,
    number_of_people INT DEFAULT 1,
    special_requests TEXT,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    total_price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- AI designs
CREATE TABLE IF NOT EXISTS ai_designs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    prompt TEXT NOT NULL,
    design_type VARCHAR(50),
    image_url VARCHAR(255),
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Chat history
CREATE TABLE IF NOT EXISTS chat_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    response TEXT,
    session_id VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10,2),
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (item_id) REFERENCES culinary_items(id)
);

-- Insert sample data
INSERT IGNORE INTO users (username, email, password_hash, full_name, phone, role) VALUES
('admin', 'admin@jakartaluxury.ai', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', '', 'admin'),
('user1', 'user1@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'John Doe', '', 'user');

TRUNCATE TABLE culinary_items;

-- Insert sample culinary data with accurate food images matching each dish name
INSERT INTO culinary_items (name, description, category, price, restaurant_name, location, image_url, rating, featured) VALUES
('Rijsttafel Modern Fusion', 'Modern interpretation of the classic Dutch-Indonesian rice table with 20+ dishes', 'Main Course', 350000, 'Amuz Gourmet', 'South Jakarta', 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&q=80&fit=crop', 4.8, TRUE),
('Wagyu Beef Maranggi', 'Premium wagyu beef with traditional Sundanese maranggi spices', 'Main Course', 450000, 'Majestic Kitchen', 'Central Jakarta', 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&q=80&fit=crop', 4.9, TRUE),
('Truffle Nasi Goreng', 'Luxury fried rice with black truffle and caviar', 'Main Course', 280000, 'Nasi Goreng Mafia', 'West Jakarta', 'https://images.unsplash.com/photo-1563379091339-032b9d7c6cf8?w=800&q=80&fit=crop', 4.7, TRUE),
('Lobster Laksa Jakarta', 'Premium lobster in Jakarta-style laksa with coconut milk', 'Main Course', 380000, 'Laksa Bar', 'North Jakarta', 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&q=80&fit=crop', 4.6, TRUE),
('Soto Betawi Premium', 'Traditional Jakarta beef soup with premium ingredients', 'Soup', 85000, 'Soto Betawi H. Husain', 'Central Jakarta', 'https://images.unsplash.com/photo-1547592166-66ac770c5e2b?w=800&q=80&fit=crop', 4.5, TRUE),
('Kerak Telor Deluxe', 'Traditional Jakarta omelette with sticky rice and premium toppings', 'Snack', 45000, 'Kerak Telor Vendor', 'Old Jakarta', 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=800&q=80&fit=crop', 4.3, TRUE),
('Es Teler 77', 'Traditional Indonesian fruit cocktail with coconut milk', 'Dessert', 35000, 'Es Teler 77', 'South Jakarta', 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=800&q=80&fit=crop', 4.4, TRUE),
('Gado-Gado Jakarta', 'Traditional Indonesian salad with peanut sauce', 'Salad', 55000, 'Gado-Gado Jakarta', 'Central Jakarta', 'https://images.unsplash.com/photo-1512058424497-f9b2c5b6c6a8?w=800&q=80&fit=crop', 4.2, TRUE),
('Ayam Goreng Kalasan', 'Crispy fried chicken with traditional Kalasan spices and coconut milk marinade', 'Main Course', 120000, 'Ayam Goreng Kalasan', 'East Jakarta', 'https://images.unsplash.com/photo-1562967914-608f82629710?w=800&q=80&fit=crop', 4.6, FALSE),
('Rendang Daging Sapi', 'Slow-cooked beef rendang with rich coconut and spice flavors', 'Main Course', 180000, 'Rendang House', 'West Jakarta', 'https://images.unsplash.com/photo-1565299507177-b0ac66763828?w=800&q=80&fit=crop', 4.8, TRUE),
('Bakso Malang Jumbo', 'Giant meatballs in rich broth with noodles and vegetables', 'Soup', 75000, 'Bakso Malang', 'Central Jakarta', 'https://images.unsplash.com/photo-1551782450-17144efb5723?w=800&q=80&fit=crop', 4.4, FALSE),
('Satay Ayam Madura', 'Grilled chicken skewers with peanut sauce and rice cakes', 'Appetizer', 95000, 'Satay Madura', 'North Jakarta', 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=800&q=80&fit=crop', 4.7, TRUE),
('Pempek Palembang', 'Fish cakes from Palembang served with tangy vinegar sauce', 'Snack', 65000, 'Pempek Palembang', 'South Jakarta', 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=800&q=80&fit=crop', 4.5, FALSE),
('Martabak Manis', 'Sweet pancake filled with chocolate, cheese, and various toppings', 'Dessert', 40000, 'Martabak Manis', 'East Jakarta', 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=800&q=80&fit=crop', 4.3, FALSE),
('Nasi Uduk Betawi', 'Fragrant coconut rice with fried chicken, egg, and sambal', 'Main Course', 55000, 'Nasi Uduk Betawi', 'Central Jakarta', 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800&q=80&fit=crop', 4.4, FALSE),
('Sate Kambing', 'Grilled goat skewers with sweet soy sauce and rice', 'Main Course', 110000, 'Sate Kambing', 'West Jakarta', 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&q=80&fit=crop', 4.6, TRUE),
('Es Cendol Durian', 'Refreshing cendol with durian, coconut milk, and palm sugar', 'Dessert', 30000, 'Es Cendol', 'South Jakarta', 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?w=800&q=80&fit=crop', 4.5, FALSE),
('Tahu Gejrot Cirebon', 'Fried tofu in sweet and spicy sauce from Cirebon', 'Snack', 25000, 'Tahu Gejrot', 'North Jakarta', 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800&q=80&fit=crop', 4.2, FALSE),
('Ikan Bakar Jimbaran', 'Grilled fish with Balinese spices and sambal matah', 'Main Course', 160000, 'Ikan Bakar Jimbaran', 'Central Jakarta', 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=800&q=80&fit=crop', 4.7, TRUE),
('Klepon', 'Sweet rice balls filled with palm sugar and coated in coconut', 'Dessert', 20000, 'Klepon Vendor', 'East Jakarta', 'https://images.unsplash.com/photo-1571875257727-256c39da42af?w=800&q=80&fit=crop', 4.1, FALSE);

SET FOREIGN_KEY_CHECKS = 1;
