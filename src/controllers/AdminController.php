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
        $this->checkAuthentified();
    }

    /**
     * If thre is no authentified administrator, redirect to the login page
     */
    public function checkAuthentified()
    {
        if (false === $_SESSION['auth'] || !isset($_SESSION['auth'])) {
            header("Location: /login/notAuthentified");
        }
    }

    /**
     * Display the home page of the administration side of the website
     */
    public function index()
    {
        $articleNumber = ArticleManager::count();
        $toModerateNumber = CommentManager::countToModerate();
        $reportedComment = CommentManager::countReported();
        $lastArticle = ArticleManager::findLast();

        $this->renderView('adminHome.twig', 
            [
                'admin' => $_SESSION['admin'],
                'articleNb' => $articleNumber,
                'toModerateNumber' => $toModerateNumber,
                'reported' => $reportedComment,
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
    public function alertMessage(string $method, $condition, string $success, $chapterNumber = null)
    {
        $alert = ($condition == true) ? 'success' : 'danger';
        $message = ($condition == true) ? $success : static::FAIL;

        $this->$method($alert , $message, $chapterNumber);
    }
}
