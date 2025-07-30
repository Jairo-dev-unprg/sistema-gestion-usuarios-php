# 🚀 Sistema Completo de Gestión de Usuarios

Un sistema robusto y profesional de registro y administración de usuarios desarrollado en **PHP 8.x** con **MySQL**, **Bootstrap 5** y validaciones completas tanto frontend como backend.

## 📋 Tabla de Contenidos

1. [Características del Sistema](#-características-del-sistema)
2. [Vista Previa](#-vista-previa)
3. [Requisitos Previos](#-requisitos-previos)
4. [Guía de Instalación Paso a Paso](#-guía-de-instalación-paso-a-paso)
5. [Configuración de la Base de Datos](#-configuración-de-la-base-de-datos)
6. [Estructura del Proyecto](#-estructura-del-proyecto)
7. [Credenciales de Acceso](#-credenciales-de-acceso)
8. [Guía de Uso](#-guía-de-uso)
9. [Funcionalidades Avanzadas](#-funcionalidades-avanzadas)
10. [Seguridad](#-seguridad)
11. [Personalización](#-personalización)
12. [Solución de Problemas](#-solución-de-problemas)

## ✨ Características del Sistema

### 🎯 Funcionalidades Principales
- ✅ **Registro de usuarios** con validaciones completas en tiempo real
- ✅ **Panel administrativo** con autenticación segura
- ✅ **CRUD completo** para gestión de usuarios
- ✅ **Sistema de estados** (activo/inactivo) para usuarios
- ✅ **Eliminación segura** con confirmación
- ✅ **Interfaz responsive** adaptable a todos los dispositivos
- ✅ **Búsqueda avanzada** con DataTables
- ✅ **Sistema de sesiones** para administradores
- ✅ **Modales interactivos** para operaciones CRUD
- ✅ **Estadísticas en tiempo real** del sistema

### 🔒 Validaciones y Seguridad
- **Frontend:** Validación en tiempo real con JavaScript
- **Backend:** Validación completa en PHP con PDO
- **Contraseñas:** Hash seguro con `password_hash()`
- **Datos:** Sanitización completa con `htmlspecialchars()`
- **Base de datos:** Consultas preparadas (prepared statements)
- **Sesiones:** Control de acceso administrativo
- **Email único:** Verificación de duplicados

### 🎨 Interfaz de Usuario
- **Framework CSS:** Bootstrap 5.3
- **Iconos:** Font Awesome 6.0
- **Tablas:** DataTables con búsqueda y paginación
- **Modales:** Operaciones sin recargar página
- **Responsive:** Compatible con móviles y tablets
- **UX/UI:** Diseño intuitivo y profesional

## 🖼️ Vista Previa

El sistema incluye:
- **Página de registro** con formulario completo
- **Panel administrativo** con dashboard profesional
- **Tabla de usuarios** con búsqueda y filtros
- **Modales** para ver, editar y confirmar operaciones

## 📋 Requisitos Previos

### Software Necesario
- **PHP 8.0 o superior** (recomendado 8.1+)
- **MySQL 5.7 o superior** (recomendado 8.0+)
- **Servidor web** (Apache, Nginx, o servidor local PHP)
- **Navegador web moderno** (Chrome, Firefox, Safari, Edge)

### Extensiones PHP Requeridas
- `PDO` - Para conexión a base de datos
- `PDO_MySQL` - Driver MySQL para PDO
- `mbstring` - Para manejo de cadenas multibyte
- `session` - Para manejo de sesiones (generalmente incluida)

## 🚀 Guía de Instalación Paso a Paso

### Opción A: Instalación con XAMPP (Recomendada para principiantes)

#### Paso 1: Descargar e Instalar XAMPP
1. **Descargar XAMPP** desde [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. **Instalar XAMPP** siguiendo el asistente de instalación
3. **Iniciar el Panel de Control** de XAMPP
4. **Activar los servicios:**
   - ✅ Apache
   - ✅ MySQL

#### Paso 2: Verificar PHP y Extensiones
1. Abrir terminal/cmd y ejecutar:
```bash
php --version
php -m | findstr pdo
```
2. Si necesitas habilitar extensiones, editar `php.ini`:
```ini
extension=pdo_mysql
extension=mbstring
```

#### Paso 3: Clonar o Descargar el Proyecto
```bash
# Opción 1: Clonar desde Git (si tienes el repositorio)
git clone [URL_DEL_REPOSITORIO] C:\xampp\htdocs\projecto

# Opción 2: Descargar y extraer manualmente
# Extraer en: C:\xampp\htdocs\projecto
```

#### Paso 4: Configurar la Base de Datos
1. **Abrir phpMyAdmin:** http://localhost/phpmyadmin
2. **Crear nueva base de datos:**
   - Nombre: `sistema_usuarios`
   - Collation: `utf8mb4_unicode_ci`
3. **Ejecutar el script SQL:**
   - Ir a la pestaña "SQL"
   - Copiar y pegar el contenido de `database/final_database.sql`
   - Hacer clic en "Continuar"

#### Paso 5: Configurar la Conexión
1. **Editar** `config/database.php` (normalmente no necesita cambios):
```php
private $host = "localhost";
private $db_name = "sistema_usuarios";  
private $username = "root";
private $password = "";  // Sin contraseña en XAMPP por defecto
```

#### Paso 6: Probar la Instalación
1. **Abrir navegador** y ir a: http://localhost/projecto/
2. **Verificar instalación:** http://localhost/projecto/verificar_instalacion.php
3. **Acceder al admin:** http://localhost/projecto/admin/login.php

### Opción B: Instalación con Servidor Local PHP

#### Paso 1: Instalar PHP y MySQL por Separado
1. **Instalar PHP 8.x** desde [php.net](https://www.php.net/downloads)
2. **Instalar MySQL** desde [mysql.com](https://dev.mysql.com/downloads/mysql/)
3. **Configurar variables de entorno** para PHP y MySQL

#### Paso 2: Preparar el Proyecto
```bash
# Navegar a tu directorio de trabajo
cd C:\Users\TuUsuario\Documents

# Crear carpeta del proyecto
mkdir projecto
cd projecto

# Aquí colocas todos los archivos del sistema
```

#### Paso 3: Configurar Base de Datos
```bash
# Conectar a MySQL
mysql -u root -p

# Crear base de datos
CREATE DATABASE sistema_usuarios;
USE sistema_usuarios;

# Ejecutar script (desde MySQL)
SOURCE C:/ruta/completa/al/archivo/database/final_database.sql;
```

#### Paso 4: Iniciar Servidor Local
```bash
cd C:\Users\TuUsuario\Documents\projecto
php -S localhost:8000
```

#### Paso 5: Verificar Funcionamiento
- **Sistema:** http://localhost:8000/
- **Admin:** http://localhost:8000/admin/login.php

## 🗄️ Configuración de la Base de Datos

### Script SQL Completo
El sistema incluye un script SQL completo en `database/final_database.sql` que contiene:

```sql
-- 📊 Estructura completa de tablas
CREATE TABLE usuarios (...);
CREATE TABLE administradores (...);

-- 👤 Administrador por defecto
INSERT INTO administradores VALUES ('admin', 'hash_password', ...);

-- 👥 10 usuarios de ejemplo
INSERT INTO usuarios VALUES (...);
```

### Tablas Creadas

#### 📋 Tabla `usuarios`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INT AUTO_INCREMENT | Identificador único |
| `nombre` | VARCHAR(100) | Nombre del usuario |
| `apellido` | VARCHAR(100) | Apellido del usuario |
| `email` | VARCHAR(150) UNIQUE | Email único |
| `telefono` | VARCHAR(20) | Teléfono (opcional) |
| `fecha_nacimiento` | DATE | Fecha de nacimiento |
| `genero` | ENUM | Masculino/Femenino/Otro |
| `direccion` | TEXT | Dirección completa |
| `ciudad` | VARCHAR(100) | Ciudad de residencia |
| `password` | VARCHAR(255) | Contraseña hasheada |
| `estado` | ENUM | activo/inactivo |
| `fecha_registro` | TIMESTAMP | Fecha de registro |
| `fecha_actualizacion` | TIMESTAMP | Última actualización |

#### 🔐 Tabla `administradores`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INT AUTO_INCREMENT | Identificador único |
| `usuario` | VARCHAR(50) UNIQUE | Nombre de usuario |
| `password` | VARCHAR(255) | Contraseña hasheada |
| `nombre` | VARCHAR(100) | Nombre completo |
| `email` | VARCHAR(150) | Email del admin |
| `fecha_creacion` | TIMESTAMP | Fecha de creación |

### Datos de Ejemplo Incluidos
- **1 Administrador** con credenciales de acceso
- **10 Usuarios de ejemplo** con datos realistas
- **2 Usuarios inactivos** para testing
- **Datos variados** de diferentes ciudades colombianas

## 📁 Estructura del Proyecto

```
projecto/
│
├── 📄 index.php                    # Página principal de registro
├── 📄 procesar_registro.php        # Procesamiento del registro
├── 📄 verificar_instalacion.php    # Verificador del sistema
├── 📄 generar_hash.php             # Generador de hashes
├── 📄 README.md                    # Esta documentación
│
├── 📂 config/
│   └── 📄 database.php             # Configuración de BD
│
├── 📂 models/
│   ├── 📄 Usuario.php              # Modelo de usuario (CRUD)
│   └── 📄 Administrador.php        # Modelo de administrador
│
├── 📂 admin/                       # Panel administrativo
│   ├── 📄 login.php               # Login de administradores
│   ├── 📄 dashboard.php           # Panel principal
│   ├── 📄 functions.php           # Funciones auxiliares
│   ├── 📄 autenticar.php          # Procesamiento de login
│   ├── 📄 logout.php              # Cerrar sesión
│   │
│   └── 📂 ajax/                   # Operaciones AJAX
│       ├── 📄 ver_usuario.php     # Ver detalles
│       ├── 📄 editar_usuario.php  # Formulario de edición
│       ├── 📄 actualizar_usuario.php # Actualizar datos
│       ├── 📄 cambiar_estado.php  # Activar/Desactivar
│       └── 📄 eliminar_usuario.php # Eliminar usuario
│
└── 📂 database/
    ├── 📄 final_database.sql       # Script SQL completo
    └── 📄 complete_database.sql    # Script alternativo
```

### 🔧 Descripción de Archivos Clave

#### Frontend (Usuario Final)
- **`index.php`**: Formulario de registro con validaciones en tiempo real
- **`procesar_registro.php`**: Procesamiento backend del registro

#### Backend (Administración)
- **`admin/login.php`**: Interfaz de login para administradores
- **`admin/dashboard.php`**: Panel principal con tabla de usuarios
- **`admin/ajax/`**: Operaciones CRUD sin recargar página

#### Configuración y Modelos
- **`config/database.php`**: Clase de conexión PDO reutilizable
- **`models/Usuario.php`**: Modelo completo con todas las operaciones
- **`models/Administrador.php`**: Autenticación de administradores

#### Base de Datos
- **`database/final_database.sql`**: Script completo actualizado
- **`verificar_instalacion.php`**: Verificador de configuración

## 🔑 Credenciales de Acceso

### 👨‍💼 Administrador Principal
```
🔐 Usuario: admin
🔐 Contraseña: admin123
📧 Email: admin@sistema.com
🌐 URL: http://localhost:8000/admin/login.php
```

### 👥 Usuarios de Ejemplo (Contraseña: admin123)
| Email | Nombre | Ciudad | Estado |
|-------|--------|--------|--------|
| `juan.perez@email.com` | Juan Carlos Pérez | Bogotá | ✅ Activo |
| `maria.gonzalez@email.com` | María Fernanda González | Medellín | ✅ Activo |
| `carlos.rodriguez@email.com` | Carlos Alberto Rodríguez | Cali | ❌ Inactivo |
| `ana.martinez@email.com` | Ana Lucía Martínez | Cartagena | ✅ Activo |
| `diego.hernandez@email.com` | Diego Fernando Hernández | Bogotá | ✅ Activo |
| `laura.vargas@email.com` | Laura Patricia Vargas | Medellín | ✅ Activo |
| `roberto.jimenez@email.com` | Roberto Jiménez | Cali | ❌ Inactivo |
| `sofia.ramirez@email.com` | Sofía Ramírez | Barranquilla | ✅ Activo |
| `miguel.ortega@email.com` | Miguel Ángel Ortega | Bogotá | ✅ Activo |
| `valentina.cruz@email.com` | Valentina Cruz | Bucaramanga | ✅ Activo |

### 📊 Estadísticas Iniciales
- **Total usuarios:** 10
- **Usuarios activos:** 8
- **Usuarios inactivos:** 2
- **Ciudades:** 5 (Bogotá, Medellín, Cali, Cartagena, Barranquilla, Bucaramanga)

## 📖 Guía de Uso

### 👨‍💻 Para Desarrolladores/Administradores

#### 1. 🔐 Acceso al Panel Administrativo
```
1. Abrir: http://localhost:8000/admin/login.php
2. Introducir credenciales: admin / admin123
3. Hacer clic en "Iniciar Sesión"
4. Serás redirigido al dashboard principal
```

#### 2. 🎛️ Dashboard Principal
- **Estadísticas:** Vista general del sistema
- **Tabla de usuarios:** Lista completa con búsqueda
- **Acciones rápidas:** Ver, editar, cambiar estado, eliminar
- **Filtros:** Por estado, ciudad, fecha de registro

#### 3. 👤 Gestión de Usuarios Individual

##### Ver Detalles
```
1. Clic en el botón "👁️ Ver" de cualquier usuario
2. Se abre modal con información completa
3. Incluye todos los datos del perfil
```

##### Editar Usuario
```
1. Clic en "✏️ Editar" del usuario deseado
2. Se abre formulario de edición en modal
3. Modificar los campos necesarios
4. Guardar cambios con validación
```

##### Cambiar Estado
```
1. Clic en "🔄 Estado" del usuario
2. Confirmar la acción en el modal
3. El estado cambia automáticamente
4. Se actualiza la tabla en tiempo real
```

##### Eliminar Usuario
```
1. Clic en "🗑️ Eliminar" del usuario
2. Confirmar eliminación (IRREVERSIBLE)
3. El usuario se elimina permanentemente
```

### 👥 Para Usuarios Finales

#### 1. 📝 Registro de Nuevo Usuario
```
1. Abrir: http://localhost:8000/
2. Completar el formulario de registro
3. Campos obligatorios marcados con *
4. Validación en tiempo real
5. Confirmar registro
```

#### 2. ✅ Validaciones del Formulario
- **Nombre/Apellido:** Mínimo 2 caracteres
- **Email:** Formato válido y único en el sistema
- **Contraseña:** Mínimo 6 caracteres
- **Teléfono:** Formato válido (opcional)
- **Fecha:** Formato DD/MM/AAAA válido

### 🔧 Operaciones Técnicas

#### Verificar Estado del Sistema
```
URL: http://localhost:8000/verificar_instalacion.php
```
Esta página verifica:
- ✅ Conexión a base de datos
- ✅ Extensiones PHP necesarias
- ✅ Permisos de archivos
- ✅ Estructura de tablas
- ✅ Datos de ejemplo

#### Generar Nuevos Hashes
```
URL: http://localhost:8000/generar_hash.php
```
Utilidad para:
- 🔐 Generar hash de contraseñas
- 🧪 Verificar hashes existentes
- 🔄 Actualizar credenciales

## 🚀 Funcionalidades Avanzadas

### 🔍 Búsqueda y Filtrado Avanzado
- **DataTables:** Búsqueda en tiempo real en todos los campos
- **Filtros por estado:** Activos, inactivos, todos
- **Paginación:** Configurable (10, 25, 50, 100 registros)
- **Ordenamiento:** Por cualquier columna (clic en encabezados)

### 📊 Estadísticas del Dashboard
```php
// Métricas mostradas en el panel
- Total de usuarios registrados
- Usuarios activos vs inactivos
- Registros del mes actual
- Distribución por ciudades
```

### 🔄 Operaciones AJAX
Todas las operaciones se realizan sin recargar la página:
- ✅ Ver detalles de usuario
- ✅ Editar información
- ✅ Cambiar estados
- ✅ Eliminar usuarios
- ✅ Actualizar estadísticas

### 📱 Diseño Responsive
- **Mobile First:** Optimizado para dispositivos móviles
- **Breakpoints:** Adaptación automática a diferentes tamaños
- **Touch Friendly:** Botones y elementos táctiles optimizados

## 🔒 Seguridad

### 🛡️ Medidas de Seguridad Implementadas

#### Autenticación y Autorización
```php
// Sistema de sesiones para administradores
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
```

#### Protección de Contraseñas
```php
// Hash seguro de contraseñas
$hash = password_hash($password, PASSWORD_DEFAULT);

// Verificación de contraseñas
password_verify($password_input, $hash_stored);
```

#### Sanitización de Datos
```php
// Escape de caracteres especiales
$dato_limpio = htmlspecialchars($dato_input, ENT_QUOTES, 'UTF-8');

// Validación de email
filter_var($email, FILTER_VALIDATE_EMAIL);
```

#### Consultas Preparadas
```php
// Prevención de inyección SQL
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
```

### 🔐 Recomendaciones de Seguridad Adicionales

#### Para Producción
1. **Cambiar credenciales por defecto** del administrador
2. **Usar HTTPS** para todas las comunicaciones
3. **Configurar límites de intentos** de login
4. **Implementar CAPTCHA** en formularios públicos
5. **Configurar backups automáticos** de la base de datos
6. **Actualizar PHP y MySQL** regularmente

#### Configuración del Servidor
```apache
# .htaccess para Apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Proteger archivos sensibles
<Files "config/database.php">
    Order Deny,Allow
    Deny from all
</Files>
```

## 🎨 Personalización

### 🎯 Modificar Estilos y Colores

#### Cambiar Tema de Colores
```css
/* En el <style> de cada archivo */
:root {
    --primary-color: #007bff;    /* Azul principal */
    --success-color: #28a745;    /* Verde éxito */
    --warning-color: #ffc107;    /* Amarillo advertencia */
    --danger-color: #dc3545;     /* Rojo peligro */
    --dark-color: #343a40;       /* Gris oscuro */
}
```

#### Personalizar Bootstrap
```html
<!-- Cambiar tema de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/flatly/bootstrap.min.css" rel="stylesheet">
```

### 📝 Agregar Nuevos Campos

#### 1. Modificar Base de Datos
```sql
ALTER TABLE usuarios ADD COLUMN nuevo_campo VARCHAR(100) AFTER ciudad;
```

#### 2. Actualizar Modelo Usuario
```php
// En models/Usuario.php
public function crear($datos) {
    $sql = "INSERT INTO usuarios (nombre, apellido, email, nuevo_campo, ...) 
            VALUES (?, ?, ?, ?, ...)";
    // ... resto del código
}
```

#### 3. Actualizar Formularios
```html
<!-- En index.php -->
<div class="mb-3">
    <label for="nuevo_campo" class="form-label">Nuevo Campo *</label>
    <input type="text" class="form-control" id="nuevo_campo" name="nuevo_campo" required>
</div>
```

#### 4. Actualizar Validaciones
```javascript
// Agregar validación JavaScript
document.getElementById('nuevo_campo').addEventListener('input', function() {
    // Lógica de validación
});
```

### 📧 Configurar Envío de Emails

#### Integrar PHPMailer
```php
// Instalar PHPMailer
composer require phpmailer/phpmailer

// En models/Usuario.php
use PHPMailer\PHPMailer\PHPMailer;

public function enviarConfirmacion($email, $nombre) {
    $mail = new PHPMailer(true);
    // Configuración SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tu_email@gmail.com';
    $mail->Password = 'tu_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_TLS;
    $mail->Port = 587;
    
    // Contenido del email
    $mail->setFrom('tu_email@gmail.com', 'Sistema de Usuarios');
    $mail->addAddress($email, $nombre);
    $mail->Subject = 'Bienvenido al Sistema';
    $mail->Body = "Hola $nombre, tu registro ha sido exitoso.";
    
    return $mail->send();
}
```

### 🔧 Configuraciones Avanzadas

#### Límites y Paginación
```php
// En admin/dashboard.php - Configurar DataTables
"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
"pageLength": 25,  // Registros por página por defecto
"stateSave": true, // Guardar estado de filtros
```

#### Validaciones Personalizadas
```javascript
// Validación personalizada de contraseña
function validarContrasena(password) {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return regex.test(password);
}
```

## 🛠️ Solución de Problemas

### ❌ Problemas Comunes y Soluciones

#### 1. Error de Conexión a Base de Datos
```
Error: SQLSTATE[HY000] [1045] Access denied for user
```
**Solución:**
1. Verificar credenciales en `config/database.php`
2. Asegurar que MySQL esté ejecutándose
3. Verificar que la base de datos `sistema_usuarios` existe

```bash
# Verificar estado de MySQL
# Windows (XAMPP):
C:\xampp\mysql\bin\mysql.exe -u root -p

# Linux/Mac:
sudo systemctl status mysql
mysql -u root -p
```

#### 2. Extensiones PHP Faltantes
```
Error: Call to undefined function PDO::__construct()
```
**Solución:**
```bash
# Verificar extensiones instaladas
php -m | grep -i pdo

# Habilitar en php.ini
extension=pdo_mysql
extension=mbstring
```

#### 3. Errores de Permisos
```
Error: Permission denied to write
```
**Solución:**
```bash
# Windows (ejecutar como administrador)
icacls "C:\xampp\htdocs\projecto" /grant Users:F

# Linux/Mac
chmod -R 755 /var/www/html/projecto
chown -R www-data:www-data /var/www/html/projecto
```

#### 4. Problemas con el Hash de Contraseñas
```
Error: Login fallido con credenciales correctas
```
**Solución:**
1. Usar `generar_hash.php` para crear nuevo hash
2. Actualizar base de datos:
```sql
UPDATE administradores 
SET password = '$2y$12$NuevoHashAqui...' 
WHERE usuario = 'admin';
```

#### 5. Error 500 - Internal Server Error
**Causas comunes:**
- Errores de sintaxis PHP
- Archivos `.htaccess` mal configurados
- Permisos insuficientes

**Solución:**
```bash
# Verificar logs de error
# XAMPP:
C:\xampp\apache\logs\error.log

# Linux:
tail -f /var/log/apache2/error.log
```

#### 6. Problemas con DataTables
```
Error: DataTables warning: table id=tablaUsuarios
```
**Solución:**
1. Verificar que jQuery se carga antes que DataTables
2. Comprobar estructura HTML de la tabla
3. Verificar conexión a CDN

### 🔍 Herramientas de Debugging

#### Verificador de Instalación
```
URL: http://localhost:8000/verificar_instalacion.php
```
Este archivo verifica automáticamente:
- ✅ Conexión a base de datos
- ✅ Extensiones PHP
- ✅ Estructura de tablas
- ✅ Datos de ejemplo

#### Logs Personalizados
```php
// Agregar logging personalizado
function log_error($message) {
    $log = date('Y-m-d H:i:s') . " - " . $message . PHP_EOL;
    file_put_contents('logs/sistema.log', $log, FILE_APPEND);
}
```

### 📞 Obtener Ayuda

#### Pasos para Reportar Problemas
1. **Verificar requisitos** del sistema
2. **Revisar logs** de error (Apache/PHP)
3. **Usar verificador** de instalación
4. **Buscar en issues** existentes
5. **Crear issue detallado** con:
   - Versión de PHP
   - Versión de MySQL
   - Sistema operativo
   - Mensaje de error completo
   - Pasos para reproducir

#### Recursos Adicionales
- **Documentación PHP:** [php.net](https://www.php.net/manual/)
- **Documentación MySQL:** [dev.mysql.com](https://dev.mysql.com/doc/)
- **Bootstrap 5:** [getbootstrap.com](https://getbootstrap.com/docs/5.3/)
- **DataTables:** [datatables.net](https://datatables.net/manual/)

## 🤝 Contribución

### 🚀 Cómo Contribuir al Proyecto

#### Preparar el Entorno de Desarrollo
```bash
# 1. Fork del repositorio en GitHub
# 2. Clonar tu fork
git clone https://github.com/tu-usuario/sistema-usuarios.git
cd sistema-usuarios

# 3. Configurar upstream
git remote add upstream https://github.com/proyecto-original/sistema-usuarios.git

# 4. Crear rama para nueva funcionalidad
git checkout -b feature/nueva-funcionalidad
```

#### Desarrollo de Funcionalidades
1. **Seguir estándares de código:**
   - PSR-12 para PHP
   - Comentarios en español
   - Nombres de variables descriptivos
   - Validaciones completas

2. **Testing de cambios:**
   - Probar en diferentes navegadores
   - Verificar responsive design
   - Validar funcionamiento CRUD
   - Comprobar seguridad

3. **Documentar cambios:**
   - Actualizar README.md si es necesario
   - Comentar código nuevo
   - Incluir ejemplos de uso

#### Enviar Contribución
```bash
# 1. Commit de cambios
git add .
git commit -m "feat: agregar nueva funcionalidad de exportación"

# 2. Push a tu fork
git push origin feature/nueva-funcionalidad

# 3. Crear Pull Request en GitHub
# 4. Describir cambios y funcionalidades
```

### 🎯 Áreas de Contribución

#### 🔧 Mejoras Técnicas
- Optimización de consultas SQL
- Implementación de cache
- Mejoras de seguridad
- Optimización de rendimiento

#### 🎨 Mejoras de UI/UX
- Nuevos temas visuales
- Componentes adicionales
- Mejoras de accesibilidad
- Animaciones y transiciones

#### 📱 Funcionalidades Nuevas
- Sistema de roles y permisos
- Exportación a Excel/PDF
- Sistema de notificaciones
- API REST
- Integración con OAuth
- Sistema de auditoría

#### 📖 Documentación
- Tutoriales adicionales
- Casos de uso específicos
- Guías de deployment
- Documentación de API

### 🏷️ Convenciones de Commits
```bash
# Tipos de commit
feat:     Nueva funcionalidad
fix:      Corrección de bug
docs:     Cambios en documentación
style:    Cambios de formato (no afectan funcionalidad)
refactor: Refactorización de código
test:     Agregar o modificar tests
chore:    Cambios en herramientas, configuración

# Ejemplos
git commit -m "feat: agregar sistema de exportación PDF"
git commit -m "fix: corregir validación de email duplicado"
git commit -m "docs: actualizar guía de instalación"
```

## 📄 Licencia

### MIT License

```
Copyright (c) 2025 Sistema de Gestión de Usuarios

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

### 📋 Términos de Uso
- ✅ **Uso comercial** permitido
- ✅ **Modificación** permitida
- ✅ **Distribución** permitida
- ✅ **Uso privado** permitido
- ⚠️ **Sin garantía** proporcionada
- ⚠️ **Sin responsabilidad** del autor

## 📞 Soporte y Ayuda

### 🆘 Obtener Ayuda Rápida

#### 1. 🔍 Autodiagnóstico
```bash
# Verificar instalación
http://localhost:8000/verificar_instalacion.php

# Verificar logs
tail -f C:\xampp\apache\logs\error.log
```

#### 2. 📚 Consultar Documentación
- Leer este README completo
- Revisar comentarios en el código
- Consultar documentación oficial de PHP/MySQL

#### 3. 🔧 Usar Herramientas de Debug
- Activar `display_errors` en desarrollo
- Usar `var_dump()` para debug
- Verificar Network tab en DevTools

#### 4. 🎯 Buscar Problemas Similares
- Buscar en issues del repositorio
- Consultar Stack Overflow
- Revisar foros de PHP/MySQL

### 📝 Crear Reporte de Issue

#### Información Requerida
```markdown
**Descripción del Problema:**
Descripción clara y concisa del problema.

**Pasos para Reproducir:**
1. Ir a '...'
2. Hacer clic en '...'
3. Llenar campo '...'
4. Ver error

**Comportamiento Esperado:**
Descripción de lo que debería pasar.

**Comportamiento Actual:**
Descripción de lo que está pasando.

**Entorno:**
- OS: Windows 10 / Ubuntu 20.04 / macOS Big Sur
- PHP: 8.1.0
- MySQL: 8.0.25
- Servidor: XAMPP 3.3.0 / Apache 2.4
- Navegador: Chrome 96 / Firefox 95

**Información Adicional:**
- Logs de error
- Screenshots si aplica
- Código relevante
```

### 🌐 Recursos Adicionales

#### 📖 Documentación Oficial
- **PHP:** [https://www.php.net/docs.php](https://www.php.net/docs.php)
- **MySQL:** [https://dev.mysql.com/doc/](https://dev.mysql.com/doc/)
- **Bootstrap:** [https://getbootstrap.com/docs/](https://getbootstrap.com/docs/)
- **DataTables:** [https://datatables.net/manual/](https://datatables.net/manual/)

#### 🎓 Tutoriales Recomendados
- **PHP PDO:** [https://phpdelusions.net/pdo](https://phpdelusions.net/pdo)
- **Security:** [https://owasp.org/www-project-top-ten/](https://owasp.org/www-project-top-ten/)
- **MySQL:** [https://dev.mysql.com/doc/mysql-tutorial-excerpt/](https://dev.mysql.com/doc/mysql-tutorial-excerpt/)

#### 🤝 Comunidad
- **Stack Overflow:** [Etiqueta: php](https://stackoverflow.com/questions/tagged/php)
- **Reddit:** [r/PHP](https://www.reddit.com/r/PHP/)
- **Discord:** Comunidades de desarrollo PHP

### ⚡ Respuesta Rápida

#### Para Soporte Inmediato
1. **Verificar FAQ** en este README
2. **Usar verificador** de instalación
3. **Revisar issues** cerrados similares
4. **Consultar logs** de error detallados

#### Tiempo de Respuesta Estimado
- 🟢 **Issues críticos:** 24-48 horas
- 🟡 **Features/mejoras:** 3-7 días
- 🔵 **Documentación:** 1-2 semanas

---

## 📊 Información del Proyecto

### 📈 Estadísticas
- **Versión:** 1.0.0
- **Última actualización:** Julio 30, 2025
- **Lenguaje principal:** PHP (85%)
- **Base de datos:** MySQL
- **Frontend:** Bootstrap 5 + JavaScript
- **Licencia:** MIT

### 🏆 Características Destacadas
- ✅ **100% Responsive** - Compatible con todos los dispositivos
- ✅ **Seguridad Avanzada** - Hash de contraseñas, sanitización completa
- ✅ **UX Profesional** - Interfaz intuitiva y moderna
- ✅ **Performance** - Optimizado para velocidad
- ✅ **Escalable** - Arquitectura modular y extensible

### 🎯 Roadmap Futuro
- 🔄 **v1.1:** Sistema de roles y permisos
- 📊 **v1.2:** Dashboard con gráficos avanzados
- 🔗 **v1.3:** API REST completa
- 📱 **v1.4:** Aplicación móvil companion
- 🌐 **v1.5:** Multi-idioma (i18n)

---

**¡Gracias por usar nuestro Sistema de Gestión de Usuarios!** 🎉

Si este proyecto te ha sido útil, considera:
- ⭐ Darle una estrella en GitHub
- 🐛 Reportar bugs que encuentres
- 💡 Sugerir nuevas funcionalidades
- 🤝 Contribuir con código
- 📢 Compartir con otros desarrolladores

**Happy Coding!** 👨‍💻👩‍💻
