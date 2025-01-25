<?php
require_once '../config/database.php';
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'AuthController';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';
require_once "../app/controllers/{$controller}.php";
$controllerInstance = new $controller();
$controllerInstance->$action();