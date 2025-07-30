<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .card {
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 10px;
            border: none;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-users me-2"></i>Sistema de Usuarios
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Registro</a>
                <a class="nav-link" href="admin/login.php">Administración</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4><i class="fas fa-user-plus me-2"></i>Registro de Usuario</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_GET['success']) && $_GET['success'] == 1) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>¡Usuario registrado exitosamente!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                  </div>';
                        }
                        
                        if(isset($_GET['error'])) {
                            $errors = explode('|', urldecode($_GET['error']));
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Error(es) encontrado(s):</strong><br>';
                            foreach($errors as $error) {
                                echo '• ' . htmlspecialchars($error) . '<br>';
                            }
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                  </div>';
                        }
                        ?>
                        
                        <form action="procesar_registro.php" method="POST" id="registroForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">
                                        <i class="fas fa-user me-1"></i>Nombre *
                                    </label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="apellido" class="form-label">
                                        <i class="fas fa-user me-1"></i>Apellido *
                                    </label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-1"></i>Email *
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">
                                        <i class="fas fa-phone me-1"></i>Teléfono
                                    </label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_nacimiento" class="form-label">
                                        <i class="fas fa-calendar me-1"></i>Fecha de Nacimiento
                                    </label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="genero" class="form-label">
                                        <i class="fas fa-venus-mars me-1"></i>Género
                                    </label>
                                    <select class="form-control" id="genero" name="genero">
                                        <option value="">Seleccionar...</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ciudad" class="form-label">
                                        <i class="fas fa-city me-1"></i>Ciudad
                                    </label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-1"></i>Contraseña *
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password" required minlength="6">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="direccion" class="form-label">
                                    <i class="fas fa-map-marker-alt me-1"></i>Dirección
                                </label>
                                <textarea class="form-control" id="direccion" name="direccion" rows="3"></textarea>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>Registrar Usuario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación del formulario en el frontend
        document.getElementById('registroForm').addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = ['nombre', 'apellido', 'email', 'password'];
            
            requiredFields.forEach(function(field) {
                const input = document.getElementById(field);
                if(!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            // Validar email
            const email = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(email.value && !emailRegex.test(email.value)) {
                email.classList.add('is-invalid');
                isValid = false;
            }
            
            // Validar contraseña
            const password = document.getElementById('password');
            if(password.value && password.value.length < 6) {
                password.classList.add('is-invalid');
                isValid = false;
            }
            
            if(!isValid) {
                e.preventDefault();
                alert('Por favor, complete todos los campos requeridos correctamente.');
            }
        });
        
        // Limpiar clases de validación al escribir
        document.querySelectorAll('input').forEach(function(input) {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });
    </script>
</body>
</html>
