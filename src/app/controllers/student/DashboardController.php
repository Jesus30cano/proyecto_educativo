<?php
class DashboardController extends Controller
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
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 3) {
            // Redirigir si no está autenticado
            header('Location: /auth/login');
            exit;
        }
        $this->view('student_panel/dashboard');
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

    //---------------------------------------------------------------------------------------------------------//

    public function subirEntregaActividad()
    {
        if (!isset($_SESSION['user_id'])) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'No se ha iniciado sesión.'
            ], 401);
        }

        $input = json_decode(file_get_contents("php://input"), true);
        $id_actividad = $input['id_actividad'] ?? null;
        $titulo = $input['titulo'] ?? null;
        $descripcion = $input['descripcion'] ?? '';
        $ruta_archivo = $input['ruta_archivo'] ?? null;

        if (!$id_actividad || !$titulo || !$ruta_archivo) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Faltan parámetros obligatorios.'
            ], 400);
        }

        try {
            $studentModel = $this->model('student/StudentModel');
            $id_estudiante = $_SESSION['user_id'];

            $studentModel->subirEntregaActividad($id_actividad, $id_estudiante, $titulo, $descripcion, $ruta_archivo);

            return $this->jsonResponse([
                'status' => 'success',
                'message' => 'Entrega subida correctamente.'
            ]);

        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al subir la entrega: ' . $e->getMessage()
            ], 500);
        }
    }





    
    //---------------------------------------------------------------------------------------------------------//



    public function obtenerActividadesPendientes()
{
    if (!isset($_SESSION['user_id'])) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'No se ha iniciado sesión.'
        ], 401);
    }

    try {
        $studentModel = $this->model('student/StudentModel');
        $id_estudiante = $_SESSION['user_id'];

        $actividades = $studentModel->obtenerActividadesPendientes($id_estudiante);

        return $this->jsonResponse([
            'status' => 'success',
            'data' => $actividades
        ]);

    } catch (PDOException $e) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Error al obtener las actividades pendientes: ' . $e->getMessage()
        ], 500);
    }
}







//---------------------------------------------------------------------------------------------------------//





public function obtenerCalificacionesPorEstudiante()
{
    if (!isset($_SESSION['user_id'])) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'No se ha iniciado sesión.'
        ], 401);
    }

    try {
        $studentModel = $this->model('student/StudentModel');
        $id_estudiante = $_SESSION['user_id'];

        $calificaciones = $studentModel->obtenerCalificacionesPorEstudiante($id_estudiante);

        return $this->jsonResponse([
            'status' => 'success',
            'data' => $calificaciones
        ]);

    } catch (PDOException $e) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Error al obtener las calificaciones: ' . $e->getMessage()
        ], 500);
    }
}





//---------------------------------------------------------------------------------------------------------//




public function obtenerCalificacionesExamenes()
{
    if (!isset($_SESSION['user_id'])) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'No se ha iniciado sesión.'
        ], 401);
    }

    try {
        $studentModel = $this->model('student/StudentModel');
        $id_estudiante = $_SESSION['user_id'];

        $calificaciones = $studentModel->obtenerCalificacionesExamenes($id_estudiante);

        return $this->jsonResponse([
            'status' => 'success',
            'data' => $calificaciones
        ]);

    } catch (PDOException $e) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Error al obtener las calificaciones de exámenes: ' . $e->getMessage()
        ], 500);
    }
}










//---------------------------------------------------------------------------------------------------------//



public function obtenerNotificacionesPorUsuario()
{
    if (!isset($_SESSION['user_id'])) {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'No se ha iniciado sesión.'
        ], 401);
    }

    try {
        $studentModel = $this->model('general');
        $id_usuario = $_SESSION['user_id'];

        $notificaciones = $studentModel->mostar_notificaciones($id_usuario);

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




public function marcarNotificacionLeida()
{
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