<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $conn;
    private $table_name = "usuarios";
    
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $fecha_nacimiento;
    public $genero;
    public $direccion;
    public $ciudad;
    public $password;
    public $estado;
    public $fecha_registro;
    public $fecha_actualizacion;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Crear usuario
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre, apellido, email, telefono, fecha_nacimiento, genero, direccion, ciudad, password) 
                  VALUES (:nombre, :apellido, :email, :telefono, :fecha_nacimiento, :genero, :direccion, :ciudad, :password)";
        
        $stmt = $this->conn->prepare($query);
        
        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->fecha_nacimiento = htmlspecialchars(strip_tags($this->fecha_nacimiento));
        $this->genero = htmlspecialchars(strip_tags($this->genero));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->ciudad = htmlspecialchars(strip_tags($this->ciudad));
        
        // Hash de la contraseña
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        
        // Bind values
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":genero", $this->genero);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":ciudad", $this->ciudad);
        $stmt->bindParam(":password", $this->password);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Leer todos los usuarios
    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_registro DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // Leer un usuario por ID
    public function leerUno() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nombre = $row['nombre'];
            $this->apellido = $row['apellido'];
            $this->email = $row['email'];
            $this->telefono = $row['telefono'];
            $this->fecha_nacimiento = $row['fecha_nacimiento'];
            $this->genero = $row['genero'];
            $this->direccion = $row['direccion'];
            $this->ciudad = $row['ciudad'];
            $this->estado = $row['estado'];
            $this->fecha_registro = $row['fecha_registro'];
            $this->fecha_actualizacion = $row['fecha_actualizacion'];
            return true;
        }
        return false;
    }
    
    // Actualizar usuario
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre=:nombre, apellido=:apellido, email=:email, telefono=:telefono, 
                      fecha_nacimiento=:fecha_nacimiento, genero=:genero, direccion=:direccion, 
                      ciudad=:ciudad, estado=:estado 
                  WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);
        
        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->fecha_nacimiento = htmlspecialchars(strip_tags($this->fecha_nacimiento));
        $this->genero = htmlspecialchars(strip_tags($this->genero));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->ciudad = htmlspecialchars(strip_tags($this->ciudad));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Bind values
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":genero", $this->genero);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":ciudad", $this->ciudad);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id", $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Eliminar usuario
    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Cambiar estado del usuario
    public function cambiarEstado($nuevo_estado) {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":estado", $nuevo_estado);
        $stmt->bindParam(":id", $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Verificar si el email ya existe
    public function emailExiste() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
    
    // Validar datos
    public function validar() {
        $errores = array();
        
        if(empty($this->nombre)) {
            $errores[] = "El nombre es requerido";
        }
        
        if(empty($this->apellido)) {
            $errores[] = "El apellido es requerido";
        }
        
        if(empty($this->email)) {
            $errores[] = "El email es requerido";
        } elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El formato del email no es válido";
        }
        
        if(empty($this->password)) {
            $errores[] = "La contraseña es requerida";
        } elseif(strlen($this->password) < 6) {
            $errores[] = "La contraseña debe tener al menos 6 caracteres";
        }
        
        if(!empty($this->telefono) && !preg_match("/^[0-9\-\+\(\)\s]+$/", $this->telefono)) {
            $errores[] = "El formato del teléfono no es válido";
        }
        
        if(!empty($this->fecha_nacimiento)) {
            $fecha = DateTime::createFromFormat('Y-m-d', $this->fecha_nacimiento);
            if(!$fecha || $fecha->format('Y-m-d') !== $this->fecha_nacimiento) {
                $errores[] = "El formato de la fecha de nacimiento no es válido";
            }
        }
        
        return $errores;
    }
}
?>
