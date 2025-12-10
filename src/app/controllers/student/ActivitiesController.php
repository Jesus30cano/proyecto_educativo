<?php
class ActivitiesController extends Controller {
    
    public function __construct() {
       session_start();
    }

    private function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    public function index() {
         if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 3) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('student_panel/actividades');
    }

    public function obtenerActividadesPorCompetencia()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 3) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'No autorizado.'
            ], 401);
        }

        if (!isset($_SESSION['id_competencia_seleccionada'])) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'No se ha seleccionado ninguna competencia.'
            ], 400);
        }

        try {
            $studentModel = $this->model('student/StudentModel');
            $id_usuario = $_SESSION['user_id'];
            $id_competencia = $_SESSION['id_competencia_seleccionada'];

            $actividades = $studentModel->obtenerActividadesPorCompetencia($id_usuario, $id_competencia);

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $actividades
            ]);

        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al obtener las actividades: ' . $e->getMessage()
            ], 500);
        }
    }



    //---------------------------------------------------------------------------------------------------------//

    public function subirArchivoActividad()
    {
        if (!isset($_SESSION['user_id'])) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'No se ha iniciado sesión.'
            ], 401);
        }

        if (!isset($_FILES['archivo'])) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'No se ha enviado ningún archivo.'
            ], 400);
        }

        $archivo = $_FILES['archivo'];
        $id_actividad = $_POST['id_actividad'] ?? null;
        $descripcion = $_POST['descripcion'] ?? '';

        if (!$id_actividad) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'ID de actividad no proporcionado.'
            ], 400);
        }

        // Validar tipo de archivo
        $extensionesPermitidas = ['pdf', 'doc', 'docx', 'zip', 'rar', 'jpg', 'jpeg', 'png'];
        $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $extensionesPermitidas)) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Formato de archivo no permitido. Solo se permiten: ' . implode(', ', $extensionesPermitidas)
            ], 400);
        }

        // Validar tamaño (máx 10MB)
        $maxSize = 10 * 1024 * 1024; // 10MB en bytes
        if ($archivo['size'] > $maxSize) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'El archivo supera el tamaño máximo permitido (10MB).'
            ], 400);
        }

        try {
            // Crear directorio si no existe
            $uploadDir = __DIR__ . '/../../../storage/documents/entregas/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Generar nombre único para el archivo
            $nombreArchivo = 'entrega_' . $_SESSION['user_id'] . '_' . $id_actividad . '_' . time() . '.' . $extension;
            $rutaDestino = $uploadDir . $nombreArchivo;
            $rutaRelativa = '/storage/documents/entregas/' . $nombreArchivo;

            // Mover archivo
            if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Error al guardar el archivo.'
                ], 500);
            }

            // Guardar en base de datos
            $studentModel = $this->model('student/StudentModel');
            $id_estudiante = $_SESSION['user_id'];
            $titulo = 'Entrega - Actividad ' . $id_actividad;

            $studentModel->subirEntregaActividad($id_actividad, $id_estudiante, $titulo, $descripcion, $rutaRelativa);

            return $this->jsonResponse([
                'status' => 'success',
                'message' => 'Actividad entregada correctamente.',
                'ruta_archivo' => $rutaRelativa
            ]);

        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al procesar la entrega: ' . $e->getMessage()
            ], 500);
        }
    }

    //---------------------------------------------------------------------------------------------------------//

    public function subirEntregaActividad()
    {
        if (!isset($_SESSION['user_id'])) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'No se ha iniciado sesión.'
            ], 401);
        }

        $input = json_decode(file_get_contents("php://input"), true);
        $id_actividad = $input['id_actividad'] ?? null;
        $titulo = $input['titulo'] ?? null;
        $descripcion = $input['descripcion'] ?? '';
        $ruta_archivo = $input['ruta_archivo'] ?? null;

        if (!$id_actividad || !$titulo || !$ruta_archivo) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Faltan parámetros obligatorios.'
            ], 400);
        }

        try {
            $studentModel = $this->model('student/StudentModel');
            $id_estudiante = $_SESSION['user_id'];

            $studentModel->subirEntregaActividad($id_actividad, $id_estudiante, $titulo, $descripcion, $ruta_archivo);

            return $this->jsonResponse([
                'status' => 'success',
                'message' => 'Actividad subida correctamente.'
            ]);

        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al subir la actividad: ' . $e->getMessage()
            ], 500);
        }
    }





    //---------------------------------------------------------------------------------------------------------//



    public function obtenerActividadesPendientes()
{
    if (!isset($_SESSION['user_id'])) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'No se ha iniciado sesión.'
        ], 401);
    }

    try {
        $studentModel = $this->model('student/StudentModel');
        $id_estudiante = $_SESSION['user_id'];

        $actividades = $studentModel->obtenerActividadesPendientes($id_estudiante);

        return $this->jsonResponse([
            'status' => 'success',
            'data' => $actividades
        ]);

    } catch (PDOException $e) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Error al obtener las actividades pendientes: ' . $e->getMessage()
        ], 500);
    }
}


}
?>