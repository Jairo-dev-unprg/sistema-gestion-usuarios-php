<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Usuario.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $usuario = new Usuario($db);
    
    // Asignar valores del formulario
    $usuario->nombre = $_POST['nombre'];
    $usuario->apellido = $_POST['apellido'];
    $usuario->email = $_POST['email'];
    $usuario->telefono = $_POST['telefono'];
    $usuario->fecha_nacimiento = $_POST['fecha_nacimiento'];
    $usuario->genero = $_POST['genero'];
    $usuario->direccion = $_POST['direccion'];
    $usuario->ciudad = $_POST['ciudad'];
    $usuario->password = $_POST['password'];
    
    // Validar datos
    $errores = $usuario->validar();
    
    // Verificar si el email ya existe
    if(empty($errores) && $usuario->emailExiste()) {
        $errores[] = "El email ya está registrado";
    }
    
    if(empty($errores)) {
        // Intentar crear el usuario
        if($usuario->crear()) {
            header("Location: index.php?success=1");
            exit();
        } else {
            $errores[] = "Error al registrar el usuario. Intente nuevamente.";
        }
    }
    
    // Si hay errores, redirigir con los errores
    if(!empty($errores)) {
        $error_string = urlencode(implode('|', $errores));
        header("Location: index.php?error=" . $error_string);
        exit();
    }
} else {
    // Si no es POST, redirigir al formulario
    header("Location: index.php");
    exit();
}
?>
