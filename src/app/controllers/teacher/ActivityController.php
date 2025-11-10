<?php
class ActivityController extends Controller
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
        $this->view('teacher_panel/activities');
    }

    public function seleccionar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $idCompetencia = $input['id'] ?? null;
        $profesorId = $_SESSION['user_id'] ?? null;

        if (!$idCompetencia || !$profesorId) {
            return $this->jsonResponse(['status' => 'error', 'message' => 'Datos inválidos'], 400);
        }

        // Validar que la competencia pertenece al profesor
        $_SESSION['competencia_seleccionada'] = $idCompetencia;
        return $this->jsonResponse(['status' => 'success']);
    }

    public function crear_actividad()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // --- Sanitizar datos recibidos ---
            $titulo = htmlspecialchars(trim($_POST['titulo'] ?? ''), ENT_QUOTES, 'UTF-8');
            $descripcion = htmlspecialchars(trim($_POST['descripcion'] ?? 'sin descripción'), ENT_QUOTES, 'UTF-8');
            $fecha_entrega = htmlspecialchars(trim($_POST['fecha_entrega'] ?? ''), ENT_QUOTES, 'UTF-8');
            $id_competencia = htmlspecialchars(trim($_POST['competencia'] ?? ''), ENT_QUOTES, 'UTF-8');
            $id_curso = htmlspecialchars(trim($_POST['curso'] ?? ''), ENT_QUOTES, 'UTF-8');
            $id_profesor = htmlspecialchars(trim($_POST['profesor'] ?? ''), ENT_QUOTES, 'UTF-8');

            // --- Validaciones ---
            $errors = [];
            if (empty($titulo))
                $errors[] = "El título es obligatorio.";
            if (empty($fecha_entrega))
                $errors[] = "Debe ingresar una fecha de entrega.";
            if (empty($id_competencia))
                $errors[] = "Debe seleccionar una competencia.";
            if (empty($id_curso))
                $errors[] = "Debe seleccionar un curso.";
            if (empty($id_profesor))
                $errors[] = "No se detectó el profesor.";

            if (!empty($errors)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'errors' => $errors
                ], 400);
            }

            // --- Manejo del archivo ---
            $ruta_archivo = null;

            if (!empty($_FILES['archivo']['name'])) {
                $archivo = $_FILES['archivo'];
                $nombreArchivo = basename($archivo['name']);
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                $permitidos = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'zip'];

                // Validar extensión
                if (!in_array(strtolower($extension), $permitidos)) {
                    return $this->jsonResponse([
                        'status' => 'error',
                        'message' => 'Formato de archivo no permitido.'
                    ], 400);
                }

                // Validar errores de subida
                if ($archivo['error'] !== UPLOAD_ERR_OK) {
                    return $this->jsonResponse([
                        'status' => 'error',
                        'message' => 'Error al subir el archivo.'
                    ], 400);
                }

                // Definir directorio de almacenamiento
                $directorio = __DIR__ . '/../../../storage/documents';


                // Crear nombre único
                $nuevoNombre = uniqid('actividad_', true) . '.' . $extension;
                $ruta_archivo = $directorio . '/' . $nuevoNombre;

                // Mover archivo
                if (!move_uploaded_file($archivo['tmp_name'], $ruta_archivo)) {
                    return $this->jsonResponse([
                        'status' => 'error',
                        'message' => 'No se pudo guardar el archivo.'
                    ], 500);
                }

                // Ruta relativa (para guardar en BD)
                $ruta_archivo = 'storage/documents/' . $nuevoNombre;
            }

            // --- Insertar en BD ---
            try {
                $actividadModel = $this->model('teacher/teacherModel'); // tu modelo
                $resultado = $actividadModel->crear_actividad(
                    $titulo,
                    $descripcion,
                    $fecha_entrega,
                    $ruta_archivo,
                    $id_competencia,
                    $id_curso,
                    $id_profesor
                );

                if ($resultado) {
                    return $this->jsonResponse([
                        'status' => 'success',
                        'message' => 'Actividad creada correctamente.'
                    ], 201);
                } else {
                    return $this->jsonResponse([
                        'status' => 'error',
                        'message' => 'No se pudo registrar la actividad.'
                    ], 500);
                }
            } catch (Exception $e) {
                error_log("Error al crear actividad: " . $e->getMessage());
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Error interno del servidor.'
                ], 500);
            }

        } else {
            // Método no permitido
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Método no permitido.'
            ], 405);
        }
    }
    /*
        public function obtener_actividades()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                // --- Sanitizar datos recibidos ---
                $competencia_id = htmlspecialchars(trim($_GET['competencia'] ?? ''), ENT_QUOTES, 'UTF-8');
                $curso_id = htmlspecialchars(trim($_GET['curso'] ?? ''), ENT_QUOTES, 'UTF-8');
                $profesor_id = htmlspecialchars(trim($_GET['profesor'] ?? ''), ENT_QUOTES, 'UTF-8');

                // --- Validaciones ---
                $errors = [];
                if (empty($competencia_id))
                    $errors[] = "El ID de competencia es obligatorio.";
                if (empty($curso_id))
                    $errors[] = "El ID de curso es obligatorio.";
                if (empty($profesor_id))
                    $errors[] = "El ID de profesor es obligatorio.";

                if (!empty($errors)) {
                    return $this->jsonResponse([
                        'status' => 'error',
                        'errors' => $errors
                    ], 400);
                }

                // --- Obtener actividades ---
                try {
                    $actividadModel = $this->model('teacher/teacherModel'); // tu modelo
                    $actividades = $actividadModel->obtener_actividades($competencia_id, $curso_id, $profesor_id);

                    return $this->jsonResponse([
                        'status' => 'success',
                        'data' => $actividades
                    ], 200);

                } catch (Exception $e) {
                    error_log("Error al obtener actividades: " . $e->getMessage());
                    return $this->jsonResponse([
                        'status' => 'error',
                        'message' => 'Error interno del servidor.'
                    ], 500);
                }

            } else {
                // Método no permitido
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Método no permitido.'
                ], 405);
            }
        }

    */

    //carga la vista de actividades de la competencia
    public function competencia()
    {
        session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            header('Location: /auth/login');
            exit;
        }

        if (!isset($_SESSION['competencia_seleccionada'])) {
            header('Location: /teacher/courses');
            exit;
        }

        $this->view('teacher_panel/competencia');
    }

    //de prueba reemplementar para que conecte con la bd
    public function obtener_competencia()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = htmlspecialchars(trim($_GET['id'] ?? ''), ENT_QUOTES, 'UTF-8');

            if (empty($id)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'ID de competencia no proporcionado.'
                ], 400);
            }

            // Simulación de datos de prueba
            $datosPrueba = [
                '1' => [
                    'id' => 1,
                    'nombre' => 'Desarrolla interfaces web',
                    'descripcion' => 'Construye interfaces responsivas con HTML, CSS y JS.'
                ],
                '2' => [
                    'id' => 2,
                    'nombre' => 'Aplica bases de datos',
                    'descripcion' => 'Diseña y gestiona bases de datos relacionales.'
                ]
            ];

            if (!isset($datosPrueba[$id])) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Competencia no encontrada.'
                ], 404);
            }

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $datosPrueba[$id]
            ], 200);
        }

        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }

    //de prueba descomentar el metodo que conecta con la bd

    public function obtener_actividades()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $competencia_id = htmlspecialchars(trim($_GET['competencia'] ?? ''), ENT_QUOTES, 'UTF-8');

            if (empty($competencia_id)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'ID de competencia no proporcionado.'
                ], 400);
            }

            // Simulación de actividades por competencia
            $actividadesPrueba = [
                '1' => [
                    [
                        'id' => 101,
                        'titulo' => 'Maquetación con Flexbox',
                        'descripcion' => 'Crear una interfaz responsive usando Flexbox.',
                        'fecha_entrega' => '2025-11-15',
                        'archivo' => 'storage/documents/actividad_flexbox.pdf'
                    ],
                    [
                        'id' => 102,
                        'titulo' => 'Landing Page con Bootstrap',
                        'descripcion' => 'Diseñar una landing page con componentes Bootstrap.',
                        'fecha_entrega' => '2025-11-20',
                        'archivo' => null
                    ]
                ],
                '2' => [
                    [
                        'id' => 201,
                        'titulo' => 'Modelo entidad-relación',
                        'descripcion' => 'Diseñar un MER para una tienda online.',
                        'fecha_entrega' => '2025-11-18',
                        'archivo' => 'storage/documents/actividad_mer.docx'
                    ],
                    [
                        'id' => 202,
                        'titulo' => 'Consultas SQL básicas',
                        'descripcion' => 'Escribir consultas SELECT, INSERT y DELETE.',
                        'fecha_entrega' => '2025-11-22',
                        'archivo' => null
                    ]
                ]
            ];

            if (!isset($actividadesPrueba[$competencia_id])) {
                return $this->jsonResponse([
                    'status' => 'success',
                    'data' => []
                ], 200);
            }

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $actividadesPrueba[$competencia_id]
            ], 200);
        }

        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }
}

?>