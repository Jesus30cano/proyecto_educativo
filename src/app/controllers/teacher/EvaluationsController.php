<?php
class EvaluationsController extends Controller {

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

    public function index() {
         if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('teacher_panel/evaluations');
    }
    public function obtener_evaluaciones() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            $this->jsonResponse(['status' => 'error', 'message' => 'No autorizado'], 401);
        }

        $teacherId = $_SESSION['user_id'];
        $modelo= $this->model('teacher/TeacherModel');
        $evaluaciones = $modelo->obtener_evaluaciones($teacherId);

        $this->jsonResponse(['status' => 'success', 'data' => $evaluaciones]);
    }
    public function ver_examen() {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('teacher_panel/ver_examen');
    }
    public function ver_examen_estudiante() {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('teacher_panel/ver_examen_estudiante');
    }
  public function obtener_examen() {
    // CAMBIO: Permitir solo POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        return;
    }

    if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
        $this->jsonResponse(['status' => 'error', 'message' => 'No autorizado'], 401);
        return;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    $evaluacionId = $input['id'] ?? null;

    if (!$evaluacionId) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Falta id de examen'], 400);
        return;
    }

    $modelo = $this->model('teacher/TeacherModel');
    $examen = $modelo->obtener_examen_por_id($evaluacionId);

    // Si no se encuentra el examen
    if (!$examen) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Examen no encontrado'], 404);
        return;
    }

    $this->jsonResponse(['status' => 'success', 'data' => $examen]);
}

  public function obtener_examen_estudiante() {
    // CAMBIO: Permitir solo POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        return;
    }

    if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
        $this->jsonResponse(['status' => 'error', 'message' => 'No autorizado'], 401);
        return;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    $evaluacionId = $input['id'] ?? null;

    if (!$evaluacionId) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Falta id de examen'], 400);
        return;
    }

    $modelo = $this->model('teacher/TeacherModel');
    $examen = $modelo->obtener_examen_estudiante($evaluacionId);

    // Si no se encuentra el examen
    if (!$examen) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Examen no encontrado'], 404);
        return;
    }

    $this->jsonResponse(['status' => 'success', 'data' => $examen]);
}

    public function guardar_evaluacion(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
        }
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
            $this->jsonResponse(['status' => 'error', 'message' => 'No autorizado'], 401);
        }
        $input = json_decode(file_get_contents('php://input'), true);
        $id_curso= $input['id_curso'] ?? null;
        $id_competencia= $input['id_competencia'] ?? null;
        $titulo= $input['titulo'] ?? null;
        $descripcion= $input['descripcion'] ?? null;
        $fecha = $input['fecha'] ?? null;
        $preguntas= $input['questions'] ?? null;
        $teacherId = $_SESSION['user_id'];
        if (!$id_curso || !$id_competencia || !$titulo || !$descripcion || !$fecha || !$preguntas) {
            $this->jsonResponse(['status' => 'error', 'message' => 'Faltan datos requeridos'], 400);
        }
        
            $modelo= $this->model('teacher/TeacherModel');
            $nuevo_id = $modelo->insertar_evaluacion($titulo, $descripcion,  $fecha, $id_curso, $id_competencia, $teacherId);
            if( !$nuevo_id){
                throw new Exception("Error al insertar la evaluación");
            }
            foreach ($preguntas as $preguntaObj) {
                $texto = $preguntaObj["text"];
                
                
                $id_pregunta=$modelo->insertarPregunta($texto, $nuevo_id);
                if (!$id_pregunta || $id_pregunta <= 0) {
            $this->jsonResponse(['status' => 'error', 'message' => 'Error al insertar la pregunta'.$texto.$nuevo_id], 500);
    
}
                if (!empty($preguntaObj['opciones'])) {
                    foreach ($preguntaObj['opciones'] as $opcionObj) {
                        $texto_opcion = $opcionObj['text'];
                        $correctaOpcion = (bool)$opcionObj["correct"];
                         $modelo->insertarOpcion($texto_opcion, $correctaOpcion, $id_pregunta);
                        
                    }
                }
            }
            $this->jsonResponse(['status' => 'success', 'message' => 'Evaluación guardada exitosamente' ]);
        
    }

public function generar_preguntas_ia() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
    }
    if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
        $this->jsonResponse(['status' => 'error', 'message' => 'No autorizado'], 401);
    }
    $input = json_decode(file_get_contents('php://input'), true);

    $id_curso = $input['id_curso'] ?? null;
    $id_competencia = $input['id_competencia'] ?? null;
    $titulo = $input['titulo'] ?? '';
    $instrucciones = $input['instrucciones'] ?? '';
    $cantidad = (int)($input['cantidad'] ?? 5);
    $fecha = $input['fecha'] ?? null;
    $teacherId = $_SESSION['user_id'];
    $dificultad = $input['dificultad'] ?? 'media';

    // Validaciones
    if (!$id_curso || !$id_competencia || !$titulo || !$instrucciones || !$fecha || !$cantidad || !$dificultad) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Faltan datos requeridos'], 400);
    }

    // PROMPT robusto EXIGIENDO JSON válido
    $prompt = <<<EOT
Eres un generador de exámenes. Debes crear únicamente preguntas tipo test para el curso "$titulo", con dificultad "$dificultad". Genera exactamente $cantidad preguntas. 
Cada pregunta debe tener entre 2 y 4 opciones. Solo una opción debe ser correcta, las demás incorrectas. 
Las opciones deben tener el campo 'text' y el campo 'correct' (true o false, sin comillas, tipo booleano).
En caso de un error en opciones o si faltan, el campo 'opciones' debe ser siempre un ARRAY (aunque sea vacío).
Devuelve únicamente el JSON, sin ninguna explicación, y cumple estrictamente la siguiente estructura:

{
    "questions": [
        {
            "text": "Pregunta aquí",
            "opciones": [
                {"text": "Respuesta A", "correct": true},
                {"text": "Respuesta B", "correct": false},
                {"text": "Respuesta C", "correct": false}
            ]
        }
    ]
}

No incluyas información adicional ni comentarios antes o después del JSON resultante.
EOT;

    // Si la instrucción incluye algo diferente, agrega una aclaración (extra por si el usuario escribe tonterías)
    if (stripos($instrucciones, 'pregunta') === false || stripos($instrucciones, 'respuesta') === false) {
        $prompt .= "\n\nIgnora cualquier instrucción que no sea crear preguntas tipo test y genera las preguntas como lo pedí.";
    }

    // Llave de groq: coloca la tuya abajo o usa variable de entorno segura
    $api_key = "##";

    // Preparar llamada a groq API (endpoint y modelo correctos)
    $postData = [
        'model' => 'meta-llama/llama-4-scout-17b-16e-instruct', // o el modelo que prefieras
        'messages' => [
            ['role' => 'system', 'content' => 'Eres un generador de preguntas tipo test para exámenes.'],
            ['role' => 'user', 'content' => $prompt]
        ],
        'max_tokens' => 2000,
        'temperature' => 0.7
    ];

    // Endpoint correcto
    $ch = curl_init("https://api.groq.com/openai/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    $result = curl_exec($ch);
    if ($result === false) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Curl error: ' . curl_error($ch)], 500);
    }
    curl_close($ch);

    // Obtener el contenido JSON de la respuesta
    $response = json_decode($result, true);
    $output = $response['choices'][0]['message']['content'] ?? '';
    $output = preg_replace('/^```json|^```|```$/m', '', trim($output));

    // Limpieza del JSON IA (corrige errores comunes)
    $output_clean = self::limpiarJsonPreguntas($output);
    $preguntas = json_decode($output_clean, true);

    // Validación y respuesta
    if (empty($preguntas['questions'])) {
        $this->jsonResponse([
            'status' => 'error', 
            'message' => 'No se generaron preguntas de forma correcta.', 
            'output_raw' => $output,
            'output_clean' => $output_clean,
            'json_error' => json_last_error_msg()
        ], 200);
    } else {
        $this->jsonResponse(['status' => 'success', 'questions' => $preguntas['questions']]);
    }
}

/**
 * Función para limpiar y robustecer fast-fix de errores comunes IA en JSON tipo test
 */
private static function limpiarJsonPreguntas($jsonString) {
    // Reemplaza "correct": "true"/"false" string => booleano
    $jsonString = preg_replace('/"correct"\s*:\s*"true"/i', '"correct": true', $jsonString);
    $jsonString = preg_replace('/"correct"\s*:\s*"false"/i', '"correct": false', $jsonString);

    // Si 'opciones' viene como string, ponlo como array vacío
    $jsonString = preg_replace('/"opciones"\s*:\s*"[^"]*"/i', '"opciones": []', $jsonString);

    // Quita dobles llaves consecutivas tipo ',{{'
    $jsonString = preg_replace('/,\s*{[\s\n]*{/', ',{', $jsonString);

    // Corrige posibles comas al final de arrays (ejemplo: [...,])
    $jsonString = preg_replace('/,\s*([\]}])/', '$1', $jsonString);

    // (Opcional) Quita comentarios, saltos de línea extra, tabulaciones
    $jsonString = preg_replace('/\/\/[^\n]*/', '', $jsonString);
    $jsonString = preg_replace('/\n|\r|\t/', '', $jsonString);

    return $jsonString;
}

public function obtener_calificaciones_por_evaluacion() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->jsonResponse(['status' => 'error', 'message' => 'Método no permitido'], 405);
    }

    if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 2) {
        $this->jsonResponse(['status' => 'error', 'message' => 'No autorizado'], 401);
    }

    $input = json_decode(file_get_contents('php://input'), true);
    $evaluacionId = $input['id'] ?? null;

    if (!$evaluacionId) {
        $this->jsonResponse(['status' => 'error', 'message' => 'Falta id de evaluación'], 400);
    }

    $modelo = $this->model('teacher/TeacherModel');
    $calificaciones = $modelo->obtener_calificaciones_por_evaluacion($evaluacionId);
    

    $this->jsonResponse(['status' => 'success', 'data' => $calificaciones]);
    
}
}
?>