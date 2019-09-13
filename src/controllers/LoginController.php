<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';

class LoginController extends DefaultController
{

    public function login()
    {
        $this->renderView('login.twig');
    }

    public function loginRedirection()
    {
        $user = new UserManager();
        $user = $user->findAll();
        $data = $user->fetch();

        if ($data['login'] == $this->request->getPostParams('pseudo') && $data['password'] == $this->request->getPostParams('password')) {
            
            $_SESSION['admin'] = $data['name'];
            header("Location: /AdminController/home");

        } else {

            header("Location: /LoginController/errorLog");
        }
    }

    public function errorLog()
    {
        $this->renderView('login.twig', ['error' => 'L\'identifiant et/ou le mot de passe sont incorrect !']);
    }

    public function disconnect()
    {
        $this->renderView('login.twig', ['disconnect' => 'Vous avez bien été déconnecté de l\'espace administration']);
    }

}