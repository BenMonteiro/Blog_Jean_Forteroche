<?php

require_once ROOT_PATH.'/core/Exception/RouteurException.php';
require_once ROOT_PATH.'/core/Request.php';
/**
 * Routeur class call the good controller and the good function to execute 
 */
class Routeur
{
    protected $request;
    protected $controllerName;
    protected $controllerPath;
    protected $controller;
    protected $action;

    /** 
     * Construct call a Request object and set the variable $controllerName and $actionName
     */
    public function __construct()
    {
        $this->request = Request::getRequest();
        $this->controllerName = $this->request->getControllerName();
        $this->action = $this->request->getActionName();
        $this->controllerPath = ROOT_PATH.'/src/Controllers/' . $this->controllerName . '.php';
    }

    /**
     * If Url path is an empty string, the routeur redirect to the homepage of the website
     */
    protected function redirect()
    {
        if (!isset($this->controllerName) || '' === $this->controllerName) {

            header('Location: /FrontController/home');

        } else if ('admin' === $this->controllerName) {

            header('Location: /LoginController/login');

        } else {

            throw new RouteurException() ;
        }
    }

    /**
     * If the controller file does not exist and controllerName is not an empty string, the routeur redirect to the error404 page
     * 
     * @return $this        [return the current object]
     */
    protected function existController(): Routeur
    {
        if (!file_exists($this->controllerPath)) {

            $this->redirect();
        }

        return $this;
    }

    /**
     * Call a new controller object
     * 
     * @return $this        [return the current object]
     */
    protected function setController(): Routeur
    {
        require_once $this->controllerPath;
        $this->controller = new $this->controllerName;

        return $this;
    }

    /**
     * If the method (action) does not exist in the controller object previously called, the routeur redirect to the error404 page
     * 
     * @return $this        [return the current object]
     */
    protected function existAction(): Routeur
    {
        if (!method_exists($this->controller, $this->action)) {

           throw new RouteurException() ;
        }

        return $this;
    }

    /**
     * Call the method in the previous controller
     * 
     * @return void
     */
    protected function callControllerAction(): void
    {
        call_user_func(array($this->controller, $this->action));
    }

    /**
     * Call all the steps to call the good method in the good controller
     */
    public function dispatch()
    {
        try
        {
            $this->existController()
                ->setController()
                ->existAction()
                ->callControllerAction();
        }
        catch (RouteurException $e)
        {
            header("Location: /FrontController/error404");
        }
    }
}
