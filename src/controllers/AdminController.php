<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';

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
        $this->home();
    }

    public function isAuthentified()
    {
        if (false === $_SESSION['auth'] || !isset($_SESSION['auth'])) {

            header("location: /login/errorLog");
        }
    }

    public function home()
    {
        $reportedCommentList = CommentManager::findReported();
        $commentsToModerate = count($reportedCommentList);
        $lastArticle = ArticleManager::findLast();

        $this->renderView('adminHome.twig', 
            [
                'admin' => $_SESSION['admin'], 
                'commentsToModerate' => $commentsToModerate,
                'lastArticle' => $lastArticle
            ], static::DEFAULT_TEMPLATE
        );
    }
}