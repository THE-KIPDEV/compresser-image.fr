-- compresser-image.fr Database Schema

CREATE DATABASE IF NOT EXISTS compresser_image
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE compresser_image;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    plan ENUM('free', 'pro') NOT NULL DEFAULT 'free',
    plan_expires_at DATETIME NULL,
    stripe_customer_id VARCHAR(255) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_email (email),
    INDEX idx_stripe_customer_id (stripe_customer_id)
) ENGINE=InnoDB;

-- Compressions log table
CREATE TABLE IF NOT EXISTS compressions (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    original_name VARCHAR(255) NOT NULL,
    original_size INT UNSIGNED NOT NULL,
    compressed_size INT UNSIGNED NOT NULL,
    format VARCHAR(10) NOT NULL,
    mega TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;
