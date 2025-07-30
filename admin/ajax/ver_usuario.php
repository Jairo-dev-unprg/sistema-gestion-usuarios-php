<?php
require_once __DIR__ . '/../functions.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Usuario.php';

verificarAdmin();

if(isset($_GET['id'])) {
    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuario($db);
    
    $usuario->id = $_GET['id'];
    
    if($usuario->leerUno()) {
        ?>
        <div class="row">
            <div class="col-md-6">
                <p><strong><i class="fas fa-user me-2"></i>Nombre:</strong> <?php echo htmlspecialchars($usuario->nombre . ' ' . $usuario->apellido); ?></p>
                <p><strong><i class="fas fa-envelope me-2"></i>Email:</strong> <?php echo htmlspecialchars($usuario->email); ?></p>
                <p><strong><i class="fas fa-phone me-2"></i>Teléfono:</strong> <?php echo htmlspecialchars($usuario->telefono ?: 'No especificado'); ?></p>
                <p><strong><i class="fas fa-calendar me-2"></i>Fecha de Nacimiento:</strong> <?php echo $usuario->fecha_nacimiento ? date('d/m/Y', strtotime($usuario->fecha_nacimiento)) : 'No especificada'; ?></p>
                <p><strong><i class="fas fa-venus-mars me-2"></i>Género:</strong> <?php echo htmlspecialchars($usuario->genero ?: 'No especificado'); ?></p>
            </div>
            <div class="col-md-6">
                <p><strong><i class="fas fa-city me-2"></i>Ciudad:</strong> <?php echo htmlspecialchars($usuario->ciudad ?: 'No especificada'); ?></p>
                <p><strong><i class="fas fa-map-marker-alt me-2"></i>Dirección:</strong> <?php echo htmlspecialchars($usuario->direccion ?: 'No especificada'); ?></p>
                <p><strong><i class="fas fa-toggle-on me-2"></i>Estado:</strong> <?php echo obtenerBadgeEstado($usuario->estado); ?></p>
                <p><strong><i class="fas fa-clock me-2"></i>Fecha de Registro:</strong> <?php echo formatearFecha($usuario->fecha_registro); ?></p>
                <p><strong><i class="fas fa-edit me-2"></i>Última Actualización:</strong> <?php echo formatearFecha($usuario->fecha_actualizacion); ?></p>
            </div>
        </div>
        <?php
    } else {
        echo '<p class="text-center text-muted">Usuario no encontrado.</p>';
    }
} else {
    echo '<p class="text-center text-muted">ID de usuario no especificado.</p>';
}
?>
