<?php
class App
{
    protected $routes;
    private $addr_url;
    private $requestMethod;

    public function __construct()
    {
        $this->routes = $GLOBALS['routes'];
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        if (isset($_POST['_method'])) {
            if ($_POST['_method'] == 'PUT') {
                $this->requestMethod = 'PUT';
            } elseif ($_POST['_method'] == 'DELETE') {
                $this->requestMethod = 'DELETE';
            }
        }

        if (isset($_GET['url'])) {
            $this->addr_url = rtrim($_GET['url'], "/");
        } else {
            return http_response_code(404);
        }

        //Fetch and check all routes from web.php
        foreach ($this->routes as $route) {
            $url = $this->addr_url;
            $paramExpected = false;
            $parametr = false;

            //check if is in the file web.php declared parametr in {}
            $paramExpected = strpos($route[0], '{');
            if ($paramExpected !== false) {
                $parametr = substr($url, $paramExpected);
                $route[0] = substr($route[0], 0, $paramExpected);
                $url = substr($url, 0, $paramExpected);
            } else {
                $parametr = '';
            }
            
            //Route and method found
            if ($url == $route[0] && $this->requestMethod == $route[1]) {
                Route::controller($route[2], $route[3], $parametr);
                return http_response_code(200);
            }
        }

        //if don't find any routes:
        return http_response_code(404);
    }
}