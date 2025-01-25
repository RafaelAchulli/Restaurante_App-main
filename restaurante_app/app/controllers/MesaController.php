<?php
require_once "../app/models/Mesa.php";
class MesaController { //Clase MesaController donde se manejan los metodos para el administrador
    public function listar() {
        $mesaModel = new Mesa();
        $mesas = $mesaModel->listar();
        require_once "../app/views/mesas/listar.php";
    }

    public function crear() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mesa = new Mesa();
            $mesa->crear($_POST['numero'], $_POST['capacidad']);
            header("Location:../public/index.php?controller=MesaController&action=listar");
        } else {
            require "../app/views/mesas/listar.php";
        }
    }

    public function eliminar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mesa = new Mesa();
            $mesa->eliminar($_POST['numero']);
            header("Location:../public/index.php?controller=MesaController&action=listar");
        } else {
            require "../app/views/mesas/listar.php";
        }
    }
}