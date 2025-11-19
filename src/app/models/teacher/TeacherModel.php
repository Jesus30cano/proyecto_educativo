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
        $query=" UPDATE Tb_entrega_actividad SET calificacion = :calificacion,
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
    public function obtener_examen_por_id($id) {
    // 1. Obtener datos principales del examen, curso, competencia y profesor
    $stmt1 = $this->conn->prepare("
        SELECT 
            e.titulo,
            e.descripcion,
            e.fecha,
            c.nombre_curso AS courseName,
            c.ficha AS ficha,
            cmp.nombre AS competenceName,
            cmp.codigo AS competenciaCodigo,
            u.id_usuario AS idProfesor,
            dp.nombre AS teacherName,
            dp.apellido AS teacherApellido
        FROM Tb_evaluacion e
        LEFT JOIN Tb_curso c ON e.id_curso = c.id_curso
        LEFT JOIN Tb_competencia cmp ON e.id_competencia = cmp.id_competencia
        LEFT JOIN Tb_usuario u ON e.id_profesor = u.id_usuario
        LEFT JOIN Tb_datos_personales dp ON dp.id_usuario = u.id_usuario
        WHERE e.id_evaluacion = ?
    ");
    $stmt1->execute([$id]);
    $examData = $stmt1->fetch(PDO::FETCH_ASSOC);

    if (!$examData) return null;

    // 2. Preguntas
    $stmt2 = $this->conn->prepare("
        SELECT p.id_pregunta, p.pregunta as text
        FROM Tb_preguntas p
        JOIN Tb_evaluacion_pregunta ep ON ep.id_pregunta = p.id_pregunta
        WHERE ep.id_evaluacion = ?
        ORDER BY p.id_pregunta
    ");
    $stmt2->execute([$id]);
    $questions = [];
    while ($q = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        // Opciones (solo texto, sin id)
        $stmt3 = $this->conn->prepare("SELECT opcion as text FROM Tb_opciones_respuesta WHERE id_pregunta = ? ORDER BY id_opcion");
        $stmt3->execute([$q['id_pregunta']]);
        $options = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        $questions[] = [
            'id' => $q['id_pregunta'],
            'text' => $q['text'],
            'options' => $options
        ];
    }

    // 3. Armar nombre completo de profesor
    $teacherName = trim($examData['teachername'] . " " . $examData['teacherapellido']);

    // 4. Estructura final para el frontend
    return [
        'title' => $examData['titulo'],
        'teacherName' => $teacherName,
        'date' => $examData['fecha'],
        'courseName' => $examData['coursename'],
        'ficha' => $examData['ficha'],
        'competenceName' => $examData['competencename'],
        'competenceCode' => $examData['competenciacodigo'],
        'description' => $examData['descripcion'],
        'questions' => $questions
    ];
}


}
?>