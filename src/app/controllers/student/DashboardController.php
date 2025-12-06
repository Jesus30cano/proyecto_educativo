<?php
class DashboardController extends Controller
{
    public function __construct()
    {
        session_start(); 
    }

    private function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function index()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 3) {
            // Redirigir si no está autenticado
            header('Location: /auth/login');
            exit;
        }
        $this->view('student_panel/dashboard');
    }



    //---------------------------------------------------------------------------------------------------------//



    public function obtenerActividadesPendientes(){

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

    /**
     * Obtener datos del dashboard del estudiante
     * Retorna: nombre, apellido, curso, ficha, actividades asignadas y exámenes pendientes
     */
    public function getDashboardData()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 3) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'No se ha iniciado sesión o no tiene permisos.'
            ], 401);
        }

        try {
            $studentModel = $this->model('student/StudentModel');
            $id_estudiante = $_SESSION['user_id'];

            $dashboardData = $studentModel->getDashboardData($id_estudiante);

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $dashboardData
            ]);

        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al obtener los datos del dashboard: ' . $e->getMessage()
            ], 500);
        }
    }
}
?>