<?php
class NotifiactionsController extends Controller {
    
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
    public function index()
{
    if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 1) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Acceso no autorizado o sesión no iniciada.'
        ], 401);
    }

    return $this->jsonResponse([
        'status' => 'success',
        'message' => 'Conexión exitosa. Controlador de notifiaciones activo y sesión válida.'
    ]);
}

//-----------------------------------------------------------------------------------------------

public function enviarNotificacionAUsuario()
{
    $input = json_decode(file_get_contents("php://input"), true);

    if (
        !isset($input['id_usuario']) || !is_numeric($input['id_usuario']) ||
        !isset($input['tipo']) ||
        !isset($input['titulo']) ||
        !isset($input['mensaje'])
    ) {
        $this->jsonResponse(['error' => 'Faltan datos requeridos o id_usuario inválido.'], 400);
    }

    try {
        $adminModel = $this->model('admin/AdminModel');
        $resultado = $adminModel->enviarNotificacionAUsuario(
            (int) $input['id_usuario'],
            $input['tipo'],
            $input['titulo'],
            $input['mensaje']
        );

        $this->jsonResponse(['mensaje' => $resultado]);
    } catch (PDOException $e) {
        $this->jsonResponse(['error' => 'Error al enviar notificación: ' . $e->getMessage()], 500);
    }
}


 //-----------------------------------------------------------------------------------------------

public function enviarNotificacionGeneral()
{
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['tipo']) || !isset($input['titulo']) || !isset($input['mensaje'])) {
        $this->jsonResponse(['error' => 'Faltan datos requeridos.'], 400);
    }

    try {
        $id_rol = isset($input['id_rol']) && is_numeric($input['id_rol']) ? (int) $input['id_rol'] : null;
        $adminModel = $this->model('admin/AdminModel');
        $resultado = $adminModel->enviarNotificacionGeneral(
            $input['tipo'],
            $input['titulo'],
            $input['mensaje'],
            $id_rol
        );
        $this->jsonResponse(['mensaje' => $resultado]);
    } catch (PDOException $e) {
        $this->jsonResponse(['error' => 'Error al enviar notificación: ' . $e->getMessage()], 500);
    }
}

//-----------------------------------------------------------------------------------------------

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

//-----------------------------------------------------------------------------------------------

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
?>