<?php
require_once "../config/database.php";
class Usuario {
    private $conn;
    private $id_usuario;
    private $isAdmin = false;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    public function registrar($nombre, $correo, $password) {
        $query = "INSERT INTO usuarios (nombre, correo, password) VALUES (:nombre, :correo, :password)";
        $stmt = $this->conn->prepare($query);
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':password', $passwordHash);
        return $stmt->execute();
    }
    public function autenticar($correo, $password) {
        $query = "SELECT * FROM usuarios WHERE correo = :correo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($password, $usuario['password'])) {
            $this->id_usuario = $usuario['id_usuario'];
            $this->isAdmin = ($usuario['rol'] === "admin");
            return $usuario;
        }
        return false;
    }

    public function getId() {return $this->id_usuario;}
    public function isAdmin() {return $this->isAdmin;}
}