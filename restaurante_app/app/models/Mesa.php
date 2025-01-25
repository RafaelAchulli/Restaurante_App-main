<?php
require_once "../config/database.php";
class Mesa {
    private $conn;
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    public function crear($numero, $capacidad) {
        session_start();

        $query = "SELECT * FROM mesas WHERE numero = :numero";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':numero', $numero);
        $stmt->execute();

        if ($stmt->rowCount() > 0) { //Verificacion de numero
            $_SESSION['alerta'] = "No puedes crear otra mesa con el mismo numero.";
            return;
        }

        $query = "INSERT INTO mesas (numero, capacidad) VALUES (:numero, :capacidad)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':capacidad', $capacidad);
        return $stmt->execute();
    }
    public function listar() {
        $query = "SELECT * FROM mesas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($numero) {
        session_start();
    
        $query = "DELETE FROM mesas WHERE numero = :numero";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':numero', $numero);
        return $stmt->execute();
    }
    
}