<?php
    header("Content-Type: application/json");
    require_once __DIR__ . '/../CONFIG/conexion.php';
    require __DIR__ . '/../APP/CONTROLLERS/PeliculasController.php';

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = explode("/", trim($_SERVER['REQUEST_URI'], "/"));

    $controller = new PeliculasController();
    switch ($method) {
        case "GET":
            echo json_encode((isset($uri[3])?$controller->verDatos($uri[3]):$controller->listarDatos((array)($_GET??[]))));
            break;
        case "POST":
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($controller->crear((array)($data??[])));
            break;
        case "PUT":
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($controller->editar((int)($uri[3]??0), (array)($data??[])));
            break;
        case "DELETE":
            echo json_encode($controller->eliminar((int)($uri[3]??0)));
            break;
    }