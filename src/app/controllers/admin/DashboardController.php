<?php

require_once __DIR__ . "/../../models/AdminModel.php";

class DashboardController extends Controller
{
    private $adminModel;

    public function __construct()
    {
        session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 1) {
            header('Location: /auth/login');
            exit;
        }

        $this->adminModel = new AdminModel();
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
        $input = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($input['email']) ||
            !isset($input['tipo_documento']) ||
            !isset($input['no_documento']) ||
            !isset($input['password']) ||
            !isset($input['id_rol'])
        ) {
            $this->jsonResponse(['error' => 'Faltan datos requeridos.'], 400);
        }

        try {
            $password_hashed = password_hash($input['password'], PASSWORD_DEFAULT);

            $this->adminModel->adminRegistrarUsuario(
                $input['email'],
                $input['tipo_documento'],
                $input['no_documento'],
                $password_hashed,
                (int)$input['id_rol']
            );

            $this->jsonResponse(['mensaje' => 'Usuario registrado correctamente.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al registrar usuario: ' . $e->getMessage()], 500);
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
            $usuarios = $this->adminModel->listarUsuariosPorIdRol((int)$input['id_rol']);
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
            $this->adminModel->desactivarUsuario((int)$input['id_usuario']);
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

            $this->adminModel->actualizarUsuario(
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
            $this->adminModel->activarUsuario((int)$input['id_usuario']);
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
            $this->adminModel->crearCurso(
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
            $ficha_activa = filter_var($input['ficha_activa'], FILTER_VALIDATE_BOOLEAN);

            $this->adminModel->editarCurso(
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
            $this->adminModel->asignarEstudianteACurso((int)$input['id_usuario'], (int)$input['id_curso']);
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
            $this->adminModel->removerEstudianteDeCurso((int)$input['id_usuario'], (int)$input['id_curso']);
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
            $this->adminModel->asignarProfesorACurso((int)$input['id_usuario'], (int)$input['id_curso']);
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
            $this->adminModel->removerProfesorDeCurso((int)$input['id_usuario'], (int)$input['id_curso']);
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
            $notas = $this->adminModel->reporteNotasEstudiante((int)$input['id_usuario']);
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
            $notas = $this->adminModel->reporteNotasPorCurso((int)$input['id_curso']);
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

            $resultado = $this->adminModel->enviarNotificacionGeneral(
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
            $resultado = $this->adminModel->enviarNotificacionAUsuario(
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
            $boletin = $this->adminModel->obtenerBoletinEstudiante((int)$input['id_usuario']);
            $this->jsonResponse(['boletin' => $boletin]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Error al obtener el boletín del estudiante: ' . $e->getMessage()], 500);
        }
    }
}
