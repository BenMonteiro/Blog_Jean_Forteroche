<?php

require_once ROOT_PATH.'/core/DefaultController.php';

class AdminController extends DefaultController
{
    const DEFAULT_TEMPLATE = 'Backend';

    public function __construct()
    {
        parent::__construct();
        return $this->isAuthentified();
    }
 
    public function index()
    {
        header("Location: /login/login");
    }

    public function isAuthentified()
    {
        if (false === $_SESSION['auth']) {

            header("location: /login/errorLog");
        }
    }

    public function home()
    {
        $this->renderView('adminHome.twig', ['admin' => $_SESSION['admin']], static::DEFAULT_TEMPLATE);
    }

    public function add()
    {
        $this->renderView('add.twig', [], static::DEFAULT_TEMPLATE);
    }

    public function manage()
    {
        $this->renderView('manage.twig', [], static::DEFAULT_TEMPLATE);
    }


    public function comments()
    {
        $this->renderView('comments.twig', [], static::DEFAULT_TEMPLATE);
    }
}