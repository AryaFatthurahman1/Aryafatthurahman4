CREATE DATABASE IF NOT EXISTS facetology
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE facetology;

CREATE TABLE IF NOT EXISTS services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(120) NOT NULL,
    category VARCHAR(80) NOT NULL,
    duration_minutes INT NOT NULL,
    price DECIMAL(12, 2) NOT NULL,
    highlight VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS specialists (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(120) NOT NULL,
    specialty VARCHAR(120) NOT NULL,
    years_experience INT NOT NULL DEFAULT 1,
    is_available TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS appointments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_name VARCHAR(120) NOT NULL,
    service_id INT NOT NULL,
    specialist_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    notes TEXT NULL,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_facetology_service FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    CONSTRAINT fk_facetology_specialist FOREIGN KEY (specialist_id) REFERENCES specialists(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO services (name, category, duration_minutes, price, highlight)
SELECT * FROM (
    SELECT 'Glow Reset Signature', 'Facial Premium', 75, 525000.00, 'Deep cleanse, calming mask, dan finishing radiance.'
    UNION ALL
    SELECT 'Barrier Repair Ritual', 'Skin Recovery', 60, 450000.00, 'Treatment untuk kulit sensitif dan skin barrier lemah.'
    UNION ALL
    SELECT 'Acne Recovery Boost', 'Corrective Care', 70, 475000.00, 'Ekstraksi lembut, LED therapy, dan anti-inflammatory serum.'
    UNION ALL
    SELECT 'Glass Skin Infusion', 'Booster Session', 90, 695000.00, 'Hydration intense untuk hasil kulit sehat dan glowing.'
) AS seed
WHERE NOT EXISTS (SELECT 1 FROM services LIMIT 1);

INSERT INTO specialists (full_name, specialty, years_experience, is_available)
SELECT * FROM (
    SELECT 'Dr. Nabila Prameswari', 'Advanced Skin Renewal', 8, 1
    UNION ALL
    SELECT 'Ayu Maharani', 'Acne and Barrier Repair', 6, 1
    UNION ALL
    SELECT 'Kevin Santoso', 'Hydration and Glow Treatment', 5, 0
) AS seed
WHERE NOT EXISTS (SELECT 1 FROM specialists LIMIT 1);
