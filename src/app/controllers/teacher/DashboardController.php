<?php
class DashboardController extends Controller
{
    
    private function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    public function index()
    {
        session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            // Redirigir si no está autenticado o no es admin
            header('Location: /auth/login');
            exit;
        }
        // Lógica para mostrar el dashboard del administrador
        $this->view('teacher_panel/dashboard');
    }


   
    public function obtenerResumenProfesor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            try {   
                $modelTeacher = $this->model('teacher/TeacherModel');
                session_start();
                $profesor_id = $_SESSION['user_id'];
                $estadisticas = $modelTeacher->obtener_total_curso_competencias($profesor_id);
                if (!$estadisticas) {
                    return $this->jsonResponse(['status' => 'error', 'message' => 'No se encontraron estadísticas para el profesor.'], 404);
                }   
                $resumen = [
                    'total_cursos' => $estadisticas['total_cursos_activos'],
                    'total_competencias' => $estadisticas['total_competencias']
                ];

                $this->jsonResponse(["status" => "success", "data" => $resumen]);

            } catch (Exception $e) {
                $this->jsonResponse(['status' => 'error', 'message' => 'Error al obtener totales: ' . $e->getMessage()], 500);
            }

        } else {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Método no permitido.'
            ], 405);
        }
    }



    public function obtenerActividadesPendientes()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            try {

                $model = $this->model('teacher/TeacherModel');
                session_start();
                $profesor_id = $_SESSION['user_id'];
                $pendientes = $model->obtener_actividades_pendientes_por_calificar($profesor_id);
                if (!$pendientes) {
                    return $this->jsonResponse(['status' => 'error', 'message' => 'No se encontraron actividades pendientes.'], 404);
                }
                $this->jsonResponse(["status" => "success", "data" => $pendientes]);

            } catch (Exception $e) {
                $this->jsonResponse(['error' => 'Error al obtener datos: ' . $e->getMessage()], 500);
            }

        } else {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Método no permitido.'
            ], 405);
        }
    }

    public function obtenerCursosProfesor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            try {

                
                $model = $this->model('teacher/TeacherModel');
                session_start();
                $profesor_id = $_SESSION['user_id'];
                $cursos = $model->obtener_cursos_por_profesor($profesor_id);
                if (!$cursos) {
                    return $this->jsonResponse(['status' => 'error', 'message' => 'No se encontraron cursos para el profesor.'], 404);
                }   

                return $this->jsonResponse([
                    "status" => "success",
                    "data" => $cursos
                ]);

            } catch (Exception $e) {
                return $this->jsonResponse([
                    'error' => 'Error al obtener cursos: ' . $e->getMessage()
                ], 500);
            }

        } else {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Método no permitido.'
            ], 405);
        }
    }


}
?>