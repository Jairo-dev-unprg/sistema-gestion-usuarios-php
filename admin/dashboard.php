<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';

verificarAdmin();

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

// Obtener todos los usuarios
$stmt = $usuario->leer();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Contar usuarios por estado
$total_usuarios = count($usuarios);
$usuarios_activos = count(array_filter($usuarios, function($u) { return $u['estado'] == 'activo'; }));
$usuarios_inactivos = $total_usuarios - $usuarios_activos;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Sistema de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 0;
        }
        .sidebar .nav-link {
            color: white;
            border-radius: 5px;
            margin: 2px 10px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: none;
            margin-bottom: 20px;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        .stat-card {
            text-align: center;
            padding: 20px;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }
        .btn-action {
            margin: 2px;
            padding: 5px 10px;
            font-size: 0.8rem;
        }
        .table th {
            background-color: #f8f9fa;
            border-top: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar">
                <div class="position-sticky pt-3">
                    <div class="text-center text-white mb-4">
                        <i class="fas fa-user-shield fa-3x mb-2"></i>
                        <h5>Panel Admin</h5>
                        <small>Bienvenido, <?php echo $_SESSION['admin_nombre']; ?></small>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#usuariosSection">
                                <i class="fas fa-users me-2"></i>Gestión de Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>Ver Página de Registro
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button onclick="location.reload()" class="btn btn-outline-secondary">
                                <i class="fas fa-sync-alt"></i> Actualizar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body stat-card">
                                <i class="fas fa-users fa-2x"></i>
                                <div class="stat-number"><?php echo $total_usuarios; ?></div>
                                <div>Total Usuarios</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body stat-card">
                                <i class="fas fa-user-check fa-2x"></i>
                                <div class="stat-number"><?php echo $usuarios_activos; ?></div>
                                <div>Usuarios Activos</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body stat-card">
                                <i class="fas fa-user-times fa-2x"></i>
                                <div class="stat-number"><?php echo $usuarios_inactivos; ?></div>
                                <div>Usuarios Inactivos</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gestión de Usuarios -->
                <div id="usuariosSection">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-users me-2"></i>Gestión de Usuarios</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="usuariosTable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Ciudad</th>
                                            <th>Estado</th>
                                            <th>Fecha Registro</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($usuarios as $u): ?>
                                        <tr>
                                            <td><?php echo $u['id']; ?></td>
                                            <td><?php echo htmlspecialchars($u['nombre'] . ' ' . $u['apellido']); ?></td>
                                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                                            <td><?php echo htmlspecialchars($u['telefono']); ?></td>
                                            <td><?php echo htmlspecialchars($u['ciudad']); ?></td>
                                            <td><?php echo obtenerBadgeEstado($u['estado']); ?></td>
                                            <td><?php echo formatearFecha($u['fecha_registro']); ?></td>
                                            <td>
                                                <button class="btn btn-info btn-action" onclick="verUsuario(<?php echo $u['id']; ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-warning btn-action" onclick="editarUsuario(<?php echo $u['id']; ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <?php if($u['estado'] == 'activo'): ?>
                                                <button class="btn btn-secondary btn-action" onclick="cambiarEstado(<?php echo $u['id']; ?>, 'inactivo')">
                                                    <i class="fas fa-user-slash"></i>
                                                </button>
                                                <?php else: ?>
                                                <button class="btn btn-success btn-action" onclick="cambiarEstado(<?php echo $u['id']; ?>, 'activo')">
                                                    <i class="fas fa-user-check"></i>
                                                </button>
                                                <?php endif; ?>
                                                <button class="btn btn-danger btn-action" onclick="eliminarUsuario(<?php echo $u['id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Ver Usuario -->
    <div class="modal fade" id="verUsuarioModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user me-2"></i>Detalles del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detallesUsuario">
                    <!-- Contenido cargado dinámicamente -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Usuario -->
    <div class="modal fade" id="editarUsuarioModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="formularioEditar">
                    <!-- Formulario cargado dinámicamente -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // Inicializar DataTable
        $(document).ready(function() {
            $('#usuariosTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                },
                pageLength: 10,
                order: [[0, 'desc']]
            });
        });

        // Ver detalles del usuario
        function verUsuario(id) {
            fetch('ajax/ver_usuario.php?id=' + id)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('detallesUsuario').innerHTML = data;
                    new bootstrap.Modal(document.getElementById('verUsuarioModal')).show();
                });
        }

        // Editar usuario
        function editarUsuario(id) {
            fetch('ajax/editar_usuario.php?id=' + id)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('formularioEditar').innerHTML = data;
                    new bootstrap.Modal(document.getElementById('editarUsuarioModal')).show();
                });
        }

        // Cambiar estado del usuario
        function cambiarEstado(id, estado) {
            if(confirm('¿Está seguro de cambiar el estado del usuario?')) {
                fetch('ajax/cambiar_estado.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id + '&estado=' + estado
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        location.reload();
                    } else {
                        alert('Error al cambiar el estado del usuario');
                    }
                });
            }
        }

        // Eliminar usuario
        function eliminarUsuario(id) {
            if(confirm('¿Está seguro de eliminar este usuario? Esta acción no se puede deshacer.')) {
                fetch('ajax/eliminar_usuario.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        location.reload();
                    } else {
                        alert('Error al eliminar el usuario');
                    }
                });
            }
        }
    </script>
</body>
</html>
