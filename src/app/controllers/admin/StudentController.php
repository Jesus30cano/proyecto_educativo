<?php
class StudentController extends Controller {
    
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
        $this->view('admin_panel/estudiantes');
    }



    //-----------------------------------------------------------------------------------------------

    public function reporteNotasEstudiante()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !is_numeric($input['id_usuario'])) {
            $this->jsonResponse(['error' => 'Falta o es inválido el id_usuario.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $notas = $adminModel->reporteNotasEstudiante((int) $input['id_usuario']);
            $this->jsonResponse(['notas' => $notas]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al obtener el reporte de notas: ' . $e->getMessage()], 500);
        }
    }



    
    //-----------------------------------------------------------------------------------------------

    public function obtenerBoletinEstudiante()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !is_numeric($input['id_usuario'])) {
            $this->jsonResponse(['error' => 'Falta o es inválido el id_usuario.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $boletin = $adminModel->obtenerBoletinEstudiante((int) $input['id_usuario']);
            $this->jsonResponse(['boletin' => $boletin]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al obtener el boletín del estudiante: ' . $e->getMessage()], 500);
        }
    }
    
}
?>