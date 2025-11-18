<?php
class EvaluationsController extends Controller {

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
         if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('teacher_panel/evaluations');
    }
    public function obtener_evaluaciones() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            $this->jsonResponse(['status' => 'error', 'message' => 'No autorizado'], 401);
        }

        $teacherId = $_SESSION['user_id'];
        $modelo= $this->model('teacher/TeacherModel');
        $evaluaciones = $modelo->obtener_evaluaciones($teacherId);

        $this->jsonResponse(['status' => 'success', 'data' => $evaluaciones]);
    }
}
?>