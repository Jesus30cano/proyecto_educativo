<?php
class DashboardController extends Controller
{
     private function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    public function index()
    {
        // Lógica para mostrar el dashboard del administrador
        $this->view('admin_panel/dashboard');
    }


}
?>