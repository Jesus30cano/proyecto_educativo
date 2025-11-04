<?php
class AuthController extends Controller
{
    /**
     * Envía una respuesta JSON con el código HTTP indicado
     */
    private function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Manejo de login (GET y POST)
     */
    public function login()
    {
        // ✅ Si es POST → procesar el login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sanitización básica
            $tipo_documento = htmlspecialchars(trim($_POST['tipo_documento'] ?? ''), ENT_QUOTES, 'UTF-8');
            $document = htmlspecialchars(trim($_POST['document'] ?? ''), ENT_QUOTES, 'UTF-8');
            $password = trim($_POST['password'] ?? '');

            // Validaciones
            $errors = [];
            if (empty($tipo_documento)) $errors[] = "Debe seleccionar un tipo de documento.";
            if (empty($document)) $errors[] = "Debe ingresar el número de documento.";
            if (empty($password)) $errors[] = "Debe ingresar la contraseña.";

            if (!empty($errors)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'errors' => $errors
                ], 400);
            }

            try {
                // Buscar usuario en el modelo
                $userModel = $this->model('Users');
                $user = $userModel->buscar_usuario($tipo_documento, $document);

                if (!$user) {
                    return $this->jsonResponse([
                        'status' => 'error',
                        'message' => 'Usuario no encontrado.'
                    ], 404);
                }

                // Verificar contraseña
                if (!password_verify($password, $user['pass'])) {
                    return $this->jsonResponse([
                        'status' => 'error',
                        'message' => 'Contraseña incorrecta.'
                    ], 401);
                }

                // Verificar si está activo
                if (isset($user['activo']) && !$user['activo']) {
                    return $this->jsonResponse([
                        'status' => 'error',
                        'message' => 'El usuario está inactivo.'
                    ], 403);
                }

                // Iniciar sesión
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['user_id'] = $user['id_usuario'];
                $_SESSION['rol'] = $user['id_rol'];

                // Redirección según el rol
                $redirect = '';
                switch ($user['id_rol']) {
                    case 1:
                        $redirect = '/admin/dashboard';
                        break;
                    case 2:
                        $redirect = '/profesor/inicio';
                        break;
                    case 3:
                        $redirect = '/estudiante/inicio';
                        break;
                    default:
                        return $this->jsonResponse([
                            'status' => 'error',
                            'message' => 'Rol no reconocido.'
                        ], 400);
                }

                // ✅ Respuesta exitosa en JSON
                return $this->jsonResponse([
                    'status' => 'success',
                    'message' => 'Inicio de sesión exitoso.',
                    'id_user' => $user['id_usuario'],
                    'usuario' => $user['nombre_usuario'] ?? $document,
                    'rol' => $user['id_rol'],
                    'redirect' => $redirect
                ]);

            } catch (Exception $e) {
                error_log("Error en AuthController@login: " . $e->getMessage());
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Error interno del servidor. Intente más tarde.'
                ], 500);
            }
        }

        // ✅ Si es GET → mostrar la vista del login
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->view('login/login');
        }

        // 🚫 Cualquier otro método no permitido
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }



    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
        exit();
    }

    public function restablecer_contrasena()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = htmlspecialchars(trim($_POST['correo'] ?? ''), ENT_QUOTES, 'UTF-8');

            if (empty($correo)) {
                $this->view('######', ['error' => 'Por favor, ingrese su correo electrónico.']);
                return;
            }

            try {
                $userModel = $this->model('Users');
                $result = $userModel->validar_correo_existente($correo);

                if (!$result || !$result['correo_existente']) {
                    $this->view('#####', ['error' => 'El correo no está registrado.']);
                    return;
                }

                // Aquí iría la lógica para enviar el correo de restablecimiento
                // por hacer 


                $this->view('######', ['success' => 'Se ha enviado un correo para restablecer su contraseña.']);

            } catch (Exception $e) {
                error_log("Error en AuthController@restablecer_contrasena: " . $e->getMessage());
                $this->view('#######', ['error' => 'Error interno. Intente más tarde.']);
            }
        } else {
            $this->view('restablecer_contrasena', ['correo' => $correo]);
        }
    }
}
?>
