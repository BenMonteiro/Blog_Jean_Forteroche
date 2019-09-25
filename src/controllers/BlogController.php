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

    public function __construct()
    {
        parent::__construct();
        return $this->articleList = ArticleManager::findAll();
    }

    public function index()
    {
        $this->home();
    }

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

    public function author()
    {
        $this->renderView('author.twig',['articleList' => $this->articleList]);
    }
}
