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
    public function ver_examen() {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('teacher_panel/ver_examen');
    }
  public function obtener_examen() {
    // CAMBIO: Permitir solo POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        return;
    }

    if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
        $this->jsonResponse(['status' => 'error', 'message' => 'No autorizado'], 401);
        return;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    $evaluacionId = $input['id'] ?? null;

    if (!$evaluacionId) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Falta id de examen'], 400);
        return;
    }

    $modelo = $this->model('teacher/TeacherModel');
    $examen = $modelo->obtener_examen_por_id($evaluacionId);

    // Si no se encuentra el examen
    if (!$examen) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Examen no encontrado'], 404);
        return;
    }

    $this->jsonResponse(['status' => 'success', 'data' => $examen]);
}
}
?>