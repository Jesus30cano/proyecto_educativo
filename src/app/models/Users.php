<?php
require_once __DIR__ . "/../../core/Database.php";
class Users{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function buscar_usuario($tipo_doc, $cedula) {
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

    public function validar_correo_existente($correo) {
        try {
            $query = "SELECT verificar_correo_usuario(:correo) as correo_existente";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':correo', $correo);   
            $stmt->execute();
            return $result = $stmt->fetch(PDO::FETCH_ASSOC);
           

        } catch (PDOException $e) {
            error_log("Error en validar_correo_existente: " . $e->getMessage());
            return false;
        }
    }

}

?>