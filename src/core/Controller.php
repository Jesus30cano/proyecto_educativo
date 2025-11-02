<?php
class Controller
{
    public function model($model)
    {
        $modelPath = 'app/models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        }
        throw new Exception("Modelo no encontrado: $model");
    }

    public function view($view, $data = [])
    {
        $viewPath = 'app/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception("Vista no encontrada: $view");
        }


        extract($data);
        require_once $viewPath;
    }
}
?>