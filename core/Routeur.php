<?php

require_once ROOT_PATH.'/core/Exception/Exception404.php';
require_once ROOT_PATH.'/core/Request.php';
/**
 * Routeur class call the good controller and the good function to execute 
 */
class Routeur
{
    protected $request;
    protected $controllerURLName;
    protected $controllerName;
    protected $controllerPath;
    protected $controller;
    protected $action;

    /** 
     * Construct call a Request object and set the variables
     */
    public function __construct()
    {
        $this->request = Request::getRequest();
        $this->controllerURLName = $this->request->getURLComponents()[0];
        $this->controllerName = $this->request->getControllerName();
        $this->action = $this->request->getActionName();
        $this->controllerPath = ROOT_PATH.'/src/Controllers/' . $this->controllerName . '.php';
    }

        /**
     * If the controller file does not exist, call the redirect function
     * 
     * @return self        [return the current object]
     */
    protected function existController(): self
    {
        if (!file_exists($this->controllerPath)) {

            $this->redirect();
        }

        return $this;
    }

    /**
     * Redirection in the case where controllerName is not found
     */
    protected function redirect()
    {
        if (empty($this->controllerName)) {

            require_once ROOT_PATH.'/src/Controllers/BlogController.php';
            $homePage = new BlogController;

            return $homePage->index();
        }

        throw new Exception404('La page que vous recherchez n\'existe pas');
    }

    /**
     * Call a new controller object
     * @return self        [return the current object]
     */
    protected function setController(): self
    {
        require_once $this->controllerPath;
        $this->controller = new $this->controllerName;

        return $this;
    }

    /**
     * If the method (action) does not exist in the controller object previously called, redirect to the index function of the controller
     */
    protected function existAction()
    {
        if (!method_exists($this->controller, $this->action)) {

            $this->action = 'index';
        }

        return $this;
    }

    /**
     * Call the method in the previous controller
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

        } catch (Exception404 $e) {

            require_once ROOT_PATH.'/core/Error404Controller.php';
            $error404 = new Error404Controller();
            $error404->error($e);
        }
    }
}
