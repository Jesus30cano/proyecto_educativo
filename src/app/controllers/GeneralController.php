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
            $datos = $generalModel->mostrar_datos_personales($id_usuario);

            if (!$datos) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Datos personales no encontrados.'
                ], 404);
            }

            return $this->jsonResponse([
                'status' => 'success',
                'data' => [
                    'nombre' => $datos['nombre'],
                    'apellido' => $datos['apellido'],
                    'email' => $datos['email'],
                    'telefono' => $datos['telefono'],
                    'direccion' => $datos['direccion'],
                    'tipo_documento' => $datos['tipo_documento'],
                    'documento' => $datos['documento'],
                    'fecha_nacimiento' => $datos['fecha_nacimiento'],
                    'genero' => $datos['genero']

                ]
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
            $datos = $generalModel->mostar_datos_emergencia($id_usuario);

            if (!$datos) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Datos de emergencia no encontrados.'
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
}
    
?>