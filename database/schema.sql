CREATE DATABASE IF NOT EXISTS sistema_usuarios;
USE sistema_usuarios;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    fecha_nacimiento DATE,
    genero ENUM('Masculino', 'Femenino', 'Otro') DEFAULT NULL,
    direccion TEXT,
    ciudad VARCHAR(100),
    password VARCHAR(255) NOT NULL,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de administradores
CREATE TABLE IF NOT EXISTS administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar administrador por defecto
-- Usuario: admin, Contraseña: admin123
INSERT INTO administradores (usuario, password, nombre, email) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'admin@sistema.com')
ON DUPLICATE KEY UPDATE id=id;

-- Insertar algunos usuarios de ejemplo
INSERT INTO usuarios (nombre, apellido, email, telefono, fecha_nacimiento, genero, direccion, ciudad, password) VALUES
('Juan', 'Pérez', 'juan.perez@email.com', '555-0101', '1990-05-15', 'Masculino', 'Calle 123 #45-67', 'Bogotá', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('María', 'González', 'maria.gonzalez@email.com', '555-0102', '1985-08-22', 'Femenino', 'Carrera 98 #12-34', 'Medellín', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Carlos', 'Rodríguez', 'carlos.rodriguez@email.com', '555-0103', '1992-12-10', 'Masculino', 'Avenida 56 #78-90', 'Cali', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')
ON DUPLICATE KEY UPDATE id=id;
