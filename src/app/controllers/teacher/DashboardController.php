<?php
class DashboardController extends Controller
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
            // Redirigir si no está autenticado o no es admin
            header('Location: /auth/login');
            exit;
        }
        // Lógica para mostrar el dashboard del administrador
        $this->view('teacher_panel/dashboard');
    }


    /* ================================
   Todas estas funciones son de prueba, corregir luego
================================ */
    public function obtenerResumenProfesor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            try {

                $resumen = [
                    "total_cursos" => 3,
                    "total_actividades_pendientes" => 12
                ];

                $this->jsonResponse(["status" => "success", "data" => $resumen]);

            } catch (Exception $e) {
                $this->jsonResponse(['error' => 'Error al obtener totales: ' . $e->getMessage()], 500);
            }

        } else {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Método no permitido.'
            ], 405);
        }
    }



    public function obtenerActividadesPendientes()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            try {

                // Datos de prueba (luego reemplazamos por modelo real)
                $pendientes = [
                    [
                        'ficha' => '2080215',
                        'curso' => 'Programación Web',
                        'competencia' => 'Desarrollar aplicaciones cliente-servidor',
                        'actividad' => 'Taller #3: CRUD',
                        'fecha_entrega' => '2025-08-14'
                    ],
                    [
                        'ficha' => '2567894',
                        'curso' => 'Bases de Datos',
                        'competencia' => 'Modelar estructuras de datos',
                        'actividad' => 'Proyecto ER',
                        'fecha_entrega' => '2025-08-20'
                    ]
                ];

                $this->jsonResponse(["status" => "success", "data" => $pendientes]);

            } catch (Exception $e) {
                $this->jsonResponse(['error' => 'Error al obtener datos: ' . $e->getMessage()], 500);
            }

        } else {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Método no permitido.'
            ], 405);
        }
    }

    public function obtenerCursosProfesor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            try {

                // Datos de prueba (luego reemplazar por una consulta real)
                $cursos = [
                    [
                        'curso' => 'Programación Web',
                        'ficha' => '2080215',
                        'competencia' => 'Aplicaciones Cliente-Servidor'
                    ],
                    [
                        'curso' => 'Bases de Datos',
                        'ficha' => '2567894',
                        'competencia' => 'Modelado y Normalización de BD'
                    ],
                    [
                        'curso' => 'Análisis de Sistemas',
                        'ficha' => '2098874',
                        'competencia' => 'Análisis y Diseño UML'
                    ]
                ];

                return $this->jsonResponse([
                    "status" => "success",
                    "data" => $cursos
                ]);

            } catch (Exception $e) {
                return $this->jsonResponse([
                    'error' => 'Error al obtener cursos: ' . $e->getMessage()
                ], 500);
            }

        } else {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Método no permitido.'
            ], 405);
        }
    }


}
?>