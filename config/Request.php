<?php namespace config;
class Request {
    private $controladora;
    private $metodo;
    private $parametros;
    public function __construct() {
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        $urlToArray = explode("/", $url);
        
        $ArregloUrl = array_filter($urlToArray);
        
        if (empty($ArregloUrl)) {
            $this->controladora = 'Home';
        } else {
            $this->controladora = array_shift($ArregloUrl);
        }
        
        if (empty($ArregloUrl)) {
            $this->metodo = 'index';
        } else {
            $this->metodo = array_shift($ArregloUrl);
        }
        
        $metodoRequest = $this->getMetodoRequest();
        
        if ($metodoRequest == 'GET') {
            if (!empty($ArregloUrl)) {
                $this->parametros = $ArregloUrl;
            }
        } else {
            $this->parametros = $_POST;
        }

    }

    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new Request();
        }
        return $inst;
    }

    public static function getMetodoRequest() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getControladora() {
        return $this->controladora;
    }

    public function getMetodo() {
        return $this->metodo;
    }

    public function getParametros() {
        return $this->parametros;
    }
}
