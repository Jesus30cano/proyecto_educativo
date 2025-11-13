<?php
class GeneralController extends Controller
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
     * Obtener datos personales del usuario
     */
    public function mostrarDatosPersonales()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Recibir el cuerpo JSON y decodificarlo
            $data = json_decode(file_get_contents('php://input'), true);

            // Recibir el valor
            $id_usuario = htmlspecialchars(trim($data['id_user'] ?? ''), ENT_QUOTES, 'UTF-8');
            // Validaciones
            $errors = [];
            if (empty($id_usuario)) $errors[] = "El ID de usuario es obligatorio.";
            if (!empty($errors)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'errors' => $errors
                ], 400);
            }
        
            

        try {
            $generalModel = $this->model('General');
            $data = $generalModel->mostrar_datos_personales($id_usuario);

            if (!$data) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Datos personales no encontrados.'
                ], 404);
            }

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $data
            ], 200);

        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al obtener datos personales.'
            ], 500);
        }
    }else 
    {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }
    }

    /**
     * Obtener datos de emergencia del usuario
     */
    public function mostrarDatosEmergencia()
    {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Recibir el cuerpo JSON y decodificarlo
            $data = json_decode(file_get_contents('php://input'), true);

            // Recibir el valor
            $id_usuario = htmlspecialchars(trim($data['id_user'] ?? ''), ENT_QUOTES, 'UTF-8');
            // Validaciones
            $errors = [];
            if (empty($id_usuario)) $errors[] = "El ID de usuario es obligatorio.";
            if (!empty($errors)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'errors' => $errors
                ], 400);
            }


        try {
            $generalModel = $this->model('General');
            $datos = $generalModel->mostar_datos_emergencia((int) $id_usuario);

            if (!$datos) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Datos de emergencia no encontradoss.'.$id_usuario
                ], 404);
            }

            return $this->jsonResponse([
                'status' => 'success',
                'data' => [
                    'nombre'=>$datos['nombre'],
                    'apellido'=>$datos['apellido'],
                    'telefono'=>$datos['telefono'],
                    'parentesco'=>$datos['parentesco'],
                    'direccion'=>$datos['direccion'],
                    'correo'=>$datos['correo'],
                    'observaciones'=>$datos['observaciones']
                ]
            ], 200);

        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al obtener datos de emergencia.'
            ], 500);
        }
    }else{
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }
    }

    /**
     * Obtener notificaciones del usuario
     */

    public function mostrarNotificaciones()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id_usuario = htmlspecialchars (trim($_POST['id_usuario'] ?? ''), ENT_QUOTES, 'UTF-8');
            // Validaciones
            $errors = [];
            if (empty($id_usuario)) $errors[] = "El ID de usuario es obligatorio.";
            if (!empty($errors)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'errors' => $errors
                ], 400);
            }
        try {
            $generalModel = $this->model('General');
            $notificaciones = $generalModel->mostar_notificaciones($id_usuario);
            if (!$notificaciones) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'No hay notificaciones.'
                ], 404);
            }

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $notificaciones
            ], 200);

        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al obtener notificaciones.'
            ], 500);
        }
    }else {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }   
}
    /**
     * Obtener log general paginado
     */

    public function mostrarLogGeneral()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $pagina = htmlspecialchars (trim($_POST['pagina'] ?? ''), ENT_QUOTES, 'UTF-8');
            $cantidad = htmlspecialchars (trim($_POST['cantidad'] ?? ''), ENT_QUOTES, 'UTF-8');
            // Validaciones
            $errors = [];
            if (empty($pagina)) $errors[] = "La página es obligatoria.";
            if (empty($cantidad)) $errors[] = "La cantidad es obligatoria.";
            if (!empty($errors)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'errors' => $errors
                ], 400);
            }
        try {
            $generalModel = $this->model('General');
            $log = $generalModel->mostrar_log_general($pagina,$cantidad);
            if (!$log) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'No hay entradas en el log.'
                ], 404);
            }

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $log
            ], 200);

        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al obtener el log general.'
            ], 500);
        }
        }else {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Método no permitido.'
            ], 405);
        }

}

public function actualizarDatosPersonales()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id_usuario = htmlspecialchars (trim($_POST['id_usuario'] ?? ''), ENT_QUOTES, 'UTF-8');
            $nombre = htmlspecialchars (trim($_POST['nombre'] ?? ''), ENT_QUOTES, 'UTF-8');
            $apellido = htmlspecialchars (trim($_POST['apellido'] ?? ''), ENT_QUOTES, 'UTF-8');
            $fecha_nacimiento = htmlspecialchars (trim($_POST['fecha_nacimiento'] ?? ''), ENT_QUOTES, 'UTF-8');
            $telefono = htmlspecialchars (trim($_POST['telefono'] ?? ''), ENT_QUOTES, 'UTF-8');
            $direccion = htmlspecialchars (trim($_POST['direccion'] ?? ''), ENT_QUOTES, 'UTF-8');
            $genero = htmlspecialchars (trim($_POST['genero'] ?? ''), ENT_QUOTES, 'UTF-8');

            // Validaciones
            $errors = [];
            if (empty($id_usuario)) $errors[] = "El ID de usuario es obligatorio.";
            if (empty($nombre)) $errors[] = "El nombre es obligatorio.";
            if (empty($apellido)) $errors[] = "El apellido es obligatorio.";
            if (empty($fecha_nacimiento)) $errors[] = "La fecha de nacimiento es obligatoria.";
            if (empty($telefono)) $errors[] = "El teléfono es obligatorio.";
            if (empty($direccion)) $errors[] = "La dirección es obligatoria.";
            if (empty($genero)) $errors[] = "El género es obligatorio.";

            if (!empty($errors)) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'errors' => $errors
                ], 400);
            }

        try {
            $generalModel = $this->model('General');
            $generalModel->actualizar_datos_personales($id_usuario, $nombre, $apellido, $fecha_nacimiento, $telefono, $direccion, $genero);

            return $this->jsonResponse([
                'status' => 'success',
                'message' => 'Datos personales actualizados correctamente.'
            ], 200);

        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Error al actualizar datos personales.'
            ], 500);
        }
    }else {
        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'Método no permitido.'
        ], 405);
    }
}

public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        
        header('Location: /auth/login');

        exit;
    }
}
    
?>