<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Controllers/ArticleController.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';

/**
* Controll the page to display 
*/
class CommentController extends DefaultController
{
    public function index()
    {
        header("Location: /blog/home");
    }

    public function addComment()
    {
        $article_id = $this->request->getParam('id');
        $comment = $this->request->getParam('message');
        $author = $this->request->getParam('name');

        CommentManager::add($article_id, $comment, $author);
        header("Location: /article/article?id=".$article_id);
    }

    public function reportComment()
    {
        $comment_id = $this->request->getParam('id');
        CommentManager::report($comment_id);

        $reportedComment = CommentManager::findOneById($comment_id);
        $article_id = $reportedComment['article_id'];

        $article = new ArticleController();
        ArticleManager::findOneById($article_id);
        $article->article($id = $article_id, $reportSuccess = 'Merci d\'avoir signaler ce commentaire.');
    }

}