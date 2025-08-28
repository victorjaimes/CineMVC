# CineMVC
API de Películas (cineMVC)

Stack Tecnológico
-Lenguaje: PHP 8.1+
-Base de datos: MySQL 8.0+
-Servidor: Apache
-Dependencias: mysqli
-Herramientas: Postman (para pruebas de API)

Cómo correr el proyecto

git clone https://github.com/tuusuario/cineMVC.git
cd cineMVC

Levanta el proyecto en tu servidor local:
http://localhost/cineMVC/APIS/peliculas.php

Variables de Entorno

$host = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'cine';
$conn;

Migraciones/seed

CREATE DATABASE cine;

USE cine;

CREATE TABLE peliculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) UNIQUE NOT NULL,
    sinopsis TEXT,
    duracionMin INT NOT NULL,
    clasificacion VARCHAR(50),
    genero TEXT,
    estado VARCHAR(8) DEFAULT 'activo',
    fechaEstreno DATE,
    create_auditoria TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_auditoria TIMESTAMP NULL,
    delete_auditoria TIMESTAMP NULL
);

CREATE TABLE turnos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  peliculaId INT,
  sala INT,
  inicio DATETIME,
  fin DATETIME,
  precio DECIMAL(6,2),
  idioma VARCHAR(3),
  formato VARCHAR(2),
  aforo INT,
  estado VARCHAR(8) DEFAULT 'activo',
  create_auditoria TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  update_auditoria TIMESTAMP NULL,
  delete_auditoria TIMESTAMP NULL,
  FOREIGN KEY (peliculaId) REFERENCES peliculas(id)
);

Colección Postman

Ejemplo de endpoints:

Listar todas las películas
GET http://localhost/cineMVC/APIS/peliculas.php

Buscar películas (query param)
GET http://localhost/cineMVC/APIS/peliculas.php?search=X men

Obtener por ID
GET http://localhost/cineMVC/APIS/peliculas.php/1

Crear película
POST http://localhost/cineMVC/APIS/peliculas.php
{
  "titulo": "Matrix",
  "sinopsis": "Película de acción",
  "duracionMin": 136,
  "clasificacion": "B",
  "genero": "accion",
  "estado": "activo",
  "fechaEstreno": "1999-03-31"
}

Crear turno
POST http://localhost/cineMVC/APIS/turno.php
{
  "peliculaId":1,
  "sala":1,
  "inicio":"2025-08-27 18:00:00",
  "fin":"2025-08-27 20:30:00",
  "precio":25.50,
  "idioma":"dob",
  "formato":"2D",
  "aforo":50,
  "estado":"activo"
}