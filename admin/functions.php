<?php
session_start();

// Verificar si el administrador está autenticado
function verificarAdmin() {
    if(!isset($_SESSION['admin_id'])) {
        header("Location: login.php");
        exit();
    }
}

// Cerrar sesión
function cerrarSesion() {
    session_destroy();
    header("Location: login.php?logout=1");
    exit();
}

// Formatear fecha
function formatearFecha($fecha) {
    return date("d/m/Y H:i", strtotime($fecha));
}

// Obtener estado con badge
function obtenerBadgeEstado($estado) {
    if($estado == 'activo') {
        return '<span class="badge bg-success">Activo</span>';
    } else {
        return '<span class="badge bg-danger">Inactivo</span>';
    }
}
?>
