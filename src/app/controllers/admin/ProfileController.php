<?php
class ProfileController extends Controller {
    
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
         if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 1) {
            header('Location: /auth/login');
            exit;
        }
        $this->view('admin_panel/####');
    }

}
?>