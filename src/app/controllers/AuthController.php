<?php
require __DIR__ . '/../../vendor/autoload.php';
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;
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
                        $redirect = '/admin/dashboard/index';
                        break;
                    case 2:
                        $redirect = '/teacher/dashboard/index';
                        break;
                    case 3:
                        $redirect = '/student/dashboard/index';
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



    

    public function restablecer_contrasena()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'método no permitido.'
            ], 501);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //sanitización básica
            $input = json_decode(file_get_contents("php://input"), true);
            $correo = htmlspecialchars(trim($input['email'] ?? ''), ENT_QUOTES, 'UTF-8');

            //validaciones
            $errors = [];
            if (empty($correo)) $errors[] = "Debe ingresar un correo electrónico válido.".$correo;
            if (!empty($errors)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'errors' => $errors
                ], 400);
            }
            try {
                //buscar usuario en el modelo
                $userModel = $this->model('Users');
                $user = $userModel->validar_correo_existente($correo);

                if ($user === false) {
                    return $this->jsonResponse([
                        'status' => 'error',
                        'message' => 'Usuario no encontrado.'
                    ], 404);
                }

                // Aquí iría la lógica para enviar el correo de restablecimiento
                $codigo = random_int(100000, 999999);


                session_start();
                $_SESSION['reset_code'] = $codigo;
                $_SESSION['email'] = $correo;
                $_SESSION['reset_expires'] = time() + (15 * 60);
                $_SESSION['reset_email'] = $correo;
                // Lógica para enviar el correo electrónico con el código de restablecimiento
                

                $mail = new PHPMailer(true);
                try {
                    //Configuración del servidor SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Cambiar por el host SMTP real
                    $mail->SMTPAuth = true;
                    $mail->Username = 'cognia.oficial.s.a.s@gmail.com'; // Cambiar por tu correo
                    $mail->Password = '##############'; // Cambiar por tu contraseña
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Remitente y destinatario
                    $mail->setFrom('cognia.oficial.s.a.s@gmail.com', 'ADMINISTRACION COGNIA');
                    $mail->addAddress($correo);

                    // Contenido del correo
                    $templatePath = __DIR__ . '/../views/emails/reset_password_template.php';
                    ob_start();
                    include $templatePath;
                    $emailBody = ob_get_clean();
                    $mail->isHTML(true);
                    $mail->Subject = 'Restablecimiento de contraseña';
                    $mail->Body = $emailBody;

                    $mail->send();
                } catch (Exception $e) {
                    error_log("Error al enviar el correo: " . $e->getMessage());
                    return $this->jsonResponse([
                        'status' => 'error',
                        'message' => 'Error al enviar el correo de restablecimiento.'
                    ], 500);
                }

                return $this->jsonResponse([
                    'status' => 'success',
                    'message' => 'Instrucciones para restablecer la contraseña enviadas al correo.'
                ]);

            } catch (Exception $e) {
                error_log("Error en AuthController@restablecer_contrasena: " . $e->getMessage());
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Error interno del servidor. Intente más tarde.'.$e->getMessage()
                ], 500);
            }
        }
        
    }

    public function vista_forgot_password()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->view('emails/reset_password');
        }

        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }

public function validar_codigo()
{
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Captura POST tipo JSON
        session_start();
        $data = json_decode(file_get_contents('php://input'), true);
        $codigo = $data['code'] ?? '';

        if (!$codigo) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Código faltante.'
            ], 400);
        }

        // El correo se debe obtener por el código (por sesión, base de datos u otra lógica)
        // Ejemplo: $email = obtener_email_por_codigo($codigo);
       
       

        if ($codigo == $_SESSION['reset_code']) {
            return $this->jsonResponse([
                'status' => 'success',
                'message' => 'Código válido.'
            ]);
        }

        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Código inválido.'
        ], 400);

        
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Lógica para mostrar el formulario de actualización de contraseña
        return $this->view('emails/ingresar_codigo');
    }

    return $this->jsonResponse([
        'status' => 'error',
        'message' => 'Funcionalidad no implementada aún.'
    ], 501);
}
public function actualizar_contrasena()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $nueva_contrasena = $data['nueva_contrasena'] ?? '';

        if (!$nueva_contrasena) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Contraseña faltante.'
            ], 400);
        }

        // Aquí iría la lógica para actualizar la contraseña en la base de datos
        // Ejemplo: actualizar_contrasena_en_bd($email, $nueva_contrasena);
        session_start();
        $email = $_SESSION['email'] ?? '';
        if (!$email) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Correo electrónico no encontrado en sesión.'
            ], 400);
        }

        try {
            $userModel = $this->model('Users');
            $hashedPassword = password_hash($nueva_contrasena, PASSWORD_BCRYPT);
            $actualizado = $userModel->actualizar_password($email, $hashedPassword);
            // destruir variables de sesión relacionadas con el restablecimiento
            unset($_SESSION['reset_code']);
            unset($_SESSION['reset_expires']);
            unset($_SESSION['email']);
            session_destroy();

            if (!$actualizado) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Error al actualizar la contraseña.'.$actualizado
                ], 500);
            }
            return $this->jsonResponse([
            'status' => 'success',
            'message' => 'Contraseña actualizada exitosamente.'
            ]);

        } catch (Exception $e) {
            error_log("Error en AuthController@actualizar_contrasena: " . $e->getMessage());
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error interno del servidor. Intente más tarde.'
            ], 500);
        }
        
    }else{
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            return $this->view('emails/actualizar');
    
        }
    }

    return $this->jsonResponse([
        'status' => 'error',
        'message' => 'METODO NO ENCONTRADO.'
    ], 501);

}
}

?>
