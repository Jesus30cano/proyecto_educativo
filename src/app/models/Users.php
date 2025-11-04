<?php
require_once __DIR__ . "/../../core/Database.php";
class Users{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function login($tipo_doc, $cedula, $password) {
        try {
            $query = "SELECT * FROM validar_usuario(:tipo_doc, :cedula)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':tipo_doc', $tipo_doc);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;

        } catch (PDOException $e) {
            // Registrar el error sin mostrarlo al usuario
            error_log("Error en login: " . $e->getMessage());
            return false;
        }
    }
}

?>