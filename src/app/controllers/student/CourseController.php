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
         if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 3) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('student_panel/course');
    }

    public function competencias() {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 3) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('student_panel/competencias');
    }

    public function seleccionar()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 3) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'No autorizado.'
            ], 401);
        }

        $input = json_decode(file_get_contents("php://input"), true);
        $id_competencia = $input['id'] ?? null;

        if (!$id_competencia) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Falta el parámetro id_competencia.'
            ], 400);
        }

        // Guardar el ID de la competencia en la sesión
        $_SESSION['id_competencia_seleccionada'] = $id_competencia;

        return $this->jsonResponse([
            'status' => 'success',
            'message' => 'Competencia seleccionada correctamente.'
        ]);
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

    public function obtenerCompetenciasPorEstudiante()
    {
        if (!isset($_SESSION['user_id'])) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'No se ha iniciado sesión.'
            ], 401);
        }

        try {
            $studentModel = $this->model('student/StudentModel');
            $id_usuario = $_SESSION['user_id'];

            $competencias = $studentModel->obtenerCompetenciasPorEstudiante($id_usuario);

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $competencias
            ]);

        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al obtener las competencias: ' . $e->getMessage()
            ], 500);
        }
    }

    //---------------------------------------------------------------------------------------------------------//

    public function obtenerCursoPorEstudiante()
    {
        if (!isset($_SESSION['user_id'])) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'No se ha iniciado sesión.'
            ], 401);
        }

        try {
            $studentModel = $this->model('student/StudentModel');
            $id_usuario = $_SESSION['user_id'];

            $curso = $studentModel->obtenerCursoPorEstudiante($id_usuario);

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $curso
            ]);

        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al obtener el curso: ' . $e->getMessage()
            ], 500);
        }
    }



    //---------------------------------------------------------------------------------------------------------//

    public function obtenerCompetenciasPorCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);
        $id_curso = $input['id_curso'] ?? null;

        if (!$id_curso) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Falta el parámetro id_curso.'
            ], 400);
        }

        try {
            $studentModel = $this->model('student/StudentModel');
            $competencias = $studentModel->obtenerCompetenciasPorCurso($id_curso);

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $competencias
            ]);
        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al obtener las competencias: ' . $e->getMessage()
            ], 500);
        }
    }
}
?>