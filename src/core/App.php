<?php
class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // Verificar que $url tenga elementos y que el primer elemento exista
        if (!empty($url) && isset($url[0]) && !empty($url[0])) {
            $controllerFile = 'app/controllers/' . ucfirst($url[0]) . 'Controller.php';

            if (file_exists($controllerFile)) {
                $this->controller = ucfirst($url[0]) . 'Controller';
                unset($url[0]);
            }
        }

        // Cargar el controller
        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Verificar método
        if (!empty($url) && isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = !empty($url) ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url']) && !empty($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            // Filtrar elementos vacíos y reindexar
            return array_values(array_filter($url, function ($value) {
                return !empty($value);
            }));
        }
        return [];
    }
}
?>