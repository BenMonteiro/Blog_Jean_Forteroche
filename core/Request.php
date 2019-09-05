<?php

class Request 
{
    protected $urlComponent;
    private static $request = null;

    public static function getRequest()
    {
        if (null === static::$request) {
            static::$request = new Request();
        }
        return static::$request;
    }

    public function getPath()
    {
        $uri = $_SERVER["REQUEST_URI"];
        $path = (parse_url($uri, PHP_URL_PATH));
        $path = trim($path, "/");

        if ($path != null) {
            $this->urlComponent = explode('/', $path);
        } else {
            header("Location: /FrontController/homePage");
        }
    }

    public function getControllerName()
    {
        $this->getPath();
        $controllerName = $this->urlComponent[0];
        return $controllerName;
    }

    public function getActionName()
    {
        $actionName = $this->urlComponent[1];
        return $actionName;
    }

    public function getParams()
    {
        $params = $_GET[''];
    }
}