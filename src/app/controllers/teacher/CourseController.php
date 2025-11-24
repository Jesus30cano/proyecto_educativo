<?php

class CourseController extends Controller
{
    private function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {

        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            // Redirigir si no está autenticado o no es teacher
            header('Location: /auth/login');
            exit;
        }
        // Lógica para mostrar el dashboard del administrador
        $this->view('teacher_panel/Courses');
    }

    public function obtenerCursosProfesor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            // Datos de prueba
            $model = $this->model('teacher/TeacherModel');

            $profesor_id = $_SESSION['user_id'];
            $cursos = $model->obtener_cursos_por_profesor($profesor_id);
            if (!$cursos) {
                return $this->jsonResponse(["status" => "error", "message" => "No se encontraron cursos para el profesor."]);
            }
        

            return $this->jsonResponse(["status" => "success", "data" => $cursos]);
        }

        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }

    public function obtenerCursosProfesorSinRepetir()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            // Datos de prueba
            $model = $this->model('teacher/TeacherModel');

            $profesor_id = $_SESSION['user_id'];
            $cursos = $model->fn_cursos_competencias_profesor_sin_repetir($profesor_id);
            if (!$cursos) {
                return $this->jsonResponse(["status" => "error", "message" => "No se encontraron cursos para el profesor."]);
            }
        

            return $this->jsonResponse(["status" => "success", "data" => $cursos]);
        }

        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }

    // este metodo selecciona el curso para trabajar en el panel del profesor, sin exponer el id en la url
    //este metodo recibe el id del curso por post y lo guarda en sesion
    //valida que el curso pertenezca al profesor
    //valida que la solicitud sea valida

    public function seleccionar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $idCurso = $input['id'] ?? null;
        $profesorId = $_SESSION['user_id'] ?? null;

        if (!$idCurso || !is_numeric($idCurso) || !$profesorId) {
            return $this->jsonResponse(['status' => 'error', 'message' => 'Datos inválidos'], 400);
        }

        
        $_SESSION['curso_seleccionado'] = $idCurso;
        return $this->jsonResponse(['status' => 'success']);
    }

    // metodo para ver los detalles del curso seleccionado
    //es de prueba recuerda cambiar por datos reales de la base de datos
    public function ver()
    {
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $idCurso = $_SESSION['curso_seleccionado'] ?? null;
        $profesorId = $_SESSION['user_id'] ?? null;

        if (!$idCurso || !$profesorId) {
            http_response_code(403);
            echo "No autorizado";
            return;
        }

        // 🔹 Datos de prueba: cursos que imparte el profesor 2
        $model = $this->model('teacher/TeacherModel');
        $cursosDelProfesor = $model->obtener_cursos_por_profesor_ver($profesorId);

        $curso = null;
        foreach ($cursosDelProfesor as $c) {
            if ($c['id'] == $idCurso && $c['profesor_id'] == $profesorId) {
                $curso = $c;
                break;
            }
        }

        if (!$curso) {
            http_response_code(403);
            echo "No tienes permiso para ver este curso";
            return;
        }

        // 🔹 Datos de prueba: competencias asociadas al curso
        $competencias = $model->obtener_actividades_competencia($idCurso, $profesorId);
        $this->view('teacher_panel/View_course', [
            'curso' => $curso,
            'competencias' => $competencias
        ]);
    }

}