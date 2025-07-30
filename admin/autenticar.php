<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Administrador.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $admin = new Administrador($db);
    $admin->usuario = $_POST['usuario'];
    $admin->password = $_POST['password'];
    
    if($admin->autenticar()) {
        // Crear sesión
        $_SESSION['admin_id'] = $admin->id;
        $_SESSION['admin_usuario'] = $admin->usuario;
        $_SESSION['admin_nombre'] = $admin->nombre;
        $_SESSION['admin_email'] = $admin->email;
        
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: login.php?error=1");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
