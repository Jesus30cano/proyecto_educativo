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