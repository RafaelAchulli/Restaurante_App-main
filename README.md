# Restaurante_App

Sistema de reservas y administracion de mesas para un restaurante en PHP

## Características
*Inicio de Sesion y Registro de Usuario*
*Creacion de Reservas y Administracion de Mesas (Este ultimo disponible solo si el usuario tiene permiso de administrador)*

## Requisitos
-XAMPP (Modulos Apache y MySql Habilitados)

## Instalacion
(Inicia XAMPP y los modulos Apache y MySql)
1.Crea las tablas con las siguientes sentencias SQL:
CREATE DATABASE restaurante;
USE restaurante;
CREATE TABLE usuarios (
 id_usuario INT AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(100) NOT NULL,
 correo VARCHAR(100) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 rol ENUM('admin', 'cliente') DEFAULT 'cliente'
);
CREATE TABLE mesas (
 id_mesa INT AUTO_INCREMENT PRIMARY KEY,
 numero VARCHAR(10) NOT NULL UNIQUE,
 capacidad INT NOT NULL
);
CREATE TABLE reservas (
 id_reserva INT AUTO_INCREMENT PRIMARY KEY,
 id_usuario INT NOT NULL,
 id_mesa INT NOT NULL,
 fecha DATE NOT NULL,
 hora TIME NOT NULL,
 FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
 FOREIGN KEY (id_mesa) REFERENCES mesas(id_mesa)
);

2.Coloca la carpeta "restaurante_app" dentro del directorio htdocs en la ruta de xampp
3.Ahora puedes usar el programa accediendo a http://localhost/restaurante_app/public/
