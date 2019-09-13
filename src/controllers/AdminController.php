<?php
require_once ROOT_PATH.'/core/DefaultController.php';

class AdminController extends DefaultController
{

    protected $login;

    public function home()
    {
        $this->renderView('adminHome.twig', ['admin' => $_SESSION['admin']]);
    }

    public function add()
    {
        $this->renderView('add.twig', []);
    }

    public function manage()
    {
        $this->renderView('manage.twig', []);
    }


    public function comments()
    {
        $this->renderView('comments.twig', []);
    }
}