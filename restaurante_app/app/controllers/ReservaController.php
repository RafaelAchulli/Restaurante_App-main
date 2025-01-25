<?php
require_once "../app/models/Reserva.php";
require_once "../app/models/Mesa.php";

class ReservaController { //Metodos de la clase ReservaController, los usan los clientes
    public function listar() {
        $reservaModel = new Reserva();
        $mesaModel = new Mesa();
        $reservas = $reservaModel->listar();
        $mesas = $mesaModel->listar();
        require_once "../app/views/reservas/listar.php";
    }

    public function reservar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $reserva = new Reserva();
            $reserva->reservar($_POST['id_mesa'], $_POST['fecha'], $_POST['hora']);
            header("Location:../public/index.php?controller=ReservaController&action=listar");
        } else {
            require "../app/views/reservas/listar.php";
        }
    }
}