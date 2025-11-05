<?php
include_once __DIR__ . "/../../core/Database.php";
class General {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

   public function mostrar_datos_personales($id_usuario){
        $query = "SELECT * FROM obtener_datos_usuario(:id_usuario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
   }
   
   public function mostar_datos_emergencia($id_usuario){
        $query = "SELECT * FROM obtener_contactos_emergencia(:id_usuario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   public function mostar_notificaciones($id_usuario){
        $query = "SELECT * FROM obtener_notificaciones_usuario(:id_usuario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
   }

   public function mostrar_log_general($pagina,$cantidad){
    $query="SELECT * FROM obtener_log_actividades_paginado(:pagina,:cantidad)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':pagina', $pagina, PDO::PARAM_INT);
    $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

}

?>