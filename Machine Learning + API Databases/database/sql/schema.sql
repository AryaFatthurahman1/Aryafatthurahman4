-- ================================================
-- Database untuk Machine Learning + API
-- ================================================

-- Buat Database
CREATE DATABASE IF NOT EXISTS ml_api_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
USE ml_api_db;

-- ================================================
-- Tabel User
-- ================================================
CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(150),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Tabel Dataset
-- ================================================
CREATE TABLE IF NOT EXISTS datasets (
    dataset_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    dataset_name VARCHAR(150) NOT NULL,
    description TEXT,
    file_path VARCHAR(255),
    total_records INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Tabel Machine Learning Models
-- ================================================
CREATE TABLE IF NOT EXISTS ml_models (
    model_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    model_name VARCHAR(150) NOT NULL,
    model_type VARCHAR(50) NOT NULL,
    algorithm VARCHAR(100),
    accuracy DECIMAL(5, 2),
    `precision` DECIMAL(5, 2),
    `recall` DECIMAL(5, 2),
    f1_score DECIMAL(5, 2),
    model_path VARCHAR(255),
    dataset_id INT,
    status VARCHAR(50) DEFAULT 'training',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (dataset_id) REFERENCES datasets(dataset_id) ON DELETE SET NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_model_type (model_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Tabel Prediction Results
-- ================================================
CREATE TABLE IF NOT EXISTS predictions (
    prediction_id INT PRIMARY KEY AUTO_INCREMENT,
    model_id INT NOT NULL,
    user_id INT NOT NULL,
    input_data JSON,
    predicted_value VARCHAR(255),
    confidence DECIMAL(5, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (model_id) REFERENCES ml_models(model_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    INDEX idx_model_id (model_id),
    INDEX idx_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Tabel API Logs
-- ================================================
CREATE TABLE IF NOT EXISTS api_logs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    endpoint VARCHAR(255),
    method VARCHAR(10),
    request_data JSON,
    response_code INT,
    execution_time_ms INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL,
    INDEX idx_created_at (created_at),
    INDEX idx_endpoint (endpoint)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Tabel Training History
-- ================================================
CREATE TABLE IF NOT EXISTS training_history (
    training_id INT PRIMARY KEY AUTO_INCREMENT,
    model_id INT NOT NULL,
    epoch INT,
    loss DECIMAL(10, 6),
    accuracy DECIMAL(5, 2),
    validation_loss DECIMAL(10, 6),
    validation_accuracy DECIMAL(5, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (model_id) REFERENCES ml_models(model_id) ON DELETE CASCADE,
    INDEX idx_model_id (model_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Tabel Feature Importance
-- ================================================
CREATE TABLE IF NOT EXISTS feature_importance (
    feature_id INT PRIMARY KEY AUTO_INCREMENT,
    model_id INT NOT NULL,
    feature_name VARCHAR(150),
    importance_score DECIMAL(10, 6),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (model_id) REFERENCES ml_models(model_id) ON DELETE CASCADE,
    INDEX idx_model_id (model_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- Insert Sample Data
-- ================================================
INSERT INTO users (username, email, password_hash, full_name) VALUES
('admin', 'admin@example.com', 'hashed_password_here', 'Administrator');

INSERT INTO datasets (user_id, dataset_name, description, total_records) VALUES
(1, 'Sample Dataset', 'Dataset contoh untuk machine learning', 1000);

COMMIT;
