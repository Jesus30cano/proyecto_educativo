<?php
class CourseController extends Controller {
    
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
         if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 1) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('admin_panel/cursos');
    }


    //-----------------------------------------------------------------------------------------------

    public function crearCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($input['ficha']) ||
            !isset($input['nombre_curso']) ||
            !isset($input['id_profesor_lider']) || !is_numeric($input['id_profesor_lider']) ||
            !isset($input['fecha_inicio']) ||
            !isset($input['fecha_fin'])
        ) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o id_profesor_lider no es válido.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->crearCurso(
            $input['ficha'],
            $input['nombre_curso'],
            (int) $input['id_profesor_lider'],
            $input['fecha_inicio'],    
            $input['fecha_fin']
            );

            $this->jsonResponse(["status" => "success","mensaje" => "Curso creado correctamente."]);
        } catch (PDOException $e) {
            $this->jsonResponse(["status" => "error",'mensaje' => 'Error al crear curso: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function editarCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($input['id_curso']) || !is_numeric($input['id_curso']) ||
            !isset($input['ficha']) ||
            !isset($input['nombre_curso']) ||
            !isset($input['id_profesor_lider']) || !is_numeric($input['id_profesor_lider']) ||
            !isset($input['fecha_inicio']) ||
            !isset($input['fecha_fin']) 
        ) {
            $this->jsonResponse(['status' => 'error', 'mensaje' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $ficha_activa = true;

            $adminModel->editarCurso(
                (int) $input['id_curso'],
                $input['ficha'],
                $input['nombre_curso'],
                (int) $input['id_profesor_lider'],
                $ficha_activa,
                $input['fecha_inicio'],
                $input['fecha_fin']
            );

            $this->jsonResponse(['status'  =>'success'  ,'mensaje' => 'Curso actualizado correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['status' => 'error', 'mensaje' => 'Error al actualizar curso: ' . $e->getMessage()], 500);
        }
    }


    //-----------------------------------------------------------------------------------------------

    public function asignarEstudianteACurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !isset($input['id_curso']) || !is_numeric($input['id_usuario']) || !is_numeric($input['id_curso'])) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->asignarEstudianteACurso((int) $input['id_usuario'], (int) $input['id_curso']);
            $this->jsonResponse(['mensaje' => 'Estudiante asignado al curso correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al asignar estudiante al curso: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function removerEstudianteDeCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !isset($input['id_curso']) || !is_numeric($input['id_usuario']) || !is_numeric($input['id_curso'])) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->removerEstudianteDeCurso((int) $input['id_usuario'], (int) $input['id_curso']);
            $this->jsonResponse(['mensaje' => 'Estudiante removido del curso correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al remover estudiante del curso: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function asignarProfesorACurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !isset($input['id_curso']) || !is_numeric($input['id_usuario']) || !is_numeric($input['id_curso'])) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->asignarProfesorACurso((int) $input['id_usuario'], (int) $input['id_curso']);
            $this->jsonResponse(['mensaje' => 'Profesor asignado al curso correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al asignar profesor al curso: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function removerProfesorDeCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !isset($input['id_curso']) || !is_numeric($input['id_usuario']) || !is_numeric($input['id_curso'])) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->removerProfesorDeCurso((int) $input['id_usuario'], (int) $input['id_curso']);
            $this->jsonResponse(['mensaje' => 'Profesor removido del curso correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al remover profesor del curso: ' . $e->getMessage()], 500);
        }
    }


    //-----------------------------------------------------------------------------------------------

    public function reporteNotasPorCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_curso']) || !is_numeric($input['id_curso'])) {
            $this->jsonResponse(['error' => 'Falta o es inválido el id_curso.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $notas = $adminModel->reporteNotasPorCurso((int) $input['id_curso']);
            $this->jsonResponse(['notas' => $notas]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al obtener el reporte de notas por curso: ' . $e->getMessage()], 500);
        }
    }

    public function obtenerInstructoresDisponibles()
    {
        try {
            $adminModel = $this->model('admin/AdminModel');
            $instructores = $adminModel->obtener_instructores_disponibles();
            $this->jsonResponse(['status' => 'success', 'data' => $instructores]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al obtener los instructores disponibles: ' . $e->getMessage()], 500);
        }
    }

    public function mostrarCurso()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $this->jsonResponse(['error' => 'Método no permitido.'], 405);
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $ficha=htmlspecialchars(trim($data['ficha'] ?? ''), ENT_QUOTES, 'UTF-8');

        if (empty($ficha)) {
            $this->jsonResponse(['status' => 'error', 'message' => 'Falta la ficha del curso.'], 400);
        }
        try {
            $adminModel = $this->model('admin/AdminModel');
            $curso = $adminModel->obtener_datos_curso($ficha);
            if ($curso) {
                $this->jsonResponse(['status' => 'success', 'data' => $curso]);
            } else {
                $this->jsonResponse(['status' => 'error', 'message' => 'Curso no encontrado.'], 404);
            }
        } catch (PDOException $e) {
            $this->jsonResponse(['status' => 'error', 'message' => 'Error al obtener el curso: ' . $e->getMessage()], 500);
        }
    }


public function desactivarCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['ficha']) || !isset($input['mensaje'])) {
            $this->jsonResponse(['status' => 'error', 'mensaje' => 'Faltan datos requeridos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->desactivarCursoYLog($input['ficha'], $input['mensaje']);
            $this->jsonResponse(['status' => 'success', 'mensaje' => 'Curso desactivado correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['status' => 'error', 'mensaje' => 'Error al desactivar curso: ' . $e->getMessage()], 500);
        }
    }
}
?>