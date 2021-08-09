<?php


class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = require $routesPath;
    }

    static public function redirectLink($uri = '/')
    {
        header('Location: ' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $uri);
    }

    /*
     * Return request string
     * */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $segments = explode('.', $path);
                $controllerName = array_shift($segments) . 'Controller';
                $methodName = array_shift($segments);

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;

                    $controllerObject = new $controllerName;
                    $result = $controllerObject->$methodName();
                    if ($result !== null) {
                        break;
                    }
                } else {
                    self::redirectLink();
                }
            }
        }
    }
}