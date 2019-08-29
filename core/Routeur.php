<?php

class Routeur
{
    protected $path;
    protected $controllerName;
    protected $actionName;
    protected $params = [];

    public function defaultPath()
    {
        require_once DIR.'src/Controllers/FrontController.php';
        $controller = new FrontController();
        $controller->HomePage();
    }

    public function setPath()
    {
        $uri = $_SERVER["REQUEST_URI"];
        
        $path = (parse_url($uri, PHP_URL_PATH));
        $path = trim($path, "/");
        if ($path != null){
            $this->path = $path;
            $this->setControllerName();
        } else {
            $this->defaultPath();
        }
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setControllerName()
    {
        $controllerName = substr(strstr($this->path, '/'), 1);
        $controllerName = substr(strstr($controllerName,'/', true), 0);
        if ($controllerName != null){
            $this->controllerName = $controllerName;
        }
    }

    public function getController()
    {
        if (isset($this->controllerName)){
            $controller = $this->controllerName;
            require_once DIR.'src/Controllers/'.$controller.'.php';
            $controller = new $controller();
            $this->controllerName = $controller;
            $this->setActionName();
        }
    }

    public function setActionName()
    {
        $actionName = substr(strrchr($this->path,'/'), 1);
        if ($actionName != null){
            $this->actionName = $actionName;
        }
    }

    public function getAction()
    {
        if (isset($this->actionName)){
            $controller = $this->controllerName;
            $action = $this->actionName;
            return $controller->$action();
        }
    }

    public function getParams()
    {
        $params = $_GET['article'];
        if ($params != null){
            $this->params = $params;
        }
    }

    public function dispatch()
    {
        $this->setPath();
        $this->getController();
        $this->getAction();
    }

}
