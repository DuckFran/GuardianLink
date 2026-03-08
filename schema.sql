-- Create the Database
CREATE DATABASE IF NOT EXISTS guardianlink_db;
USE guardianlink_db;

-- 1. Users Table (Core Authentication)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    user_type ENUM('admin', 'ngo', 'volunteer') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. Profiles Table (Role-Specific Metadata)
CREATE TABLE IF NOT EXISTS profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    -- NGO Specific Fields
    organization_name VARCHAR(255) DEFAULT NULL,
    poc_email VARCHAR(255) DEFAULT NULL,
    areas_of_concern TEXT DEFAULT NULL,
    -- Volunteer Specific Fields
    full_name VARCHAR(255) DEFAULT NULL,
    hours_per_week INT DEFAULT NULL,
    background_check BOOLEAN DEFAULT FALSE,
    resume_path VARCHAR(255) DEFAULT NULL,
    -- Linking profile to user
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 3. Insert Default Admin 
-- Password is: Admin123
-- pre-hashed version of 'Admin123' for security
INSERT INTO users (email, password_hash, user_type) 
VALUES ('admin@guardianlink.org', '$2y$10$8v5u5W7A5eG7Y.vO/6rLDe0W6Yv7D6vY6Yv7D6vY6Yv7D6vY6Yv7D', 'admin')
ON DUPLICATE KEY UPDATE email=email;

-- Link the Admin profile
INSERT INTO profiles (user_id, full_name) 
SELECT id, 'System Administrator' FROM users WHERE email = 'admin@guardianlink.org'
ON DUPLICATE KEY UPDATE user_id=user_id;