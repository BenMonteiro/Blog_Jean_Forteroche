<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';
require_once ROOT_PATH.'/core/Exception/LoginException.php';

/**
 * Control the authentification for the admin part
 */
class LoginController extends DefaultController
{
    const DEFAULT_TEMPLATE = 'Backend';
    const DISCONNECT = 'Vous avez bien été déconnecté de l\'espace administration';
    const NOT_AUTHENTIFIED = 'Veuillez vous identifier pour accéder à l\'espace administrateur';
    const ERROR = 'L\'identifiant et/ou le mot de passe sont incorrect !';

    public function index()
    {
        $this->renderView('login.twig', [], static::DEFAULT_TEMPLATE);
    }

    /**
     * If the login and password are found in the database, redirect to the admin page, else, throw an error
     */
    public function loginRedirection()
    {
        $login = $this->request->getParam('pseudo');
        $password = md5($this->request->getParam('password'));
        $user = UserManager::findOne($login, $password);

        if (empty($user)) {

            throw new LoginException(static::ERROR);
        }

        $_SESSION['auth'] = true;
        $_SESSION['admin'] = $user['name'];

        header("Location: /admin");
    }

    /**
     * Disconnection of the administrator
     */
    public function disconnect()
    {
        $_SESSION['auth'] = false;

        $this->renderView('login.twig', ['alert' => 'danger', 'message' => static::DISCONNECT], static::DEFAULT_TEMPLATE);
    }

    /**
     * Redirection if there is no authentified user
     */
    public function not_Authentified()
    {
        $this->renderView('login.twig', 
            [
                'alert' =>'danger', 
                'message' => static::NOT_AUTHENTIFIED
            ], static::DEFAULT_TEMPLATE
        );
    }

    /**
     * login function
     */
    public function login()
    {
        try 
        {

            $this->loginRedirection();

        } catch (LoginException $e) {

            $this->renderView('login.twig', ['alert' => 'danger', 'message' => $e->getMessage()], static::DEFAULT_TEMPLATE);
        }
    }
}
