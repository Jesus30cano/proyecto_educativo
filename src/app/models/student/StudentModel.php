<?php
require_once __DIR__ . "/../../core/Database.php";

class AdminModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Métodos específicos para el modelo de estudiante pueden ser añadidos aquí




    /**
    * Obtener información del curso del estudiante
    */
    public function obtenerCursoPorEstudiante($id_usuario) {

        $sql = "SELECT * FROM obtener_curso_por_estudiante(:id_usuario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    
    public function obtenerCompetenciasPorCurso($id_curso) {

        $sql = "SELECT * FROM obtener_competencias_por_curso(:id_curso)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    }



    /**
    * Subir entrega de una actividad por el estudiante
    */
    public function subirEntregaActividad($id_actividad, $id_estudiante, $titulo, $descripcion, $ruta_archivo){
        $sql = "CALL subir_entrega_actividad(:id_actividad, :id_estudiante, :titulo, :descripcion, :ruta_archivo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);
        $stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':ruta_archivo', $ruta_archivo, PDO::PARAM_STR);
        return $stmt->execute();
    
    }





    // Obtener actividades pendientes de un estudiante
    public function obtenerActividadesPendientes($id_estudiante) {
        $sql = "SELECT * FROM obtener_actividades_pendientes(:id_estudiante)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    // Obtener calificaciones de un estudiante
    public function obtenerCalificacionesPorEstudiante($id_estudiante) {
        $sql = "SELECT * FROM obtener_calificaciones_por_estudiante(:id_estudiante)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    // Obtener calificaciones de exámenes de un estudiante
    public function obtenerCalificacionesExamenes($id_estudiante) {
        $sql = "SELECT * FROM obtener_calificaciones_examenes(:id_estudiante)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Marcar una notificación como leída
    public function marcarNotificacionLeida($id_notificacion, $id_usuario) {
        $sql = "SELECT marcar_notificacion_leida(:id_notificacion, :id_usuario) AS mensaje";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_notificacion', $id_notificacion, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['mensaje'];
    }

}
?>