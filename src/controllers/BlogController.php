<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';
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

        foreach ($this->articleList as $article) {

            $author_id = $article['user_id'];
            $author = UserManager::findOneById($author_id);
        }

        $this->renderView('home.twig', ['articleList' => $this->articleList, 'author' => $author['name']]);
    }

    public function article()
    {
        $id = $this->request->getParam('id');
        $article = ArticleManager::findOneById($id);
        $author_id = $article['user_id'];
        $author = UserManager::findOneById($author_id);
        $nbArticles = count($this->articleList);
        $commentList = CommentManager::findArticleComments($id);

        $this->renderView(
            'article.twig',
            [
                'articleList' => $this->articleList,
                'id' => $article['id'],
                'nbArticles' => $nbArticles,
                'title' => $article['title'],
                'image_url' => $article['image_url'], 
                'alt_image' => $article['alt_image'], 
                'content' => $article['content'],
                'commentList' => $commentList,
                'author' => $author['name']
            ]);
    }
    
    public function author()
    {
        $this->renderView('author.twig',['articleList' => $this->articleList]);
    }




   
}
