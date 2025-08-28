<?php
require_once __DIR__ . '/../MODELS/PeliculasModels.php';

class PeliculasController {
    private $model;

    public function __construct() {
        $this->model = new PeliculasModels();
    }

    public function listarDatos(array $filtros = [])
    {
        return $this->model->listarDatos((array)($filtros??[]));
    }

    public function verDatos(int $id)
    {
        return $this->model->verDatos((int)($id??0));
    }

    public function crear(array $data) 
    {
        return $this->model->guardar($data);
    }

    public function editar(int $id, array $data) 
    {
        return $this->model->editar(((int)($id??0)),((array)($data??[])));
    }

    public function eliminar(int $id) 
    {
        return $this->model->eliminar($id);
    }
}