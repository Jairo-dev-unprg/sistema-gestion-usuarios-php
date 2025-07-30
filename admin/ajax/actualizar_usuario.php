<?php
require_once __DIR__ . '/../functions.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Usuario.php';

verificarAdmin();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuario($db);
    
    // Asignar valores
    $usuario->id = $_POST['id'];
    $usuario->nombre = $_POST['nombre'];
    $usuario->apellido = $_POST['apellido'];
    $usuario->email = $_POST['email'];
    $usuario->telefono = $_POST['telefono'];
    $usuario->fecha_nacimiento = $_POST['fecha_nacimiento'];
    $usuario->genero = $_POST['genero'];
    $usuario->direccion = $_POST['direccion'];
    $usuario->ciudad = $_POST['ciudad'];
    $usuario->estado = $_POST['estado'];
    
    // Validar datos básicos
    $errores = array();
    
    if(empty($usuario->nombre)) {
        $errores[] = "El nombre es requerido";
    }
    
    if(empty($usuario->apellido)) {
        $errores[] = "El apellido es requerido";
    }
    
    if(empty($usuario->email)) {
        $errores[] = "El email es requerido";
    } elseif(!filter_var($usuario->email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del email no es válido";
    }
    
    if(empty($errores)) {
        if($usuario->actualizar()) {
            echo json_encode(['success' => true, 'message' => 'Usuario actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el usuario']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => implode(', ', $errores)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
