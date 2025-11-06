-- Landing Page Universe - Database Schema
-- Copy and paste these queries into your database

-- Users Table
CREATE TABLE `users` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `username` VARCHAR(100) UNIQUE NOT NULL,
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Pages Table (Each user can have one landing page)
CREATE TABLE `pages` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT(11) UNIQUE NOT NULL,
  `page_slug` VARCHAR(100) UNIQUE NOT NULL,
  `header_image` VARCHAR(255) DEFAULT NULL,
  `subtitle_1` VARCHAR(255) DEFAULT NULL,
  `subtitle_2` VARCHAR(255) DEFAULT NULL,
  `subtitle_3` VARCHAR(255) DEFAULT NULL,
  `background_type` ENUM('gradient', 'color', 'image') DEFAULT 'gradient',
  `background_value` TEXT DEFAULT NULL,
  `share_enabled` TINYINT(1) DEFAULT 1,
  `qr_enabled` TINYINT(1) DEFAULT 1,
  `view_count` INT(11) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Links Table
CREATE TABLE `links` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `page_id` INT(11) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `url` TEXT NOT NULL,
  `icon` VARCHAR(100) DEFAULT NULL,
  `background_color` VARCHAR(50) DEFAULT '#000000',
  `text_color` VARCHAR(50) DEFAULT '#FFFFFF',
  `position` INT(11) DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1,
  `click_count` INT(11) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`page_id`) REFERENCES `pages`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Carousel Images Table
CREATE TABLE `carousel_images` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `page_id` INT(11) NOT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `caption` VARCHAR(255) DEFAULT NULL,
  `position` INT(11) DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`page_id`) REFERENCES `pages`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Social Media Links Table
CREATE TABLE `social_links` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `page_id` INT(11) NOT NULL,
  `platform` VARCHAR(50) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `position` INT(11) DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`page_id`) REFERENCES `pages`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Click Analytics Table
CREATE TABLE `link_analytics` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `link_id` INT(11) NOT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_agent` TEXT DEFAULT NULL,
  `referrer` VARCHAR(255) DEFAULT NULL,
  `clicked_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`link_id`) REFERENCES `links`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin user
-- Password: password (hashed with password_hash)
INSERT INTO `users` (`email`, `password`, `username`) 
VALUES ('admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert default page for admin
INSERT INTO `pages` (`user_id`, `page_slug`, `subtitle_1`, `subtitle_2`, `subtitle_3`) 
VALUES (1, 'admin', 'Welcome to Your Landing Page', 'Customize Everything', 'Share Your Links');

