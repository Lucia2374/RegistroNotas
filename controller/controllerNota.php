<?php
require_once 'app/config/Database.php';
require_once 'app/models/Nota.php';

class NotaController {
    private $db;
    private $nota;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->nota = new Nota($this->db);
    }


    public function registrarNota($estudiante, $descripcion, $nota) {
        $this->nota->estudiante = $estudiante;
        $this->nota->descripcion = $descripcion;
        $this->nota->nota = $nota;

        if ($this->nota->registrar()) {
            return "Nota registrada con éxito.";
        } else {
            return "Error al registrar la nota.";
        }
    }


    public function listarNotas() {
        return $this->nota->listar();
    }
}
