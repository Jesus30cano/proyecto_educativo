<?php
class AssistanceController extends Controller
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
        $this->view('teacher_panel/assistance');
    }
}