<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';

/**
* Controll the page to display 
*/
class BlogController extends DefaultController
{
    protected $articleList;

    /**
     * find all the article to display them in the menu
     */
    public function __construct()
    {
        parent::__construct();
        return $this->articleList = ArticleManager::findAll();
    }

    public function index()
    {
        $this->home();
    }
    
    /**
     * HomePage of the website, display the last updated 3 aticles and a list of all articles
     */
    public function home()
    {
        $lastUpdates = ArticleManager::findLastUpdates();

        $this->renderView('home.twig',
            [
                'articleList' => $this->articleList,
                'lastUpdates' => $lastUpdates, 
            ]
        );
    }

    /**
     * Display the author page
     */
    public function author()
    {
        $this->renderView('author.twig',['articleList' => $this->articleList]);
    }
}
