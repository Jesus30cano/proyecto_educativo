<?php
class DashboardController extends Controller
{
    private $adminModel;

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
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 1) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('admin_panel/dashboard');
    }

    //prueba para la dashboard
    public function data()
    {
        
        // Ejemplo de datos (luego los reemplazas con consultas a tus modelos)
        $response = [
            "status" => "success",
            "data" => [
                "totalEstudiantes" => 120,
                "totalProfesores" => 15,
                "totalCursos" => 7,
                "cursos" => [
                    ["curso" => "9C", "nombre" => "Matemáticas", "ficha" => "2933470", "profesor" => "Lopez", "lider" => "Sí", "estudiantes" => 35],
                    ["curso" => "7B", "nombre" => "Lenguaje", "ficha" => "2933480", "profesor" => "Suárez", "lider" => "No", "estudiantes" => 32],
                    ["curso" => "10A", "nombre" => "Inglés", "ficha" => "2933490", "profesor" => "Martínez", "lider" => "Sí", "estudiantes" => 41]
                ]
            ]
        ];

        // Enviar encabezado adecuado
        header("Content-Type: application/json; charset=UTF-8");

        echo json_encode($response);
        exit;
    }

    public function obtenerTotalesActivos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            
        
        try {
            $adminModel = $this->model('admin/AdminModel');
            $totalActivos = $adminModel->obtener_total_activo();
            $this->jsonResponse(["status" => "success", "data" => $totalActivos]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al obtener totales activos: ' . $e->getMessage()], 500);
        }
    }else {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }

}
public function obtenerTotalesCursos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            
        
        try {
            $adminModel = $this->model('admin/AdminModel');
            $totalCursos = $adminModel->obtener_total_cursos();
            $this->jsonResponse(["status" => "success", "data" => $totalCursos]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al obtener totales de cursos: ' . $e->getMessage()], 500);
        }
    }else {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }
}
}
