<?php
require_once __DIR__ . '/../functions.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Usuario.php';

verificarAdmin();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuario($db);
    
    $usuario->id = $_POST['id'];
    $nuevo_estado = $_POST['estado'];
    
    if($usuario->cambiarEstado($nuevo_estado)) {
        echo json_encode(['success' => true, 'message' => 'Estado cambiado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al cambiar el estado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
