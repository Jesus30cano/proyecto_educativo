<?php
require_once __DIR__ . "/../../core/Database.php";
class StudentModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Métodos específicos para el modelo de estudiante pueden ser añadidos aquí
}
?>