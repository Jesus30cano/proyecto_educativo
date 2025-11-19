<?php
require_once __DIR__ . "/../../../core/Database.php";
class TeacherModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // crear actividad
    public function crear_actividad($titulo, $descripcion, $fecha_entrega, $ruta, $competencia, $curso, $profesor)
    {
        $query = "CALL crear_actividad(:titulo,:descripcion,:fecha_entrega,:ruta,:competencia,:curso,:profesor)";
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
    public function obtener_actividades($competencia_id, $curso_id, $profesor_id)
    {
        $query = "CALL obtener_actividades(:competencia_id, :curso_id, :profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':competencia_id', $competencia_id);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtener_total_curso_competencias($profesor_id)
    {
        $query = "SELECT * FROM fn_estadisticas_profesor(:profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function obtener_cursos_por_profesor($profesor_id)
    {
        $query = "SELECT * FROM fn_cursos_competencias_profesor(:profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtener_cursos_por_profesor_ver($profesor_id)
    {
        $query = "SELECT * FROM fn_cursos_competencias_profesor_ver(:profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener_actividades_pendientes_por_calificar($profesor_id)
    {
        $query = "SELECT * FROM fn_actividades_pendientes_calificar(:profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtener_actividades_competencia($curso_id, $profesor_id)
    {
        $query = "SELECT * FROM fn_obtener_competencias_con_actividades(:curso_id, :profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtener_competencia_por_id($competencia_id)
    {
        $query = "select id_competencia as id, nombre,descripcion from tb_competencia where id_competencia = :competencia_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':competencia_id', $competencia_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function obtener_actividad_por_id($curso_id, $profesor_id, $competencia_id)
    {
        $query = "SELECT * FROM fn_obtener_actividades(:curso_id, :profesor_id, :competencia_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':curso_id', $curso_id);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->bindParam(':competencia_id', $competencia_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function actualizar_actividad($id, $titulo, $descripcion, $fecha_entrega)
    {
        $query = "CALL editar_actividad(:id,:titulo,:descripcion,:fecha_entrega)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_entrega', $fecha_entrega);
        return $stmt->execute();
    }
    public function eliminar_actividad($id)
    {
        $query = "DELETE from tb_actividad where id_actividad = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function obtener_actividades_del_profesor($profesor_id)
    {
        $query = "SELECT * FROM fn_actividades_profesor_resumen(:profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Entregas de prueba por actividad
    public function obtener_entregas_por_actividad($actividad_id)
    {
        $query = "SELECT * FROM fn_entregas_por_actividad(:actividad_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':actividad_id', $actividad_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calificar_entrega($idEntrega, $calificacion)
    {
        $query = " UPDATE Tb_entrega_actividad SET calificacion = :calificacion, estado_entrega = TRUE,
            fecha_calificacion = NOW()
            WHERE id_estudiante = :idEntrega";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idEntrega', $idEntrega);
        $stmt->bindParam(':calificacion', $calificacion);
        return $stmt->execute();
    }
    public function obtener_evaluaciones($profesor_id)
    {
        $query = "SELECT * FROM obtener_evaluaciones_por_profesor(:profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // TeacherModel.php
    public function obtener_estudiantes_por_curso($id_curso)
    {

        $sql = "SELECT * FROM fn_estudiantes_por_curso(:id_curso)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function registrar_asistencia($id_profesor, $id_estudiante_curso, $estado, $observaciones)
    {
        $sql = "SELECT fn_registrar_asistencia(:id_profesor, :id_estudiante_curso, :estado, :observaciones)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id_profesor', $id_profesor, PDO::PARAM_INT);
        $stmt->bindParam(':id_estudiante_curso', $id_estudiante_curso, PDO::PARAM_INT);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);

        if ($observaciones === null) {
            $stmt->bindValue(':observaciones', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':observaciones', $observaciones, PDO::PARAM_STR);
        }

        $stmt->execute();
    }


    public function obtener_asistencias($id_profesor, $id_curso = null, $fecha = null)
    {
        $sql = "SELECT * FROM fn_asistencias_profesor(:id_profesor, :id_curso, :fecha)";
        $stmt = $this->conn->prepare($sql);


        $stmt->bindValue(':id_profesor', (int)$id_profesor, PDO::PARAM_INT);


        if ($id_curso === null || $id_curso === '') {
            $stmt->bindValue(':id_curso', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':id_curso', (int)$id_curso, PDO::PARAM_INT);
        }


        if ($fecha === null || $fecha === '') {
            $stmt->bindValue(':fecha', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':fecha', $fecha, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function actualizar_asistencia($id_profesor, $id_asistencia, $estado, $observaciones)
    {
        $sql = "SELECT fn_actualizar_asistencia(
                :id_profesor,
                :id_asistencia,
                :estado,
                :observaciones
            )";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_profesor',   (int)$id_profesor,    PDO::PARAM_INT);
        $stmt->bindValue(':id_asistencia', (int)$id_asistencia,  PDO::PARAM_INT);
        $stmt->bindValue(':estado',        $estado,              PDO::PARAM_STR);
        if ($observaciones === null) {
            $stmt->bindValue(':observaciones', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':observaciones', $observaciones, PDO::PARAM_STR);
        }
        $stmt->execute();
    }

    
}
?>