<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';

class AdminController extends DefaultController
{
    const DEFAULT_TEMPLATE = 'Backend';
    const NOT_AUTHENTIFIED = 'Veuillez vous identifier pour accéder à l\'espace administrateur';

    public function __construct()
    {
        parent::__construct();
        return $this->isAuthentified();
    }

    public function isAuthentified()
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

    public function alertMessage($method, $condition, $success)
    {
        $alert = ($condition == true) ? 'success' : 'danger';
        $message = ($condition == true) ? $success : static::FAIL;

        $this->$method($alert , $message);
    }
}