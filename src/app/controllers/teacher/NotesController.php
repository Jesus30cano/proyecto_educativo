<?php
class NotesController extends Controller
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
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            header('Location: /auth/login');
            exit;
        }

        $this->view('teacher_panel/Record_notes');
    }

 
    public function obtener_fichas()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'No autorizado.'
            ], 401);
        }

        try {
            $teacherModel = $this->model('teacher/TeacherModel');
            $id_profesor  = $_SESSION['user_id'];

            $fichas = $teacherModel->obtener_fichas_para_notas($id_profesor);

            return $this->jsonResponse([
                'status' => 'success',
                'data'   => $fichas
            ]);
        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Error al obtener fichas: ' . $e->getMessage()
            ], 500);
        }
    }

    
    
    public function obtener_competencias()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'No autorizado.'
            ], 401);
        }

        $id_curso = $_GET['ficha'] ?? null;
        if (!$id_curso) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Falta el parámetro ficha (id_curso).'
            ], 400);
        }

        try {
            $teacherModel = $this->model('teacher/TeacherModel');
            $id_profesor  = $_SESSION['user_id'];

            $competencias = $teacherModel->obtener_competencias_para_notas($id_profesor, $id_curso);

            return $this->jsonResponse([
                'status' => 'success',
                'data'   => $competencias
            ]);
        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Error al obtener competencias: ' . $e->getMessage()
            ], 500);
        }
    }

   
    public function obtener_estudiantes()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'No autorizado.'
            ], 401);
        }

        $id_curso       = $_GET['ficha']       ?? null;
        $id_competencia = $_GET['competencia'] ?? null;

        if (!$id_curso || !$id_competencia) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Faltan parámetros ficha o competencia.'
            ], 400);
        }

        try {
            $teacherModel = $this->model('teacher/TeacherModel');
            $estudiantes  = $teacherModel->obtener_estudiantes_notas_competencia($id_curso, $id_competencia);

            // Opcional: adaptar texto de estado
            foreach ($estudiantes as &$e) {
                // nota viene como 'aprobado' / 'reprobado' o NULL
                if ($e['nota'] === null) {
                    $e['estado'] = 'Pendiente';
                } else {
                    $e['estado'] = ($e['nota'] === 'aprobado') ? 'Aprobado' : 'No aprobado';
                }
            }

            return $this->jsonResponse([
                'status' => 'success',
                'data'   => $estudiantes
            ]);
        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Error al obtener estudiantes: ' . $e->getMessage()
            ], 500);
        }
    }

   
    public function guardar_notas()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'No autorizado.'
            ], 401);
        }

        $input = json_decode(file_get_contents("php://input"), true);

        $id_competencia = $input['competencia'] ?? null;
        $notas          = $input['notas']        ?? [];

        if (!$id_competencia || !is_array($notas)) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Datos inválidos para guardar notas.'
            ], 400);
        }

        $id_profesor = $_SESSION['user_id'];

        try {
            $teacherModel = $this->model('teacher/TeacherModel');

            foreach ($notas as $n) {
                $id_estudiante = $n['id']   ?? null;
                $nota          = $n['nota'] ?? null;

                // Si no hay nota seleccionada, la saltamos
                if (!$id_estudiante || !$nota) {
                    continue;
                }

                // Validar que el valor coincida con el ENUM: 'aprobado' o 'reprobado'
                if (!in_array($nota, ['aprobado', 'reprobado'], true)) {
                    continue;
                }

                $teacherModel->guardar_nota_competencia(
                    (int)$id_estudiante,
                    (int)$id_competencia,
                    (int)$id_profesor,
                    $nota
                );
            }

            return $this->jsonResponse([
                'status'  => 'success',
                'message' => 'Notas guardadas correctamente.'
            ]);
        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Error al guardar notas: ' . $e->getMessage()
            ], 500);
        }
    }
}