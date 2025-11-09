<?php

class CourseController extends Controller
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
        $this->view('teacher_panel/Courses');
    }

    public function obtenerCursosProfesor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            // Datos de prueba
            $cursos = [
                [
                    "id_curso" => 1,
                    "nombre_curso" => "Desarrollo Web",
                    "ficha" => "256789A",
                    "estado" => "Activo" //sujeto a cambio
                ],
                [
                    "id_curso" => 2,
                    "nombre_curso" => "Base de Datos",
                    "ficha" => "256789A",
                    "estado" => "Activo" //sujeto a cambio
                ],
                [
                    "id_curso" => 3,
                    "nombre_curso" => "Ingeniería de Software",
                    "ficha" => "246712B",
                    "estado" => "Activo" //sujeto a cambio
                ]
            ];

            return $this->jsonResponse(["status" => "success", "data" => $cursos]);
        }

        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }


    // no sirve para nada, eliminar despues las rutas no me estan funcionando
    public function ver($idCurso)
    {
        // Datos de prueba (después se reemplazan con BD)
        $curso = [
            "id" => $idCurso,
            "nombre" => "Desarrollo Web",
            "ficha" => "256789A"
        ];

        $competencias = [
            [
                "id" => 1,
                "nombre" => "Desarrolla interfaces web",
                "descripcion" => "Construye interfaces responsivas con HTML, CSS y JS.",
                "actividades" => 5
            ],
            [
                "id" => 2,
                "nombre" => "Aplica bases de datos",
                "descripcion" => "Diseña y gestiona bases de datos relacionales.",
                "actividades" => 3
            ]
        ];

        require_once __DIR__ . "/../../views/teacher_panel/View_course.php";
    }

}