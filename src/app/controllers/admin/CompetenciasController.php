<?php
class CompetenciasController extends Controller {
    
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
        $this->view('admin_panel/Competencias');
    }
    public function obtenerTotalesCompetencias() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $adminModel = $this->model('admin/AdminModel');
            $totales = $adminModel->total_competencia();
            $this->jsonResponse(['status' => 'success', 'data' => $totales]);
        } else {
            $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }
    }
    public function obtenerCompetencias() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $adminModel = $this->model('admin/AdminModel');
            $competencias = $adminModel->obtener_todas_competencias();
            $this->jsonResponse(['status' => 'success', 'data' => $competencias]);
        } else {
            $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }
    }
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $nombre = $data['nombre'] ?? null;
            $codigo = $data['codigo'] ?? null;
            $descripcion = $data['descripcion'] ?? null;
            $instructor_id = $data['instructor_id'] ?? null;

            if (!$nombre || !$codigo || !$descripcion || !$instructor_id) {
                $this->jsonResponse(['status' => 'error', 'message' => 'Faltan datos requeridos'], 400);
            }

            $adminModel = $this->model('admin/AdminModel');
            $resultado = $adminModel->crear_competencia($nombre, $codigo, $descripcion, $instructor_id);

            if ($resultado) {
                $this->jsonResponse(['status' => 'success', 'message' => 'Competencia creada exitosamente']);
            } else {
                $this->jsonResponse(['status' => 'error', 'message' => 'No se pudo crear la competencia'], 500);
            }
        } else {
            $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }
    }
    public function buscarCompetencia() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $id_competencia = $data['id_competencia'] ?? null;

            if (!$id_competencia) {
                $this->jsonResponse(['status' => 'error', 'message' => 'Falta el ID de la competencia'], 400);
            }

            $adminModel = $this->model('admin/AdminModel');
            $competencia = $adminModel->obtener_competencia_por_id($id_competencia);

            if ($competencia) {
                $this->jsonResponse(['status' => 'success', 'data' => $competencia]);
            } else {
                $this->jsonResponse(['status' => 'error', 'message' => 'Competencia no encontrada'], 404);
            }
        } else {
            $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }
    }   
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id_competencia'] ?? null;
            $nombre = $data['nombre'] ?? null;
            $codigo = $data['codigo'] ?? null;
            $descripcion = $data['descripcion'] ?? null;
            $instructor_id = $data['instructor_id'] ?? null;

            if (!$id || !$nombre || !$codigo || !$descripcion || !$instructor_id) {
                $this->jsonResponse(['status' => 'error', 'message' => 'Faltan datos requeridos'], 400);
            }

            $adminModel = $this->model('admin/AdminModel');
            $resultado = $adminModel->actualizar_competencia($id, $nombre, $codigo, $descripcion, $instructor_id);

            if ($resultado) {
                $this->jsonResponse(['status' => 'success', 'message' => 'Competencia actualizada exitosamente']);
            } else {
                $this->jsonResponse(['status' => 'error', 'message' => 'No se pudo actualizar la competencia'], 500);
            }
        } else {
            $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }
    }

}
?>