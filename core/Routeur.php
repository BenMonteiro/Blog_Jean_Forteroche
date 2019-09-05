<?php

class Routeur
{
    protected $request;
    protected $controllerName;
    protected $controller;
    protected $action;

    public function __construct()
    {
        require_once ROOT_PATH.'/core/Request.php';
        $request = Request::getRequest();
        $this->controllerName = $request->getControllerName();
        $this->action = $request->getActionName();
    }

    protected function setException($exception, $message)
    {
        require_once ROOT_PATH . '/core/Exception/' . $exception . '.php';
        throw new $exception($message);
    }

    protected function setControllerPath()
    {
        $controllerPath = ROOT_PATH.'/src/Controllers/' . $this->controllerName . '.php';
        return $controllerPath;
    }

    protected function existController()
    {
        if (!file_exists($this->setControllerPath()) && $this->controllerName!='') {
            $this->setException(RouteurException, header("Location: /FrontController/error404"));
        }

        return $this;
    }

    protected function setController()
    {
        require_once $this->setControllerPath();
        $this->controller = new $this->controllerName;
        return $this;
    }

    protected function existAction()
    {
        if (!method_exists($this->controller, $this->action)) {
            $this->setException(RouteurException, header("Location: /FrontController/error404"));
        }

        return $this;
    }

    protected function callControllerAction()
    {
        call_user_func(array($this->controller, $this->action));
    }

    public function dispatch()
    {
        try
        {
            $this->existController()
                ->setController()
                ->existAction()
                ->callControllerAction();
        }
        catch (Exception $e)
        {
        }
    }
}
