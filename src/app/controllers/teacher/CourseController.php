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

    public function index()
    {
        session_start();

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
        try {
            $teacherModel = $this->model('teacher/TeacherModel');

            $cursos = $teacherModel->obtener_cursos_por_profesor($_SESSION['user_id']);
            
            return $this->jsonResponse(['status' => 'success', 'data' => $cursos]);

        } catch (PDOException $e) {
            return $this -> jsonResponse(['status' => 'error', 'message' => 'Error al obtener cursos: ' . $e->getMessage()], 500);
        }
    }


    // este metodo selecciona el curso para trabajar en el panel del profesor, sin exponer el id en la url
    //este metodo recibe el id del curso por post y lo guarda en sesion
    //valida que el curso pertenezca al profesor
    //valida que la solicitud sea valida

    public function seleccionar()
{
    // Validar método
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido'
        ], 405);
    }

    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Validar que el intructor haya iniciado
    if (!isset($_SESSION['user_id'])) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Sesión no válida'
        ], 401);
    }

    $input = json_decode(file_get_contents('php://input'), true);
    $idCurso = $input['id'] ?? null;
    $profesorId = $_SESSION['user_id'];

    if (!$idCurso || !is_numeric($idCurso)) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'ID de curso inválido'
        ], 400);
    }

    try {

        
        $teacherModel = $this->model('teacher/TeacherModel');

        // Obtener los cursos del profesor desde la DatraBase
        $cursosDelProfesor = $teacherModel->obtener_cursos_por_profesor($profesorId);

        // Validar que el curso que quiere seleccionar le pertenece al instructor
        $cursoValido = false;
        foreach ($cursosDelProfesor as $curso) {
            if ($curso['id_curso'] == $idCurso) {
                $cursoValido = true;
                break;
            }
        }

        if (!$cursoValido) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Acceso denegado: el curso no pertenece al profesor.'
            ], 403);
        }

        // Guardmos el curso seleccionado en la sesión
        $_SESSION['curso_seleccionado'] = $idCurso;

        return $this->jsonResponse([
            'status' => 'success',
            'message' => 'Curso seleccionado correctamente.'
        ]);

    } catch (PDOException $e) {

        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Error al seleccionar curso: ' . $e->getMessage()
        ], 500);
    }
}


    
public function ver()
{
    try {
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

        
        $teacherModel = $this->model('teacher/TeacherModel');
        $cursos = $teacherModel->obtener_cursos_con_competencias_asignadas($profesorId);

        if (!$cursos) {
            http_response_code(403);
            echo "No tienes cursos asignados.";
            return;
        }

        
        $curso = null;
        $competencias = [];

        foreach ($cursos as $row) {

            if ($row['id_curso'] == $idCurso) {

                
                if ($curso === null) {
                    $curso = [
                        'id' => $row['id_curso'],
                        'nombre' => $row['curso'],
                        'ficha' => $row['ficha'],
                        'ficha_activa' => $row['ficha_activa']
                    ];
                }

               
                $competencias[] = [
                    'id' => $row['id_competencia'],
                    'codigo' => $row['codigo_competencia'],
                    'nombre' => $row['competencia'],
                    'descripcion' => $row['descripcion_competencia']
                ];
            }
        }

        
        if ($curso === null) {
            http_response_code(403);
            echo "No tienes permiso para ver este curso.";
            return;
        }

        
        $this->view('teacher_panel/View_course', [
            'curso' => $curso,
            'competencias' => $competencias
        ]);

    } catch (PDOException $e) {
        http_response_code(500);
        echo "Error del servidor: " . $e->getMessage();
    }
}



}