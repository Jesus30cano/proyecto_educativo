<?php
require_once __DIR__ . "/../../../core/Database.php";
class TeacherModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // crear actividad
    public function crear_actividad($titulo,$descripcion,$fecha_entrega,$ruta,$competencia,$curso,$profesor) {
        $query ="CALL crear_actividad(:titulo,:descripcion,:fecha_entrega,:ruta,:competencia,:curso,:profesor)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_entrega', $fecha_entrega);
        $stmt->bindParam(':ruta', $ruta);
        $stmt->bindParam(':competencia', $competencia);
        $stmt->bindParam(':curso', $curso);
        $stmt->bindParam(':profesor', $profesor);
        return $stmt->execute();

    }
    // listar actividades
    public function obtener_actividades($competencia_id, $curso_id, $profesor_id) {
        $query = "CALL obtener_actividades(:competencia_id, :curso_id, :profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':competencia_id', $competencia_id);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtener_total_curso_competencias($profesor_id) {
        $query = "SELECT * FROM fn_estadisticas_profesor(:profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function obtener_cursos_por_profesor($profesor_id) {
        $query = "SELECT * FROM fn_cursos_competencias_profesor(:profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtener_cursos_por_profesor_ver($profesor_id) {
        $query = "SELECT * FROM fn_cursos_competencias_profesor_ver(:profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtener_actividades_pendientes_por_calificar($profesor_id) {
        $query = "SELECT * FROM fn_actividades_pendientes_calificar(:profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   
    public function obtener_actividades_competencia($curso_id,$profesor_id) {
        $query = "SELECT * FROM fn_obtener_competencias_con_actividades(:curso_id, :profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtener_competencia_por_id($competencia_id) {
        $query = "select id_competencia as id, nombre,descripcion from tb_competencia where id_competencia = :competencia_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':competencia_id', $competencia_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function obtener_actividad_por_id($curso_id,$profesor_id,$competencia_id) {
        $query = "SELECT * FROM fn_obtener_actividades(:curso_id, :profesor_id, :competencia_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->bindParam(':competencia_id', $competencia_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>