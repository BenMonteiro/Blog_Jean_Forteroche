<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';
require_once ROOT_PATH.'/core/Exception/LoginException.php';


class LoginController extends DefaultController
{
    const DEFAULT_TEMPLATE = 'Backend';

    public function index()
    {
        $this->renderView('login.twig', [], static::DEFAULT_TEMPLATE);
    }

    public function loginRedirection()
    {
        $login = $this->request->getParam('pseudo');
        $password = md5($this->request->getParam('password'));
        $user = UserManager::findOne($login, $password);

        if ($user) {

            $_SESSION['auth'] = true;
            $_SESSION['admin'] = $user['name'];

            header("Location: /admin/home");

        } else {
            throw new LoginException('L\'identifiant et/ou le mot de passe sont incorrect !');
        }
    }

    public function disconnect()
    {
        $_SESSION['auth'] = false;

        $this->renderView('login.twig', ['disconnect' => 'Vous avez bien été déconnecté de l\'espace administration'], static::DEFAULT_TEMPLATE);
    }

    public function login()
    {
        try 
        {
            $this->loginRedirection();

        } catch (LoginException $e) {

            $this->renderView('login.twig', ['error' => $e->getMessage()], static::DEFAULT_TEMPLATE);
        }

    }
}