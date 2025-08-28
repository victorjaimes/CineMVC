<?php
require_once __DIR__ . '/../../CONFIG/conexion.php';

class PeliculasModels {
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function listarDatos(array $filtros = []): Array
    {
        $sql = "SELECT * FROM peliculas WHERE 1=1";
        $params = []; $tipos = '';

        if (!empty($filtros['search'])) { $sql .= " AND titulo LIKE ?"; $params[] = '%' . $filtros['search'] . '%'; $tipos .= 's'; }
        if (!empty($filtros['genero'])) { $sql .= " AND genero LIKE ?"; $params[] = '%' . $filtros['genero'] . '%'; $tipos .= 's'; }
        if (!empty($filtros['estado'])) { $sql .= " AND estado = ?"; $params[] = $filtros['estado']; $tipos .= 's'; }

        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) { $stmt->bind_param($tipos, ...$params); }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function verDatos(int $id): ?object
    {
        $sql = "SELECT * FROM peliculas WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
    }

    public function guardar($data)
    {
        $fechaEstreno = (new DateTime($data['fechaEstreno']))->format('Y-m-d');
        $stmt = $this->conn->prepare("INSERT INTO peliculas (titulo, sinopsis, duracionMin, clasificacion, genero, estado, fechaEstreno) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param('ssissss', $data['titulo'], $data['sinopsis'], $data['duracionMin'], $data['clasificacion'], $data['genero'], $data['estado'], $fechaEstreno);
        return $stmt->execute();
    }

    public function editar(int $id , array $data)
    {
        $fechaEstreno = (new DateTime($data['fechaEstreno']))->format('Y-m-d');
        $stmt = $this->conn->prepare("UPDATE peliculas SET sinopsis=?, duracionMin=?, clasificacion=?, genero=?, estado=?, fechaEstreno=?, update_auditoria=NOW() WHERE id=?");
        $stmt->bind_param('sissssi', $data['sinopsis'], $data['duracionMin'], $data['clasificacion'], $data['genero'], $data['estado'], $fechaEstreno, $id);
        return $stmt->execute();
    }

    public function eliminar(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM peliculas WHERE id=?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}