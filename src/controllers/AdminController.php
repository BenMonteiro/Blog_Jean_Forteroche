<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';

/**
 * Control the administration part of the website
 */
class AdminController extends DefaultController
{
    const DEFAULT_TEMPLATE = 'Backend';
    const NOT_AUTHENTIFIED = 'Veuillez vous identifier pour accéder à l\'espace administrateur';

    /**
     * Verify if an administrator is authentified
     */
    public function __construct()
    {
        parent::__construct();
        return $this->isAuthentified();
    }

    /**
     * If thre is no authentified administrator, redirect to the login page
     * @return void
     */
    public function isAuthentified(): void
    {
        if (false === $_SESSION['auth'] || !isset($_SESSION['auth'])) {

            $this->renderView('login.twig', 
                [
                    'alert' =>'danger', 
                    'message' => static::NOT_AUTHENTIFIED
                ], static::DEFAULT_TEMPLATE
            );
        }
    }

    /**
     * Display the home page of the administration side of the website
     */
    public function index()
    {
        $toModerateList = CommentManager::toModerate();
        $toModerate = count($toModerateList);
        $reported = count(CommentManager::findReported());

        $lastArticle = ArticleManager::findLast();

        $this->renderView('adminHome.twig', 
            [
                'admin' => $_SESSION['admin'], 
                'toModerate' => $toModerate,
                'reported' => $reported,
                'lastArticle' => $lastArticle
            ], static::DEFAULT_TEMPLATE
        );
    }

    /**
     * Set the message to call in the views
     * @param string $method    [the method to call]
     * @param $condition    [the condition to apply]
     * @param string $success    [the success messege to display]
     */
    public function alertMessage(string $method, $condition, string $success)
    {
        $alert = ($condition == true) ? 'success' : 'danger';
        $message = ($condition == true) ? $success : static::FAIL;

        $this->$method($alert , $message);
    }
}
