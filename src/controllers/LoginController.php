<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';


class LoginController extends DefaultController
{

    const DEFAULT_TEMPLATE = 'Backend';

    public function index()
    {
        $this->renderView('login.twig', [], static::DEFAULT_TEMPLATE);
    }

    public function loginRedirection()
    {
        $data = UserManager::findAll();

        foreach ($data as $user) {

            if ($user['login'] == $this->request->getParam('pseudo') && $user['password'] == $this->request->getParam('password')) {
                
                $_SESSION['auth'] = true;
                $_SESSION['admin'] = $user['name'];

                header("Location: /admin/home");

            } else {

                $this->errorLog();
            }
        }
    }

    public function errorLog()
    {
        $this->renderView('login.twig', ['error' => 'L\'identifiant et/ou le mot de passe sont incorrect !'], static::DEFAULT_TEMPLATE);
    }

    public function disconnect()
    {
        $this->renderView('login.twig', ['disconnect' => 'Vous avez bien été déconnecté de l\'espace administration'], static::DEFAULT_TEMPLATE);
        $_SESSION['auth'] = false;

    }

}