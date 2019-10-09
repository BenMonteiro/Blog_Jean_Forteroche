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
     */
    public function isAuthentified()
    {
        if (false === $_SESSION['auth'] || !isset($_SESSION['auth'])) {

            header("Location: /login/not_Authentified");
        }
    }

    /**
     * Display the home page of the administration side of the website
     */
    public function index()
    {
        $toModerateList = CommentManager::toModerate();
        $toModerateNumber = count($toModerateList);
        $reported = CommentManager::countReported();

        $lastArticle = ArticleManager::findLast();

        $this->renderView('adminHome.twig', 
            [
                'admin' => $_SESSION['admin'], 
                'toModerateNumber' => $toModerateNumber,
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
