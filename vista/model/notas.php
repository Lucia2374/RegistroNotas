<?php

class Nota {
    private $conn;
    private $table_name = "notas";

    public $id;
    public $estudiante;
    public $descripcion;
    public $nota;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " (estudiante, descripcion, nota) 
                  VALUES (:estudiante, :descripcion, :nota)";

        $reg = $this->conn->prepare($query);
        $reg->bindParam(":estudiante", $this->estudiante);
        $reg->bindParam(":descripcion", $this->descripcion);
        $reg->bindParam(":nota", $this->nota);

        if ($reg->execute()) {
            return true;
        }

        return false;
    }
    public function listar() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $reg = $this->conn->prepare($query);
        $reg->execute();

        return $reg;
    }
     public function obtenerPromedio() {
        $query = "SELECT AVG(nota) as promedio FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['promedio'];
    }
}
