<?php
class NotificationsController extends Controller {
    
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
        $this->view('teacher_panel/notifications');
    }

    //---------------------------------------------------------------------------------------------------------//

    public function obtenerNotificacionesPorUsuario(){

        if (!isset($_SESSION['user_id'])) {
            return $this->jsonResponse([
            'status' => 'error',
            'message' => 'No se ha iniciado sesión.'
            ], 401);
        }

        try {
            $generalModel = $this->model('general');
            $id_usuario = $_SESSION['user_id'];

            $notificaciones = $generalModel->mostar_notificaciones($id_usuario);

            return $this->jsonResponse([
            'status' => 'success',
            'data' => $notificaciones
            ]);

        } catch (PDOException $e) {
            return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Error al obtener las notificaciones: ' . $e->getMessage()
            ], 500);
        }
    }

    //---------------------------------------------------------------------------------------------------------//

    public function marcarNotificacionLeida(){

        if (!isset($_SESSION['user_id'])) {
            return $this->jsonResponse([
            'status' => 'error',
            'message' => 'No se ha iniciado sesión.'
            ], 401);
        }

        $input = json_decode(file_get_contents("php://input"), true);
        $id_notificacion = $input['id_notificacion'] ?? null;

        if (!$id_notificacion) {
            return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Falta el parámetro id_notificacion.'
            ], 400);
        }

        try {
            $studentModel = $this->model('student/StudentModel');
            $id_usuario = $_SESSION['user_id'];

            $mensaje = $studentModel->marcarNotificacionLeida($id_notificacion, $id_usuario);

            return $this->jsonResponse([
            'status' => 'success',
            'message' => $mensaje
            ]);

        } catch (PDOException $e) {
            return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Error al marcar la notificación como leída: ' . $e->getMessage()
            ], 500);
        }
    }
}
