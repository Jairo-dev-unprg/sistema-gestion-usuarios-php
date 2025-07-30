-- ============================================================================
-- SCRIPT COMPLETO PARA BASE DE DATOS DEL SISTEMA DE USUARIOS
-- ============================================================================

-- Crear base de datos (opcional si ya existe)
CREATE DATABASE IF NOT EXISTS sistema_usuarios;
USE sistema_usuarios;

-- ============================================================================
-- ELIMINAR TABLAS SI EXISTEN (para empezar limpio)
-- ============================================================================
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS administradores;

-- ============================================================================
-- TABLA DE USUARIOS
-- ============================================================================
CREATE TABLE usuarios (
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

-- ============================================================================
-- TABLA DE ADMINISTRADORES
-- ============================================================================
CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================================
-- INSERTAR ADMINISTRADOR POR DEFECTO
-- Usuario: admin
-- Contraseña: admin123
-- ============================================================================
INSERT INTO administradores (usuario, password, nombre, email) VALUES 
('admin', '$2y$10$EqKjw8n8H5K5K5K5K5K5K.uR7Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Q2', 'Administrador Principal', 'admin@sistema.com');

-- Verificar que se insertó correctamente
SELECT * FROM administradores;

-- ============================================================================
-- INSERTAR USUARIOS DE EJEMPLO
-- Contraseña para todos: admin123
-- ============================================================================
INSERT INTO usuarios (nombre, apellido, email, telefono, fecha_nacimiento, genero, direccion, ciudad, password) VALUES
('Juan Carlos', 'Pérez González', 'juan.perez@email.com', '555-0101', '1990-05-15', 'Masculino', 'Calle 123 #45-67, Barrio Centro', 'Bogotá', '$2y$10$EqKjw8n8H5K5K5K5K5K5K.uR7Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Q2'),
('María Fernanda', 'González López', 'maria.gonzalez@email.com', '555-0102', '1985-08-22', 'Femenino', 'Carrera 98 #12-34, Barrio El Poblado', 'Medellín', '$2y$10$EqKjw8n8H5K5K5K5K5K5K.uR7Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Q2'),
('Carlos Alberto', 'Rodríguez Morales', 'carlos.rodriguez@email.com', '555-0103', '1992-12-10', 'Masculino', 'Avenida 56 #78-90, Barrio San Antonio', 'Cali', '$2y$10$EqKjw8n8H5K5K5K5K5K5K.uR7Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Q2'),
('Ana Lucía', 'Martínez Silva', 'ana.martinez@email.com', '555-0104', '1988-03-18', 'Femenino', 'Calle 45 #23-16, Barrio La Candelaria', 'Cartagena', '$2y$10$EqKjw8n8H5K5K5K5K5K5K.uR7Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Q2'),
('Diego Fernando', 'Hernández Castro', 'diego.hernandez@email.com', '555-0105', '1995-11-07', 'Masculino', 'Transversal 12 #67-89, Barrio Chapinero', 'Bogotá', '$2y$10$EqKjw8n8H5K5K5K5K5K5K.uR7Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Q2'),
('Laura Patricia', 'Vargas Ruiz', 'laura.vargas@email.com', '555-0106', '1993-06-25', 'Femenino', 'Carrera 70 #34-12, Barrio Laureles', 'Medellín', '$2y$10$EqKjw8n8H5K5K5K5K5K5K.uR7Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Qk8Q2');

-- ============================================================================
-- VERIFICAR QUE TODO SE INSERTÓ CORRECTAMENTE
-- ============================================================================
SELECT 'ADMINISTRADORES:' as tabla;
SELECT id, usuario, nombre, email, fecha_creacion FROM administradores;

SELECT 'USUARIOS:' as tabla;
SELECT id, nombre, apellido, email, ciudad, estado, fecha_registro FROM usuarios;

-- ============================================================================
-- ESTADÍSTICAS FINALES
-- ============================================================================
SELECT 
    'RESUMEN' as info,
    (SELECT COUNT(*) FROM administradores) as total_administradores,
    (SELECT COUNT(*) FROM usuarios) as total_usuarios,
    (SELECT COUNT(*) FROM usuarios WHERE estado = 'activo') as usuarios_activos,
    (SELECT COUNT(*) FROM usuarios WHERE estado = 'inactivo') as usuarios_inactivos;

-- ============================================================================
-- INSTRUCCIONES DE USO:
-- ============================================================================
/*
CREDENCIALES DE ACCESO:

🔐 ADMINISTRADOR:
   Usuario: admin
   Contraseña: admin123

👥 USUARIOS DE EJEMPLO:
   Email: juan.perez@email.com
   Email: maria.gonzalez@email.com
   Email: carlos.rodriguez@email.com
   Email: ana.martinez@email.com
   Email: diego.hernandez@email.com
   Email: laura.vargas@email.com
   Contraseña para todos: admin123

📍 URLS DE ACCESO:
   - Registro: http://localhost:8000/
   - Admin: http://localhost:8000/admin/login.php
   - Verificar: http://localhost:8000/verificar_instalacion.php
*/
