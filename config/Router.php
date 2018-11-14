<?php namespace config;
class Router {
    public function __construct() {
    }
    public static function direccionar(Request $request) {
        $controlador = $request->getControladora() . "Controller";
        $metodo = $request->getMetodo();
        $parametros = $request->getParametros();
        $objeto = "controllers\\" . $controlador;
        $controlador = new $objeto();
        if (!isset($parametros)) {
            call_user_func(array($controlador, $metodo));
        } else {
            call_user_func_array(array($controlador, $metodo), $parametros);
        }
    }
}
?>
