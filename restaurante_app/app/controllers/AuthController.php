<?php
require_once "../app/models/Usuario.php";
class AuthController {
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = new Usuario();
            $auth = $usuario->autenticar($_POST['correo'], $_POST['password']);
            if ($auth) {
                session_start();
                $_SESSION['usuario'] = $auth;
                $_SESSION['id_usuario'] = $usuario->getId();

                if($usuario->isAdmin()){ //Si es Admin entonces te llevara a la administracion de mesas, si no te lleva a la pagina de reservas
                    header("Location:../public/index.php?controller=MesaController&action=listar");
                }else{
                    header("Location:../public/index.php?controller=ReservaController&action=listar");
                }
            } else {
                echo "Credenciales inválidas.";
            }
        } else {
            require "../app/views/auth/login.php";
        }
    }
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = new Usuario();
            $usuario->registrar($_POST['nombre'], $_POST['correo'], $_POST['password']);
            header("Location:../public/index.php?controller=AuthController&action=login");
        } else {
            require "../app/views/auth/register.php";
        }
    }
}