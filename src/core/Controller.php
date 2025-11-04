<?php
class Controller
{
    // 🧩 Cargar modelo, incluso si está dentro de una subcarpeta
    public function model($model)
    {
        // Permitir rutas como 'Usuarios/Perfil'
        $modelPath = 'app/models/' . $model . '.php';

        if (file_exists($modelPath)) {
            require_once $modelPath;

            // Extraer solo el nombre de la clase (sin carpeta)
            $parts = explode('/', $model);
            $className = end($parts);

            return new $className();
        }

        throw new Exception("Modelo no encontrado: $modelPath");
    }

    // 🧩 Cargar vista, incluso si está dentro de una subcarpeta
    public function view($view, $data = [])
    {
        // Permitir rutas como 'estudiantes/panel' o 'profesor/inicio'
        $viewPath = 'app/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception("Vista no encontrada: $viewPath");
        }

        // Extraer variables para usarlas dentro de la vista
        extract($data);

        require_once $viewPath;
    }
}
?>
