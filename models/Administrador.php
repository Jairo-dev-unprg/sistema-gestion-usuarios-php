<?php
require_once __DIR__ . '/../config/database.php';

class Administrador {
    private $conn;
    private $table_name = "administradores";
    
    public $id;
    public $usuario;
    public $password;
    public $nombre;
    public $email;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Autenticar administrador
    public function autenticar() {
        $query = "SELECT id, usuario, password, nombre, email FROM " . $this->table_name . " WHERE usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->usuario);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row && password_verify($this->password, $row['password'])) {
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }
}
?>
