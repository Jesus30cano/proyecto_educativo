<?php
class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sanitización básica
            $tipo_doc = htmlspecialchars(trim($_POST['tipo_doc'] ?? ''), ENT_QUOTES, 'UTF-8');
            $cedula = htmlspecialchars(trim($_POST['cedula'] ?? ''), ENT_QUOTES, 'UTF-8');
            $password = trim($_POST['password'] ?? '');

            //  Validar campos vacíos
            if (empty($tipo_doc) || empty($cedula) || empty($password)) {
                $this->view('login', ['error' => 'Por favor, complete todos los campos.']);
                return;
            }

            try {
                //  Llamar al modelo
                $userModel = $this->model('Users');
                $user = $userModel->login($tipo_doc, $cedula); // Solo cedula y tipo_doc

                //  Validar existencia
                if (!$user) {
                    $this->view('login', ['error' => 'Usuario no encontrado.']);
                    return;
                }

                //  Verificar contraseña (hash)
                if (!password_verify($password, $user['password_hash'])) {
                    $this->view('login', ['error' => 'Contraseña incorrecta.']);
                    return;
                }

                //  Verificar si el usuario está activo
                if (!$user['activo']) {
                    $this->view('login', ['error' => 'El usuario está inactivo.']);
                    return;
                }

                //  Iniciar sesión
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['user_id'] = $user['id_usuario'];
                $_SESSION['rol'] = $user['id_rol'];

                //  Redirigir según el rol
                switch ($user['id_rol']) {
                  case 1:
                    $this->view('admin/#####', ['usuario' => $user]);
                    break;
                  case 2:
                    $this->view('profesor/#####', ['usuario' => $user]);
                    break;
                    case 3:
                    $this->view('estudiante/#####', ['usuario' => $user]);
                    break;
                default:
                    $this->view('login', ['error' => 'Rol no reconocido.']);
                    break;
                }


                exit();

            } catch (Exception $e) {
                error_log("Error en AuthController@login: " . $e->getMessage());
                $this->view('login', ['error' => 'Error interno. Intente más tarde.']);
                return;
            }
        } else {
            // Mostrar formulario
            $this->view('login');
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
        exit();
    }
}
?>
