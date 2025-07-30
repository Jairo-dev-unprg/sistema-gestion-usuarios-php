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
        <form id="formEditarUsuario">
            <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_nombre" class="form-label">
                        <i class="fas fa-user me-1"></i>Nombre *
                    </label>
                    <input type="text" class="form-control" id="edit_nombre" name="nombre" value="<?php echo htmlspecialchars($usuario->nombre); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_apellido" class="form-label">
                        <i class="fas fa-user me-1"></i>Apellido *
                    </label>
                    <input type="text" class="form-control" id="edit_apellido" name="apellido" value="<?php echo htmlspecialchars($usuario->apellido); ?>" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_email" class="form-label">
                        <i class="fas fa-envelope me-1"></i>Email *
                    </label>
                    <input type="email" class="form-control" id="edit_email" name="email" value="<?php echo htmlspecialchars($usuario->email); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_telefono" class="form-label">
                        <i class="fas fa-phone me-1"></i>Teléfono
                    </label>
                    <input type="tel" class="form-control" id="edit_telefono" name="telefono" value="<?php echo htmlspecialchars($usuario->telefono); ?>">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_fecha_nacimiento" class="form-label">
                        <i class="fas fa-calendar me-1"></i>Fecha de Nacimiento
                    </label>
                    <input type="date" class="form-control" id="edit_fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $usuario->fecha_nacimiento; ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_genero" class="form-label">
                        <i class="fas fa-venus-mars me-1"></i>Género
                    </label>
                    <select class="form-control" id="edit_genero" name="genero">
                        <option value="">Seleccionar...</option>
                        <option value="Masculino" <?php echo ($usuario->genero == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                        <option value="Femenino" <?php echo ($usuario->genero == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                        <option value="Otro" <?php echo ($usuario->genero == 'Otro') ? 'selected' : ''; ?>>Otro</option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_ciudad" class="form-label">
                        <i class="fas fa-city me-1"></i>Ciudad
                    </label>
                    <input type="text" class="form-control" id="edit_ciudad" name="ciudad" value="<?php echo htmlspecialchars($usuario->ciudad); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_estado" class="form-label">
                        <i class="fas fa-toggle-on me-1"></i>Estado
                    </label>
                    <select class="form-control" id="edit_estado" name="estado" required>
                        <option value="activo" <?php echo ($usuario->estado == 'activo') ? 'selected' : ''; ?>>Activo</option>
                        <option value="inactivo" <?php echo ($usuario->estado == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="edit_direccion" class="form-label">
                    <i class="fas fa-map-marker-alt me-1"></i>Dirección
                </label>
                <textarea class="form-control" id="edit_direccion" name="direccion" rows="3"><?php echo htmlspecialchars($usuario->direccion); ?></textarea>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Guardar Cambios
                </button>
            </div>
        </form>
        
        <script>
            document.getElementById('formEditarUsuario').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch('ajax/actualizar_usuario.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('editarUsuarioModal')).hide();
                        location.reload();
                    } else {
                        alert('Error: ' + (data.message || 'Error al actualizar el usuario'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });
            });
        </script>
        <?php
    } else {
        echo '<p class="text-center text-muted">Usuario no encontrado.</p>';
    }
} else {
    echo '<p class="text-center text-muted">ID de usuario no especificado.</p>';
}
?>
