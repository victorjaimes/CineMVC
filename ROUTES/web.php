<?php
    switch(($_GET['url'] ?? '')){
        case 'PELICULAS':
            require __DIR__ . '/../APP/CONTROLLERS/PeliculasController.php';
            $controller = new PeliculasController();
            $controller->index();
            break;

        case 'PELICULAS/NUEVO':
            require __DIR__ . '/../APP/CONTROLLERS/PeliculasController.php';
            $controller = new PeliculasController();
            $controller->nuevo();
            break;

        case 'PELICULAS/GUARDAR':
            require __DIR__ . '/../APP/CONTROLLERS/PeliculasController.php';
            $controller = new PeliculasController();
            $controller->guardar($_POST);
            break;

        case 'PELICULAS/VER':
            require __DIR__ . '/../APP/CONTROLLERS/PeliculasController.php';
            $controller = new PeliculasController();
            $controller->ver((int)($_GET['id']??0));
            break;

        case 'PELICULAS/EDITAR':
            require __DIR__ . '/../APP/CONTROLLERS/PeliculasController.php';
            $controller = new PeliculasController();
            $controller->editar($_POST);
            break;
        case 'PELICULAS/ELIMINAR':
            require __DIR__ . '/../APP/CONTROLLERS/PeliculasController.php';
            $controller = new PeliculasController();
            $controller->eliminar((int)($_GET['id']??0));
            break;

        default:
            echo "Página no encontrada";
    }
?>