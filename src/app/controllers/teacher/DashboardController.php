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


    /* ================================
   Todas estas funciones son de prueba, corregir luego
================================ */
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

                // Datos de prueba (luego reemplazar por una consulta real)
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



    public function obtenerEstudiantesCurso()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Método no permitido.'
            ], 405);
        }

        if (!isset($_GET['id_curso']) || !is_numeric($_GET['id_curso'])) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Id de curso requerido.'
            ], 400);
        }

        $id_curso = (int) $_GET['id_curso'];

        try {
            session_start();


            $model = $this->model('teacher/TeacherModel');
            $estudiantes = $model->obtener_estudiantes_por_curso($id_curso);

            if (!$estudiantes) {
                return $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'No se encontraron estudiantes para este curso.'
                ], 404);
            }

            return $this->jsonResponse([
                'status' => 'success',
                'data'   => $estudiantes
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Error al obtener estudiantes: ' . $e->getMessage()
            ], 500);
        }
    }


    public function registrarAsistenciaDia()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }

        $input = json_decode(file_get_contents('php://input'), true);

        session_start();
        $idProfesor = $_SESSION['user_id'];

        $model = $this->model('teacher/TeacherModel');

        foreach ($input['asistencias'] as $a) {
            $model->registrar_asistencia(
                $idProfesor,
                $a['id_estudiante_curso'],
                $a['estado'],
                $a['observaciones']
            );
        }

        return $this->jsonResponse(['status' => 'success', 'message' => 'Asistencia registrada']);
    }


    public function obtenerAsistencias(){
    session_start();

    // Validar sesión y rol profesor
    if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
        $this->jsonResponse([
            "status"  => "error",
            "message" => "Acceso denegado"
        ], 403);
    }

    $id_profesor = (int) $_SESSION['user_id'];

    // Filtros recibidos desde la vista
    $id_curso = $_GET['id_curso'] ?? null;
    $fecha    = $_GET['fecha'] ?? null;

    try {
        $model = $this->model('teacher/TeacherModel');

        // Usamos SIEMPRE la misma función.
        // Si $id_curso es null o "", fn_asistencias_profesor traerá
        // TODAS las asistencias de TODOS los cursos de ese profesor.
        $asistencias = $model->obtener_asistencias(
            $id_profesor,
            $id_curso,
            $fecha
        );

        $this->jsonResponse([
            "status" => "success",
            "data"   => $asistencias
        ]);
    } catch (Exception $e) {
        $this->jsonResponse([
            "status"  => "error",
            "message" => "Error al obtener asistencias: " . $e->getMessage()
        ], 500);
    }
}


}
?>