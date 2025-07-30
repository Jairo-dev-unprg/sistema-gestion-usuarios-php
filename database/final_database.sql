-- ============================================================================
-- SCRIPT COMPLETO Y ACTUALIZADO PARA BASE DE DATOS DEL SISTEMA DE USUARIOS
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
-- INSERTAR ADMINISTRADOR POR DEFECTO CON HASH CORRECTO
-- Usuario: admin
-- Contraseña: admin123
-- Hash generado: $2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO
-- ============================================================================
INSERT INTO administradores (usuario, password, nombre, email) VALUES 
('admin', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO', 'Administrador Principal', 'admin@sistema.com');

-- ============================================================================
-- GENERAR HASH PARA USUARIOS (contraseña: admin123)
-- ============================================================================
-- Hash para todos los usuarios: $2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO

-- ============================================================================
-- INSERTAR USUARIOS DE EJEMPLO
-- Contraseña para todos: admin123
-- ============================================================================
INSERT INTO usuarios (nombre, apellido, email, telefono, fecha_nacimiento, genero, direccion, ciudad, password) VALUES
('Juan Carlos', 'Pérez González', 'juan.perez@email.com', '555-0101', '1990-05-15', 'Masculino', 'Calle 123 #45-67, Barrio Centro', 'Bogotá', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO'),
('María Fernanda', 'González López', 'maria.gonzalez@email.com', '555-0102', '1985-08-22', 'Femenino', 'Carrera 98 #12-34, Barrio El Poblado', 'Medellín', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO'),
('Carlos Alberto', 'Rodríguez Morales', 'carlos.rodriguez@email.com', '555-0103', '1992-12-10', 'Masculino', 'Avenida 56 #78-90, Barrio San Antonio', 'Cali', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO'),
('Ana Lucía', 'Martínez Silva', 'ana.martinez@email.com', '555-0104', '1988-03-18', 'Femenino', 'Calle 45 #23-16, Barrio La Candelaria', 'Cartagena', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO'),
('Diego Fernando', 'Hernández Castro', 'diego.hernandez@email.com', '555-0105', '1995-11-07', 'Masculino', 'Transversal 12 #67-89, Barrio Chapinero', 'Bogotá', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO'),
('Laura Patricia', 'Vargas Ruiz', 'laura.vargas@email.com', '555-0106', '1993-06-25', 'Femenino', 'Carrera 70 #34-12, Barrio Laureles', 'Medellín', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO'),
('Roberto', 'Jiménez Torres', 'roberto.jimenez@email.com', '555-0107', '1987-09-14', 'Masculino', 'Calle 88 #45-23, Barrio Santa Fe', 'Cali', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO'),
('Sofía', 'Ramírez Delgado', 'sofia.ramirez@email.com', '555-0108', '1991-04-30', 'Femenino', 'Carrera 15 #67-89, Barrio Zona Rosa', 'Barranquilla', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO'),
('Miguel Ángel', 'Ortega Sánchez', 'miguel.ortega@email.com', '555-0109', '1989-01-12', 'Masculino', 'Avenida 68 #23-45, Barrio Engativá', 'Bogotá', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO'),
('Valentina', 'Cruz Moreno', 'valentina.cruz@email.com', '555-0110', '1994-07-08', 'Femenino', 'Calle 10 #34-56, Barrio El Centro', 'Bucaramanga', '$2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO');

-- ============================================================================
-- CREAR ALGUNOS USUARIOS INACTIVOS PARA TESTING
-- ============================================================================
UPDATE usuarios SET estado = 'inactivo' WHERE id IN (3, 7);

-- ============================================================================
-- VERIFICAR QUE TODO SE INSERTÓ CORRECTAMENTE
-- ============================================================================
SELECT 'ADMINISTRADORES INSERTADOS:' as resultado;
SELECT id, usuario, nombre, email, fecha_creacion FROM administradores;

SELECT '' as espacio;
SELECT 'USUARIOS INSERTADOS:' as resultado;
SELECT id, nombre, apellido, email, ciudad, estado, fecha_registro FROM usuarios ORDER BY id;

-- ============================================================================
-- ESTADÍSTICAS FINALES DE LA BASE DE DATOS
-- ============================================================================
SELECT '' as espacio;
SELECT 'ESTADÍSTICAS FINALES:' as resultado;
SELECT 
    (SELECT COUNT(*) FROM administradores) as total_administradores,
    (SELECT COUNT(*) FROM usuarios) as total_usuarios,
    (SELECT COUNT(*) FROM usuarios WHERE estado = 'activo') as usuarios_activos,
    (SELECT COUNT(*) FROM usuarios WHERE estado = 'inactivo') as usuarios_inactivos;

-- ============================================================================
-- VERIFICAR ESTRUCTURA DE TABLAS
-- ============================================================================
SELECT '' as espacio;
SELECT 'ESTRUCTURA TABLA USUARIOS:' as resultado;
DESCRIBE usuarios;

SELECT '' as espacio;
SELECT 'ESTRUCTURA TABLA ADMINISTRADORES:' as resultado;
DESCRIBE administradores;

-- ============================================================================
-- CONSULTAS ÚTILES PARA VERIFICACIÓN
-- ============================================================================

-- Ver todos los usuarios por ciudad
SELECT ciudad, COUNT(*) as cantidad_usuarios 
FROM usuarios 
GROUP BY ciudad 
ORDER BY cantidad_usuarios DESC;

-- Ver usuarios por estado
SELECT estado, COUNT(*) as cantidad 
FROM usuarios 
GROUP BY estado;

-- Ver usuarios registrados por mes
SELECT 
    YEAR(fecha_registro) as año,
    MONTH(fecha_registro) as mes,
    COUNT(*) as usuarios_registrados
FROM usuarios 
GROUP BY YEAR(fecha_registro), MONTH(fecha_registro)
ORDER BY año DESC, mes DESC;

-- ============================================================================
-- CREDENCIALES Y INFORMACIÓN IMPORTANTE
-- ============================================================================
/*
🔐 CREDENCIALES DE ACCESO:

ADMINISTRADOR:
✅ Usuario: admin
✅ Contraseña: admin123
✅ Hash: $2y$12$NceQSXa5SSxZFiAUHThVTu4Z7RSaMpfjLZIrwUqFSNxDTof66wBPO

USUARIOS DE EJEMPLO (contraseña para todos: admin123):
✅ juan.perez@email.com
✅ maria.gonzalez@email.com  
✅ carlos.rodriguez@email.com (INACTIVO)
✅ ana.martinez@email.com
✅ diego.hernandez@email.com
✅ laura.vargas@email.com
✅ roberto.jimenez@email.com (INACTIVO)
✅ sofia.ramirez@email.com
✅ miguel.ortega@email.com
✅ valentina.cruz@email.com

📊 ESTADÍSTICAS:
- Total usuarios: 10
- Usuarios activos: 8
- Usuarios inactivos: 2
- Total administradores: 1

🌐 URLS DEL SISTEMA:
- Registro: http://localhost:8000/
- Login Admin: http://localhost:8000/admin/login.php
- Dashboard: http://localhost:8000/admin/dashboard.php
- Verificación: http://localhost:8000/verificar_instalacion.php

📋 INSTRUCCIONES:
1. Ejecuta este script completo en phpMyAdmin o MySQL
2. Verifica que todas las tablas se crearon correctamente
3. Prueba el login de administrador con admin/admin123
4. El panel de administración estará disponible inmediatamente
*/
