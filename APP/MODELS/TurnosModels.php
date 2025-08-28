<?php
require_once __DIR__ . '/../../CONFIG/conexion.php';

class TurnosModels {
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function listarDatos(array $filtros = []): Array
    {
        $sql = "SELECT t.*, p.titulo
        FROM turnos t
        JOIN peliculas p ON t.peliculaId = p.id
        WHERE 1=1";
        $params = []; $tipos = '';

        if (!empty($filtros['peliculaId'])) { $sql .= " AND t.peliculaId = ?"; $params[] = $filtros['peliculaId']; $tipos .= 's'; }
        if (!empty($filtros['sala'])) { $sql .= " AND t.sala = ?"; $params[] = $filtros['sala']; $tipos .= 's'; }
        if (!empty($filtros['desde'])) { $sql .= " AND t.inicio >= ?"; $params[] = $filtros['desde']; $tipos .= 's'; }
        if (!empty($filtros['hasta'])) { $sql .= " AND t.fin >= ?"; $params[] = $filtros['hasta']; $tipos .= 's'; }

        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) { $stmt->bind_param($tipos, ...$params); }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function listarMismaSala(array $data)
    {
        $sql = "SELECT * FROM turnos WHERE sala = ? AND ((inicio BETWEEN ? AND ?) OR (fin BETWEEN ? AND ?))";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issss", $data['sala'], $data['inicio'], $data['fin'], $data['inicio'], $data['fin']);
        $stmt->execute();
        return $stmt->get_result();
    }

        public function verDatos(int $id): ?object
    {
        $sql = "SELECT * FROM turnos WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
    }

    public function guardar($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO turnos (peliculaId,sala,inicio,fin,precio,idioma,formato,aforo,estado) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('iissdsiss',$data['peliculaId'],$data['sala'],$data['inicio'],$data['fin'],$data['precio'],$data['idioma'],$data['formato'],$data['aforo'],$data['estado']);
        return $stmt->execute();
    }

    public function editar(int $id , array $data)
    {
        $sql = "UPDATE turnos SET peliculaId=?, sala=?, inicio=?, fin=?, precio=?, idioma=?, formato=?, aforo=?, estado=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iissdsissi",$data['peliculaId'],$data['sala'],$data['inicio'],$data['fin'],$data['precio'],$data['idioma'],$data['formato'],$data['aforo'],$data['estado'],$id);
        return $stmt->execute();
    }
    
    public function eliminar(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM turnos WHERE id=?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}