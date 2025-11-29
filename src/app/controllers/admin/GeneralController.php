<?php
class GeneralController extends Controller {
    
    public function __construct() {
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
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Acceso no autorizado o sesión no iniciada.'
        ], 401);
    }

    return $this->jsonResponse([
        'status' => 'success',
        'message' => 'Conexión exitosa. Controlador General activo y sesión válida.'
    ]);
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
        $id_rol = isset($_POST['id_rol']) ? (int) $_POST['id_rol'] : null;
        $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''), ENT_QUOTES, 'UTF-8');
        $apellido = htmlspecialchars(trim($_POST['apellido'] ?? ''), ENT_QUOTES, 'UTF-8');
        $fecha_nacimiento = htmlspecialchars(trim($_POST['fecha_nacimiento'] ?? ''), ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars(trim($_POST['telefono'] ?? ''), ENT_QUOTES, 'UTF-8');
        $direccion = htmlspecialchars(trim($_POST['direccion'] ?? ''), ENT_QUOTES, 'UTF-8');
        $genero = htmlspecialchars(trim($_POST['genero'] ?? ''), ENT_QUOTES, 'UTF-8');
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
            $validacion = $this->model('Users');
            $validar_email = $validacion->validar_correo_existente($email);
            if ($validar_email) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'El correo ya está registrado.'
                ], 409);
            }
            $vaalidar_usuario = $validacion->buscar_usuario( $no_documento);
            if ($vaalidar_usuario) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'El usuario con numero de documento ya existe.'
                ], 409);
            }
            // Hashear la contraseña
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            // Llamar al modelo para registrar el usuario
            $adminModel = $this->model('admin/AdminModel');
            $id_new_usuario = $adminModel->adminRegistrarUsuario($email, $tipo_documento, $no_documento, $password_hashed, $id_rol);
            $adminModel->crear_datos_personales($id_new_usuario, $nombre, $apellido, $fecha_nacimiento, $telefono, $direccion, $genero);
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


    } else {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }
}



//-----------------------------------------------------------------------------------------------

public function listarUsuariosPorIdRol()
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
    
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['id_rol']) || !is_numeric($input['id_rol'])) {
        $this->jsonResponse(['error' => 'Falta o es inválido el id_rol.'], 400);
    }

    try {
        $adminModel = $this->model('admin/AdminModel');

        $usuarios = $adminModel->listarUsuariosPorIdRol((int) $input['id_rol']);
        $this->jsonResponse(['status' => 'success', 'data' => $usuarios]);
    } catch (PDOException $e) {
        $this->jsonResponse(['error' => 'Error al listar usuarios: ' . $e->getMessage()], 500);
    }
}else {
    return $this->jsonResponse([
        'status' => 'error',
        'message' => 'Método no permitido.'
    ], 405);
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
        $adminModel->desactivarUsuario((int) $input['id_usuario']);
        $this->jsonResponse(['mensaje' => 'Usuario desactivado correctamente.']);
    } catch (PDOException $e) {
        $this->jsonResponse(['error' => 'Error al desactivar usuario: ' . $e->getMessage()], 500);
    }
}



//-----------------------------------------------------------------------------------------------

public function actualizarUsuario()
{
    $input = json_decode(file_get_contents("php://input"), true);
    if (!isset($input['id_usuario']) || !is_numeric($input['id_usuario'])) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Falta o es inválido el id_usuario.'], 400);
    }

     if (!isset($input['correo']) || !filter_var($input['correo'], FILTER_VALIDATE_EMAIL)) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Correo inválido.'], 400);
    }

    try {
        if(empty($input['password'])){
            $password_hashed = null;
        } else {
            $password_hashed = password_hash($input['password'], PASSWORD_DEFAULT);
        }
        $adminModel = $this->model('admin/AdminModel');
        $adminModel->actualizarUsuario(
            (int) $input['id_usuario'],
            $input['correo'],
            $password_hashed
        );

        $this->jsonResponse(['status' => 'success', 'message' => 'Usuario actualizado correctamente.']);
    } catch (PDOException $e) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Error al actualizar usuario: ' . $e->getMessage()], 500);
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
        $adminModel->activarUsuario((int) $input['id_usuario']);
        $this->jsonResponse(['mensaje' => 'Usuario activado correctamente.']);
    } catch (PDOException $e) {
        $this->jsonResponse(['error' => 'Error al activar usuario: ' . $e->getMessage()], 500);
    }
}


}
?>