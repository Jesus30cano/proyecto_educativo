<?php
require_once __DIR__ . "/../../../core/Database.php";

class StudentModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Métodos específicos para el modelo de estudiante pueden ser añadidos aquí




    /**
     * Obtener información del curso del estudiante
     */
    public function obtenerCursoPorEstudiante($id_usuario)
    {

        $sql = "SELECT * FROM obtener_curso_por_estudiante(:id_usuario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Obtener competencias del estudiante basadas en su curso
     */
    public function obtenerCompetenciasPorEstudiante($id_usuario)
    {
        $sql = "SELECT c.id_competencia, c.codigo, c.nombre, c.descripcion, 
                       CONCAT(dp.nombre, ' ', dp.apellido) AS profesor,
                       cur.nombre_curso AS curso, cur.ficha
                FROM Tb_estudiante_curso ec
                INNER JOIN Tb_curso cur ON ec.id_curso = cur.id_curso
                INNER JOIN Tb_competencia_curso cc ON cur.id_curso = cc.id_curso
                INNER JOIN Tb_competencia c ON cc.id_competencia = c.id_competencia
                LEFT JOIN Tb_usuario u ON c.id_profesor = u.id_usuario
                LEFT JOIN Tb_datos_personales dp ON u.id_usuario = dp.id_usuario
                WHERE ec.id_usuario = :id_usuario
                ORDER BY c.codigo";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function obtenerCompetenciasPorCurso($id_curso)
    {

        $sql = "SELECT * FROM obtener_competencias_por_curso(:id_curso)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    /**
     * Subir entrega de una actividad por el estudiante
     */
    public function subirEntregaActividad($id_actividad, $id_estudiante, $titulo, $descripcion, $ruta_archivo)
    {
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
    public function obtenerActividadesPendientes($id_estudiante)
    {
        $sql = "SELECT * FROM obtener_actividades_estudiante(:id_estudiante)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener actividades de una competencia específica para un estudiante
     */
    public function obtenerActividadesPorCompetencia($id_estudiante, $id_competencia)
    {
        $sql = "SELECT 
                    a.id_actividad,
                    a.titulo,
                    a.descripcion,
                    a.fecha_entrega,
                    a.ruta_archivo AS ruta_archivo_actividad,
                    comp.nombre AS nombre_competencia,
                    comp.codigo AS codigo_competencia,
                    CONCAT(dp.nombre, ' ', dp.apellido) AS nombre_profesor,
                    CASE 
                        WHEN ea.id_actividad IS NULL THEN 'pendiente'
                        WHEN ea.calificacion IS NOT NULL THEN 'calificada'
                        ELSE 'entregada'
                    END AS estado_entrega,
                    ea.calificacion::TEXT,
                    ea.ruta_archivo AS ruta_archivo_entrega,
                    ea.observaciones,
                    ea.fecha_calificacion,
                    ea.id_entrega
                FROM Tb_actividad a
                INNER JOIN Tb_competencia comp ON comp.id_competencia = a.id_competencia
                INNER JOIN Tb_datos_personales dp ON dp.id_usuario = a.id_profesor
                INNER JOIN Tb_curso c ON c.id_curso = a.id_curso
                INNER JOIN Tb_estudiante_curso ec ON ec.id_curso = c.id_curso
                LEFT JOIN Tb_entrega_actividad ea 
                       ON ea.id_actividad = a.id_actividad
                      AND ea.id_estudiante = :id_estudiante
                WHERE ec.id_usuario = :id_estudiante
                  AND a.id_competencia = :id_competencia
                ORDER BY a.fecha_entrega ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
        $stmt->bindParam(':id_competencia', $id_competencia, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    // Obtener calificaciones de un estudiante
    public function obtenerCalificacionesPorEstudiante($id_estudiante)
    {
        $sql = "SELECT * FROM obtener_calificaciones_por_estudiante(:id_estudiante)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    // Obtener calificaciones de exámenes de un estudiante
    public function obtenerCalificacionesExamenes($id_estudiante)
    {
        $sql = "SELECT * FROM obtener_calificaciones_examenes(:id_estudiante)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Marcar una notificación como leída
    public function marcarNotificacionLeida($id_notificacion, $id_usuario)
    {
        $sql = "SELECT marcar_notificacion_leida(:id_notificacion, :id_usuario) AS mensaje";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_notificacion', $id_notificacion, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['mensaje'];
    }

    
    public function obtenerEvaluacionesPorEstudiante($id_estudiante)
    {
        $sql = "SELECT * FROM obtener_evaluaciones_por_estudiante(:id_estudiante)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener datos del dashboard del estudiante
     * Retorna: nombre, apellido, curso, ficha, actividades asignadas y exámenes pendientes
     */
    public function getDashboardData($id_estudiante)
    {
        try {
            // Obtener datos personales del estudiante
            $sqlDatosPersonales = "
                SELECT 
                    dp.nombre, 
                    dp.apellido
                FROM Tb_datos_personales dp
                WHERE dp.id_usuario = :id_estudiante
            ";
            $stmtDatos = $this->conn->prepare($sqlDatosPersonales);
            $stmtDatos->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
            $stmtDatos->execute();
            $datosPersonales = $stmtDatos->fetch(PDO::FETCH_ASSOC);

            // Obtener curso y ficha del estudiante
            $sqlCurso = "
                SELECT 
                    c.nombre_curso, 
                    c.ficha
                FROM Tb_estudiante_curso ec
                INNER JOIN Tb_curso c ON ec.id_curso = c.id_curso
                WHERE ec.id_usuario = :id_estudiante
                LIMIT 1
            ";
            $stmtCurso = $this->conn->prepare($sqlCurso);
            $stmtCurso->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
            $stmtCurso->execute();
            $curso = $stmtCurso->fetch(PDO::FETCH_ASSOC);

            // Contar actividades asignadas (pendientes)
            $sqlActividades = "
                SELECT COUNT(*) as total_actividades
                FROM Tb_actividad a
                INNER JOIN Tb_estudiante_curso ec ON a.id_curso = ec.id_curso
                WHERE ec.id_usuario = :id_estudiante
                AND a.id_actividad NOT IN (
                    SELECT id_actividad 
                    FROM Tb_entrega_actividad 
                    WHERE id_estudiante = :id_estudiante
                )
            ";
            $stmtActividades = $this->conn->prepare($sqlActividades);
            $stmtActividades->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
            $stmtActividades->execute();
            $actividades = $stmtActividades->fetch(PDO::FETCH_ASSOC);

            // Contar exámenes pendientes (sin realizar)
            $sqlExamenes = "
                SELECT COUNT(*) as total_examenes
                FROM Tb_evaluacion e
                INNER JOIN Tb_estudiante_curso ec ON e.id_curso = ec.id_curso
                WHERE ec.id_usuario = :id_estudiante
                AND e.id_evaluacion NOT IN (
                    SELECT id_evaluacion 
                    FROM Tb_respuestas_estudiante 
                    WHERE id_usuario = :id_estudiante
                )
            ";
            $stmtExamenes = $this->conn->prepare($sqlExamenes);
            $stmtExamenes->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
            $stmtExamenes->execute();
            $examenes = $stmtExamenes->fetch(PDO::FETCH_ASSOC);

            // Construir el resultado
            return [
                'nombre' => $datosPersonales['nombre'] ?? 'No disponible',
                'apellido' => $datosPersonales['apellido'] ?? '',
                'curso' => $curso['nombre_curso'] ?? 'Sin curso asignado',
                'ficha' => $curso['ficha'] ?? 'N/A',
                'actividades_pendientes' => $actividades['total_actividades'] ?? 0,
                'examenes_pendientes' => $examenes['total_examenes'] ?? 0
            ];

        } catch (PDOException $e) {
            throw new Exception("Error al obtener datos del dashboard: " . $e->getMessage());
        }
    }
}
?>