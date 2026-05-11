CREATE DATABASE laravel_ambiente;
USE laravel_ambiente;

CREATE TABLE IF NOT EXISTS users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    login_attempts INT DEFAULT 0,
    blocked_until DATETIME NULL,
    municipio VARCHAR(255) NULL,
    remember_token VARCHAR(100) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

CREATE TABLE IF NOT EXISTS environmental_data (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    department VARCHAR(255) NOT NULL,
    municipality VARCHAR(255) NOT NULL,
    temperature DECIMAL(5,2) NOT NULL,
    humidity INT NOT NULL,
    air_quality VARCHAR(255) NOT NULL,
    co2_levels DECIMAL(8,2) NOT NULL,
    recommendations TEXT NOT NULL,
    record_date DATE NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL
);

CREATE TABLE IF NOT EXISTS cache (
    cache_key VARCHAR(255) PRIMARY KEY,
    value MEDIUMTEXT NOT NULL,
    expiration INT NOT NULL
);

INSERT INTO users (name, email, password, role, municipio, created_at, updated_at) 
VALUES ('Administrador', 'admin@ecomundo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'San Salvador', NOW(), NOW());

INSERT INTO environmental_data (department, municipality, temperature, humidity, air_quality, co2_levels, recommendations, record_date, created_at, updated_at) 
VALUES 
('San Salvador', 'San Salvador', 30.5, 68, 'regular', 420, 'Usar mascarilla', CURDATE(), NOW(), NOW()),
('Santa Ana', 'Santa Ana', 28.0, 72, 'buena', 380, 'Aire limpio', CURDATE(), NOW(), NOW());