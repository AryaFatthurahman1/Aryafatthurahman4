-- Database: db_arya_planner
-- Author: Muhammad Arya Fatthurahman
-- NIM: 2023230006
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `full_name` varchar(100) NOT NULL,
    `nim` varchar(20) NOT NULL,
    `username` varchar(50) NOT NULL UNIQUE,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `phone` varchar(20) DEFAULT NULL,
    `address` text DEFAULT NULL,
    `photo` varchar(255) DEFAULT NULL,
    `role` enum('user', 'admin') DEFAULT 'user',
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Table structure for table `hotels`
--
CREATE TABLE IF NOT EXISTS `hotels` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `description` text,
    `price_per_night` decimal(10, 2) NOT NULL,
    `location` varchar(255) NOT NULL,
    `image_url` varchar(255) NOT NULL,
    `amenities` text,
    -- JSON or comma separated string
    `rating` decimal(2, 1) DEFAULT 5.0,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `hotels`
--
INSERT INTO `hotels` (
        `name`,
        `description`,
        `price_per_night`,
        `location`,
        `image_url`,
        `amenities`,
        `rating`
    )
VALUES (
        'The Luxury Grand Hotel',
        'Experience world-class service and luxury at The Grand Hotel.',
        2500000.00,
        'Jakarta Pusat',
        'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3',
        'Swimming Pool, Gym, Spa, WiFi',
        4.8
    ),
    (
        'Ocean View Resort',
        'A beautiful resort overlooking the ocean.',
        1800000.00,
        'Bali',
        'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?ixlib=rb-4.0.3',
        'Beach Access, Pool, Bar, WiFi',
        4.9
    ),
    (
        'Mountain Retreat',
        'Escape to the mountains in our cozy retreat.',
        1200000.00,
        'Bandung',
        'https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3',
        'Hiking, Fireplace, WiFi, Breakfast',
        4.5
    ),
    (
        'City Center Inn',
        'Conveniently located in the heart of the city.',
        750000.00,
        'Surabaya',
        'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3',
        'WiFi, Parking, Restaurant',
        4.2
    ),
    (
        'River Side Boutique',
        'Charming boutique hotel by the river.',
        1500000.00,
        'Yogyakarta',
        'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3',
        'River View, Pool, Spa',
        4.7
    );
-- --------------------------------------------------------
--
-- Table structure for table `bookings`
--
CREATE TABLE IF NOT EXISTS `bookings` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `hotel_id` int(11) NOT NULL,
    `check_in` date NOT NULL,
    `check_out` date NOT NULL,
    `total_price` decimal(10, 2) NOT NULL,
    `status` enum('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending',
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`hotel_id`) REFERENCES `hotels`(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Table structure for table `articles`
--
CREATE TABLE IF NOT EXISTS `articles` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `content` text NOT NULL,
    `author` varchar(100) DEFAULT 'Admin',
    `published_date` date DEFAULT CURRENT_DATE,
    `image_url` varchar(255) DEFAULT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `articles`
--
INSERT INTO `articles` (`title`, `content`, `image_url`)
VALUES (
        'Top 10 Destinations in Indonesia',
        'Indonesia offers a variety of beautiful destinations...',
        'https://images.unsplash.com/photo-1555899434-94d1368b7efa?ixlib=rb-4.0.3'
    ),
    (
        'Tips for Budget Travel',
        'Traveling on a budget is possible with these tips...',
        'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-4.0.3'
    ),
    (
        'The Best Culinary Experiences',
        'Don\'t miss out on these amazing culinary experiences...',
        'https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3'
    );
COMMIT;