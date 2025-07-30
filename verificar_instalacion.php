<?php
// Archivo de instalación rápida
// Ejecutar este archivo una sola vez para configurar el sistema

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Instalador del Sistema de Gestión de Usuarios</h2>";

// Verificar extensiones de PHP
$extensiones_requeridas = ['pdo', 'pdo_mysql', 'mbstring'];
$extensiones_faltantes = [];

foreach($extensiones_requeridas as $ext) {
    if(!extension_loaded($ext)) {
        $extensiones_faltantes[] = $ext;
    }
}

if(!empty($extensiones_faltantes)) {
    echo "<div style='color: red;'>";
    echo "<h3>❌ Extensiones PHP Faltantes:</h3>";
    echo "<ul>";
    foreach($extensiones_faltantes as $ext) {
        echo "<li>$ext</li>";
    }
    echo "</ul>";
    echo "<p>Por favor, instala las extensiones faltantes antes de continuar.</p>";
    echo "</div>";
    exit;
}

echo "<div style='color: green;'>";
echo "<h3>✅ Extensiones PHP: Todas las extensiones requeridas están instaladas</h3>";
echo "</div>";

// Verificar conexión a la base de datos
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

if($db) {
    echo "<div style='color: green;'>";
    echo "<h3>✅ Conexión a Base de Datos: Exitosa</h3>";
    echo "</div>";
    
    // Verificar si las tablas existen
    try {
        $stmt = $db->query("SHOW TABLES");
        $tablas = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if(in_array('usuarios', $tablas) && in_array('administradores', $tablas)) {
            echo "<div style='color: green;'>";
            echo "<h3>✅ Tablas de Base de Datos: Configuradas correctamente</h3>";
            echo "</div>";
            
            // Verificar datos de ejemplo
            $stmt = $db->query("SELECT COUNT(*) FROM usuarios");
            $total_usuarios = $stmt->fetchColumn();
            
            $stmt = $db->query("SELECT COUNT(*) FROM administradores");
            $total_admins = $stmt->fetchColumn();
            
            echo "<div style='color: blue;'>";
            echo "<h3>📊 Estado de los Datos:</h3>";
            echo "<ul>";
            echo "<li>Usuarios registrados: $total_usuarios</li>";
            echo "<li>Administradores: $total_admins</li>";
            echo "</ul>";
            echo "</div>";
            
        } else {
            echo "<div style='color: orange;'>";
            echo "<h3>⚠️ Tablas de Base de Datos: No encontradas</h3>";
            echo "<p>Por favor, ejecuta el script SQL ubicado en 'database/schema.sql'</p>";
            echo "</div>";
        }
        
    } catch(PDOException $e) {
        echo "<div style='color: red;'>";
        echo "<h3>❌ Error al verificar tablas: " . $e->getMessage() . "</h3>";
        echo "</div>";
    }
    
} else {
    echo "<div style='color: red;'>";
    echo "<h3>❌ Error de Conexión a Base de Datos</h3>";
    echo "<p>Verifica la configuración en 'config/database.php'</p>";
    echo "</div>";
}

// Verificar permisos de archivos
$archivos_criticos = [
    'config/database.php',
    'models/Usuario.php',
    'admin/dashboard.php',
    'index.php'
];

$archivos_faltantes = [];
foreach($archivos_criticos as $archivo) {
    if(!file_exists($archivo)) {
        $archivos_faltantes[] = $archivo;
    }
}

if(empty($archivos_faltantes)) {
    echo "<div style='color: green;'>";
    echo "<h3>✅ Archivos del Sistema: Todos los archivos críticos están presentes</h3>";
    echo "</div>";
} else {
    echo "<div style='color: red;'>";
    echo "<h3>❌ Archivos Faltantes:</h3>";
    echo "<ul>";
    foreach($archivos_faltantes as $archivo) {
        echo "<li>$archivo</li>";
    }
    echo "</ul>";
    echo "</div>";
}

echo "<hr>";
echo "<h3>🚀 Enlaces de Acceso:</h3>";
echo "<ul>";
echo "<li><a href='index.php' target='_blank'>Página de Registro de Usuarios</a></li>";
echo "<li><a href='admin/login.php' target='_blank'>Panel Administrativo</a></li>";
echo "</ul>";

echo "<h3>🔐 Credenciales por Defecto:</h3>";
echo "<div style='background: #f5f5f5; padding: 10px; border-radius: 5px;'>";
echo "<strong>Administrador:</strong><br>";
echo "Usuario: <code>admin</code><br>";
echo "Contraseña: <code>admin123</code>";
echo "</div>";

echo "<hr>";
echo "<p><strong>Nota:</strong> Este archivo es solo para verificación inicial. Puedes eliminarlo después de confirmar que todo funciona correctamente.</p>";
?>
