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
        // Simulación de datos
        return [
            [
                "id" => 101,
                "titulo" => "Maquetación con Flexbox",
                "curso" => "Desarrollo Web",
                "ficha" => "256789A",
                "competencia" => "Interfaces Web",
                "fecha_entrega" => "2025-11-15",
                "estado_general" => "3 entregas / 5 estudiantes"
            ],
            [
                "id" => 102,
                "titulo" => "Landing Page con Bootstrap",
                "curso" => "Desarrollo Web",
                "ficha" => "256789A",
                "competencia" => "Interfaces Web",
                "fecha_entrega" => "2025-11-20",
                "estado_general" => "1 entrega / 5 estudiantes"
            ]
        ];
    }

    // 🔹 Entregas de prueba por actividad
    public function obtener_entregas_por_actividad($actividad_id)
    {
        if ($actividad_id == 101) {
            return [
                ["id" => 1, "estudiante" => "Ana Pérez", "estado" => "Entregado", "fecha_entrega" => "2025-11-14", "archivo" => "storage/documents/ana_flexbox.pdf", "calificacion" => "Aprobado"],
                ["id" => 2, "estudiante" => "Carlos Gómez", "estado" => "Entregado", "fecha_entrega" => "2025-11-15", "archivo" => "storage/documents/carlos_flexbox.pdf", "calificacion" => null],
                ["id" => 3, "estudiante" => "Laura Martínez", "estado" => "Pendiente", "fecha_entrega" => null, "archivo" => null, "calificacion" => null],
                ["id" => 4, "estudiante" => "José Rodríguez", "estado" => "Entregado", "fecha_entrega" => "2025-11-15", "archivo" => "storage/documents/jose_flexbox.pdf", "calificacion" => "No aprobado"],
                ["id" => 5, "estudiante" => "María López", "estado" => "Pendiente", "fecha_entrega" => null, "archivo" => null, "calificacion" => null],
            ];
        }

        if ($actividad_id == 102) {
            return [
                ["id" => 6, "estudiante" => "Pedro Sánchez", "estado" => "Entregado", "fecha_entrega" => "2025-11-19", "archivo" => "storage/documents/pedro_bootstrap.pdf", "calificacion" => "Aprobado"],
                ["id" => 7, "estudiante" => "Lucía Torres", "estado" => "Pendiente", "fecha_entrega" => null, "archivo" => null, "calificacion" => null],
                ["id" => 8, "estudiante" => "Miguel Díaz", "estado" => "Entregado", "fecha_entrega" => "2025-11-20", "archivo" => "storage/documents/miguel_bootstrap.pdf", "calificacion" => null],
                ["id" => 9, "estudiante" => "Sofía Herrera", "estado" => "Pendiente", "fecha_entrega" => null, "archivo" => null, "calificacion" => null],
                ["id" => 10, "estudiante" => "Andrés Ramírez", "estado" => "Pendiente", "fecha_entrega" => null, "archivo" => null, "calificacion" => null],
            ];
        }

        return [];
    }

     public function calificar_entrega($idEntrega, $calificacion)
    {
        // 🔹 Simulación: cambiar por bd 
        // Para pruebas, simplemente devolvemos que se actualizó correctamente
        return [
            "status" => "success",
            "message" => "Entrega calificada correctamente.",
            "id_entrega" => $idEntrega,
            "calificacion" => $calificacion
        ];
    }


}
?>