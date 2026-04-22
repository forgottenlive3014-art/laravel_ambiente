CREATE DATABASE loginregister_1;
USE loginregister_1;

-- TABLA: users (usuarios del sistema)
CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at DATETIME NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    login_attempts INT DEFAULT 0,
    blocked_until DATETIME NULL,
    municipio VARCHAR(255) NULL,
    remember_token VARCHAR(100) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- TABLA: environmental_data (datos ambientales)
CREATE TABLE environmental_data (
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

-- TABLA: sessions (sesiones de usuarios)
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX sessions_user_id_index (user_id),
    INDEX sessions_last_activity_index (last_activity)
);

-- TABLA: cache
CREATE TABLE cache (
    `key` VARCHAR(255) PRIMARY KEY,
    `value` MEDIUMTEXT NOT NULL,
    expiration INT NOT NULL
);

-- TABLA: jobs
CREATE TABLE jobs (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload LONGTEXT NOT NULL,
    attempts TINYINT NOT NULL,
    reserved_at INT NULL,
    available_at INT NOT NULL,
    created_at INT NOT NULL,
    INDEX jobs_queue_index (queue)
);

-- INSERTAR USUARIO ADMINISTRADOR
INSERT INTO users (name, email, password, role, municipio, created_at, updated_at) 
VALUES (
    'Administrador',
    'admin@ecomundo.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'admin',
    'San Salvador',
    NOW(),
    NOW()
);

-- INSERTAR USUARIOS DE PRUEBA (opcional)
INSERT INTO users (name, email, password, role, municipio, created_at, updated_at) 
VALUES 
('Usuario Normal', 'usuario@ecomundo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Santa Ana', NOW(), NOW()),
('María Gómez', 'maria@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'San Miguel', NOW(), NOW());

-- INSERTAR DATOS AMBIENTALES DE EL SALVADOR
INSERT INTO environmental_data (department, municipality, temperature, humidity, air_quality, co2_levels, recommendations, record_date, created_at, updated_at) 
VALUES
('San Salvador', 'San Salvador', 30.5, 68, 'regular', 420.00, 'Usar mascarilla en zonas concurridas', CURDATE(), NOW(), NOW()),
('San Salvador', 'Soyapango', 31.2, 70, 'regular', 425.00, 'Evitar actividades al aire libre', CURDATE(), NOW(), NOW()),
('Santa Ana', 'Santa Ana', 28.0, 72, 'buena', 380.00, 'Aprovechar para actividades al aire libre', CURDATE(), NOW(), NOW()),
('Santa Ana', 'Metapán', 27.5, 75, 'buena', 375.00, 'Clima agradable, disfruta la naturaleza', CURDATE(), NOW(), NOW()),
('San Miguel', 'San Miguel', 32.0, 65, 'regular', 410.00, 'Mantenerse hidratado y evitar el sol', CURDATE(), NOW(), NOW()),
('San Miguel', 'Chapeltique', 32.5, 63, 'mala', 430.00, 'Usar protector solar y tomar mucha agua', CURDATE(), NOW(), NOW()),
('La Libertad', 'Santa Tecla', 29.0, 78, 'buena', 370.00, 'Ideal para visitar playas', CURDATE(), NOW(), NOW()),
('La Libertad', 'La Libertad', 29.5, 80, 'buena', 365.00, 'Perfecto para surfear', CURDATE(), NOW(), NOW()),
('Usulután', 'Usulután', 31.0, 70, 'regular', 400.00, 'Evitar quemas agrícolas', CURDATE(), NOW(), NOW()),
('Usulután', 'Berlín', 30.5, 72, 'regular', 395.00, 'Proteger los bosques', CURDATE(), NOW(), NOW()),
('Sonsonate', 'Sonsonate', 30.0, 75, 'regular', 415.00, 'Proteger fuentes de agua', CURDATE(), NOW(), NOW()),
('Sonsonate', 'Acajutla', 31.0, 77, 'regular', 420.00, 'Cuidar las playas', CURDATE(), NOW(), NOW()),
('La Paz', 'Zacatecoluca', 29.5, 73, 'buena', 385.00, 'Reciclar residuos sólidos', CURDATE(), NOW(), NOW()),
('Cuscatlán', 'Cojutepeque', 27.5, 71, 'buena', 375.00, 'Reforestar áreas verdes', CURDATE(), NOW(), NOW()),
('La Unión', 'La Unión', 33.0, 62, 'mala', 450.00, 'Usar bloqueador solar y mantenerse hidratado', CURDATE(), NOW(), NOW()),
('Morazán', 'San Francisco Gotera', 29.0, 69, 'regular', 395.00, 'Proteger la biodiversidad local', CURDATE(), NOW(), NOW()),
('Ahuachapán', 'Ahuachapán', 28.0, 74, 'buena', 378.00, 'Disfrutar de los cafetales', CURDATE(), NOW(), NOW()),
('Chalatenango', 'Chalatenango', 27.0, 70, 'buena', 372.00, 'Visitar las cascadas', CURDATE(), NOW(), NOW());
