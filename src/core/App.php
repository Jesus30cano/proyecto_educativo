<?php
class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        $controllerPath = 'app/controllers/';
        $controllerFile = '';

        // Permitir rutas con subcarpetas: ejemplo /estudiantes/panel
        if (!empty($url)) {
            $tempPath = $controllerPath;

            // Recorrer la URL buscando si hay una carpeta o archivo controlador
            foreach ($url as $i => $segment) {
                $possibleDir = $tempPath . ucfirst($segment) . '/';
                $possibleFile = $tempPath . ucfirst($segment) . 'Controller.php';

                if (is_dir($possibleDir)) {
                    $tempPath = $possibleDir;
                    unset($url[$i]); // quitar carpeta del array
                    continue;
                }

                if (file_exists($possibleFile)) {
                    $controllerFile = $possibleFile;
                    $this->controller = ucfirst($segment) . 'Controller';
                    unset($url[$i]); // quitar el controlador del array
                    break;
                }
            }

            // Si no se encontró el archivo aún, revisa dentro del último subdirectorio
            if (empty($controllerFile) && file_exists($tempPath . 'HomeController.php')) {
                $controllerFile = $tempPath . 'HomeController.php';
                $this->controller = 'HomeController';
            }

            // Si se encontró el archivo, úsalo
            if (!empty($controllerFile)) {
                require_once $controllerFile;
                $this->controller = new $this->controller;
            } else {
                // Si no se encuentra, cargar controlador por defecto
                require_once $controllerPath . 'HomeController.php';
                $this->controller = new HomeController();
            }
        } else {
            // Si no hay URL, cargar controlador por defecto
            require_once $controllerPath . 'HomeController.php';
            $this->controller = new HomeController();
        }

        // Obtener el método
        if (!empty($url) && isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Resto de parámetros
        $this->params = !empty($url) ? array_values($url) : [];

        // Ejecutar el método del controlador con parámetros
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url']) && !empty($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            return array_values(array_filter($url, fn($v) => !empty($v)));
        }
        return [];
    }
}
?>
