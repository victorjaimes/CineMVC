<?php
require_once __DIR__ . '/../MODELS/TurnosModels.php';
require_once __DIR__ . '/../MODELS/PeliculasModels.php';

class TurnosController {
    private $model;

    public function __construct() {
        $this->model = new TurnosModels();
        $this->mdlPeliculas = new PeliculasModels();
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
        if(strtotime($data['fin']) <= strtotime($data['inicio'])){
            return ['error'=>422, 'message'=>'El fin debe ser mayor al inicio'];
        }

        $pelicula = (array)$this->mdlPeliculas->verDatos($data['peliculaId']);
        if(!$pelicula) return ['error'=>404,'message'=>'Película no encontrada'];

        $duracionTurno = (strtotime($data['fin']) - strtotime($data['inicio'])) / 60;
        if($duracionTurno < $pelicula['duracionMin']){
            return ['error'=>422,'message'=>'Duración del turno menor a duración de la película'];
        }

        $res = $this->model->listarMismaSala((array)($data??[]));
        if($res->num_rows > 0) return ['error'=>400,'message'=>'Solape de turno en la misma sala'];

        $guardarDatos = $this->model->guardar($data);
        if($guardarDatos) return ['message'=>'Turno creado correctamente'];
        return ['error'=>500,'message'=>'Error al crear turno'];
    }

    public function editar(int $id, array $data) 
    {
        if(strtotime($data['fin']) <= strtotime($data['inicio'])){
            return ['error'=>422, 'message'=>'El fin debe ser mayor al inicio'];
        }

        $pelicula = (array)$this->mdlPeliculas->verDatos($data['peliculaId']);
        if(!$pelicula) return ['error'=>404,'message'=>'Película no encontrada'];

        $duracionTurno = (strtotime($data['fin']) - strtotime($data['inicio'])) / 60;
        if($duracionTurno < $pelicula['duracionMin']){
            return ['error'=>422,'message'=>'Duración del turno menor a duración de la película'];
        }

        $res = $this->model->listarMismaSala((array)($data??[]));
        if($res->num_rows > 0) return ['error'=>400,'message'=>'Solape de turno en la misma sala'];

        $editarDatos = $this->model->editar(((int)($id??0)),((array)($data??[])));
        if($editarDatos) return ['message'=>'Turno actualizado correctamente'];
        return ['error'=>500,'message'=>'Error al actualizar turno'];
    }

    public function eliminar(int $id) 
    {
        $eliminarDato = $this->model->eliminar($id);
        if($eliminarDato) return ['message'=>'Turno eliminado correctamente'];
        return ['error'=>500,'message'=>'Error al eliminar turno'];
    }
}