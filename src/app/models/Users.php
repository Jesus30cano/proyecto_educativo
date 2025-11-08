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
        $query = "SELECT verificar_correo_usuario(:correo) AS existe";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $correo);   
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Esto da un array como ['existe' => true/false]
        return $result['existe'] ? true : false;
    } catch (PDOException $e) {
        error_log("Error en validar_correo_existente: " . $e->getMessage());
        return false;
    }
}
    public function actualizar_password($correo, $new_password) {
        try {
            $query = "CALL cambiar_clave_usuario(:correo, :new_password)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':new_password', $new_password);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            error_log("Error en actualizar_password: " . $e->getMessage());
            return false;
        }
    }

}

?>