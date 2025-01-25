<?php
require_once "../config/database.php";
class Reserva {
    private $conn;
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    public function reservar($id_mesa, $fecha, $hora) {
        session_start();

        $query = "SELECT * FROM reservas WHERE id_mesa = :id_mesa AND fecha = :fecha AND hora = :hora";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_mesa', $id_mesa);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora);
        $stmt->execute();

        if ($stmt->rowCount() > 0) { //Verificacion de horarios, no puedes crear una reservacion a la misma hora de otra
            $_SESSION['alerta'] = "La mesa ya está reservada a esa hora. Por favor, Seleccione otra.";
            return;
        }

        $query = "INSERT INTO reservas (id_usuario, id_mesa, fecha, hora) VALUES (:id_usuario, :id_mesa, :fecha, :hora)";
        $stmt = $this->conn->prepare($query);
        $id_usuario = $_SESSION['id_usuario'];
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_mesa', $id_mesa);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora);
        return $stmt->execute();
    }

    public function listar() {
        $query = "
        SELECT reservas.id_reserva, reservas.id_usuario, mesas.numero AS numero_mesa, reservas.fecha, reservas.hora
        FROM reservas
        JOIN mesas ON reservas.id_mesa = mesas.id_mesa
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}