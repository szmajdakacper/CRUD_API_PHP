<?php
class Route
{
    public static function controller($name, $method, $param = '')
    {
        $controllerPath = 'controllers/'.$name.'.php';
        if (file_exists($controllerPath)) {
            require_once($controllerPath);
        } else {
            return http_response_code(404);
        }

        $controller = new $name();

        $controller->$method($param);
    }
}