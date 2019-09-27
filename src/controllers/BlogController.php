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

        foreach ($this->articleList as $article) {

            $author_id = $article['user_id'];
            $author = UserManager::findOneById($author_id);
        }

        $this->renderView('home.twig',
            [
                'articleList' => $this->articleList,
                'lastUpdates' => $lastUpdates, 
                'author' => $author['name']
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
