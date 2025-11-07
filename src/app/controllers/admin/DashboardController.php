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

    //-----------------------------------------------------------------------------------------------

    public function registrarUsuario()
    {
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Obtener y sanitizar datos de entrada
        $email = htmlspecialchars(trim($_POST['email'] ?? ''), ENT_QUOTES, 'UTF-8');
        $tipo_documento = htmlspecialchars(trim($_POST['tipo_documento'] ?? ''), ENT_QUOTES, 'UTF-8');
        $no_documento = htmlspecialchars(trim($_POST['no_documento'] ?? ''), ENT_QUOTES, 'UTF-8');
        $password = trim($_POST['password'] ?? ''); 
        $id_rol = isset($_POST['id_rol']) ? (int)$_POST['id_rol'] : null;
        // Validaciones básicas
        $errors = [];
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "El email es inválido.";
        }
        if (empty($tipo_documento)) {
            $errors[] = "El tipo de documento es obligatorio.";
        }
        if (empty($no_documento)) {
            $errors[] = "El número de documento es obligatorio.";
        }
        if (empty($password) || strlen($password) < 6) {
            $errors[] = "La contraseña debe tener al menos 6 caracteres.";
        }
        if (empty($id_rol) || !is_numeric($id_rol)) {
            $errors[] = "El rol es inválido.";
        }
        if (!empty($errors)) {
            return $this->jsonResponse([
                'status' => 'error',
                'errors' => $errors
            ], 400);
        }

        try {
            // Hashear la contraseña
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            // Llamar al modelo para registrar el usuario
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->adminRegistrarUsuario($email, $tipo_documento, $no_documento, $password_hashed, $id_rol);

            return $this->jsonResponse([
                'status' => 'success',
                'message' => 'Usuario registrado exitosamente.'
            ]);
        } catch (PDOException $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al registrar el usuario: ' . $e->getMessage()
            ], 500);
        }


       }else {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
       }
    }

    //-----------------------------------------------------------------------------------------------

    public function listarUsuariosPorIdRol()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_rol']) || !is_numeric($input['id_rol'])) {
            $this->jsonResponse(['error' => 'Falta o es inválido el id_rol.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            
            $usuarios = $adminModel->listarUsuariosPorIdRol((int)$input['id_rol']);
            $this->jsonResponse(['usuarios' => $usuarios]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al listar usuarios: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function desactivarUsuario()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !is_numeric($input['id_usuario'])) {
            $this->jsonResponse(['error' => 'Falta o es inválido el id_usuario.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->desactivarUsuario((int)$input['id_usuario']);
            $this->jsonResponse(['mensaje' => 'Usuario desactivado correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al desactivar usuario: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function actualizarUsuario()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($input['id_usuario']) || !is_numeric($input['id_usuario']) ||
            !isset($input['email']) ||
            !isset($input['password']) ||
            !isset($input['id_rol']) || !is_numeric($input['id_rol'])
        ) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $password_hashed = password_hash($input['password'], PASSWORD_DEFAULT);
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->actualizarUsuario(
                (int)$input['id_usuario'],
                $input['email'],
                $password_hashed,
                (int)$input['id_rol']
            );

            $this->jsonResponse(['mensaje' => 'Usuario actualizado correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al actualizar usuario: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function activarUsuario()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !is_numeric($input['id_usuario'])) {
            $this->jsonResponse(['error' => 'Falta o es inválido el id_usuario.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->activarUsuario((int)$input['id_usuario']);
            $this->jsonResponse(['mensaje' => 'Usuario activado correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al activar usuario: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function crearCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($input['ficha']) ||
            !isset($input['nombre_curso']) ||
            !isset($input['id_profesor_lider']) || !is_numeric($input['id_profesor_lider'])
        ) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o id_profesor_lider no es válido.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->crearCurso(
                $input['ficha'],
                $input['nombre_curso'],
                (int)$input['id_profesor_lider']
            );

            $this->jsonResponse(['mensaje' => 'Curso creado correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al crear curso: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function editarCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($input['id_curso']) || !is_numeric($input['id_curso']) ||
            !isset($input['ficha']) ||
            !isset($input['nombre_curso']) ||
            !isset($input['id_profesor_lider']) || !is_numeric($input['id_profesor_lider']) ||
            !isset($input['ficha_activa'])
        ) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $ficha_activa = filter_var($input['ficha_activa'], FILTER_VALIDATE_BOOLEAN);

            $adminModel->editarCurso(
                (int)$input['id_curso'],
                $input['ficha'],
                $input['nombre_curso'],
                (int)$input['id_profesor_lider'],
                $ficha_activa
            );

            $this->jsonResponse(['mensaje' => 'Curso actualizado correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al actualizar curso: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function asignarEstudianteACurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !isset($input['id_curso']) || !is_numeric($input['id_usuario']) || !is_numeric($input['id_curso'])) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->asignarEstudianteACurso((int)$input['id_usuario'], (int)$input['id_curso']);
            $this->jsonResponse(['mensaje' => 'Estudiante asignado al curso correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al asignar estudiante al curso: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function removerEstudianteDeCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !isset($input['id_curso']) || !is_numeric($input['id_usuario']) || !is_numeric($input['id_curso'])) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->removerEstudianteDeCurso((int)$input['id_usuario'], (int)$input['id_curso']);
            $this->jsonResponse(['mensaje' => 'Estudiante removido del curso correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al remover estudiante del curso: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function asignarProfesorACurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !isset($input['id_curso']) || !is_numeric($input['id_usuario']) || !is_numeric($input['id_curso'])) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->asignarProfesorACurso((int)$input['id_usuario'], (int)$input['id_curso']);
            $this->jsonResponse(['mensaje' => 'Profesor asignado al curso correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al asignar profesor al curso: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function removerProfesorDeCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !isset($input['id_curso']) || !is_numeric($input['id_usuario']) || !is_numeric($input['id_curso'])) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos o son inválidos.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->removerProfesorDeCurso((int)$input['id_usuario'], (int)$input['id_curso']);
            $this->jsonResponse(['mensaje' => 'Profesor removido del curso correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al remover profesor del curso: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function reporteNotasEstudiante()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !is_numeric($input['id_usuario'])) {
            $this->jsonResponse(['error' => 'Falta o es inválido el id_usuario.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $notas = $adminModel->reporteNotasEstudiante((int)$input['id_usuario']);
            $this->jsonResponse(['notas' => $notas]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al obtener el reporte de notas: ' . $e->getMessage()], 500);
        }
    }

    //-----------------------------------------------------------------------------------------------

    public function reporteNotasPorCurso()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_curso']) || !is_numeric($input['id_curso'])) {
            $this->jsonResponse(['error' => 'Falta o es inválido el id_curso.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $notas = $adminModel->reporteNotasPorCurso((int)$input['id_curso']);
            $this->jsonResponse(['notas' => $notas]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al obtener el reporte de notas por curso: ' . $e->getMessage()], 500);
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
            $id_rol = isset($input['id_rol']) && is_numeric($input['id_rol']) ? (int)$input['id_rol'] : null;
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
                (int)$input['id_usuario'],
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

    public function obtenerBoletinEstudiante()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['id_usuario']) || !is_numeric($input['id_usuario'])) {
            $this->jsonResponse(['error' => 'Falta o es inválido el id_usuario.'], 400);
        }

        try {
            $adminModel = $this->model('admin/AdminModel');
            $boletin = $adminModel->obtenerBoletinEstudiante((int)$input['id_usuario']);
            $this->jsonResponse(['boletin' => $boletin]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al obtener el boletín del estudiante: ' . $e->getMessage()], 500);
        }
    }
public function crearDatosPersonales()
    {
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Obtener y sanitizar datos de entrada
        $id_usuario = isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : null;
        $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''), ENT_QUOTES, 'UTF-8');
        $apellido = htmlspecialchars(trim($_POST['apellido'] ?? ''), ENT_QUOTES, 'UTF-8');
        $fecha_nacimiento = htmlspecialchars(trim($_POST['fecha_nacimiento'] ?? ''), ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars(trim($_POST['telefono'] ?? ''), ENT_QUOTES, 'UTF-8');
        $direccion = htmlspecialchars(trim($_POST['direccion'] ?? ''), ENT_QUOTES, 'UTF-8');
        $genero = htmlspecialchars(trim($_POST['genero'] ?? ''), ENT_QUOTES, 'UTF-8');

        // Validaciones básicas
        $errors = [];
        if (empty($id_usuario) || !is_numeric($id_usuario)) {
            $errors[] = "El ID de usuario es inválido.";
        }
        if (empty($nombre)) {
            $errors[] = "El nombre es obligatorio.";
        }
        if (empty($apellido)) {
            $errors[] = "El apellido es obligatorio.";
        }
        if (empty($fecha_nacimiento)) {
            $errors[] = "La fecha de nacimiento es obligatoria.";
        }
        if (empty($telefono)) {
            $errors[] = "El teléfono es obligatorio.";
        }
        if (empty($direccion)) {
            $errors[] = "La dirección es obligatoria.";
        }
        if (empty($genero)) {
            $errors[] = "El género es obligatorio.";
        }
        if (!empty($errors)) {
            return $this->jsonResponse([
                'status' => 'error',
                'errors' => $errors
            ], 400);
        }

        try {
            // Llamar al modelo para crear los datos personales
            $adminModel = $this->model('admin/AdminModel');
            $adminModel->crear_datos_personales($id_usuario, $nombre, $apellido, $fecha_nacimiento, $telefono, $direccion, $genero);

            return $this->jsonResponse([
                'status' => 'success',
                'message' => 'Datos personales creados exitosamente.'
            ]); 

            }
        catch (PDOException $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al crear los datos personales: ' . $e->getMessage()
            ], 500);
        }
    }else {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }
}


}
