<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Controllers/ArticleController.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';

/**
* Controll the page to display 
*/
class CommentController extends DefaultController
{

    protected $article; 

    const ADD_COMMENT_SUCCESS = "Votre commentaire a bien été ajouté";
    const FAIL = 'Nous n\'avons pas pu ajouté votre commentaire, veuillez rééssayer ultérieurement';

    public function index()
    {
        $this->home();
    }

    public function add()
    {
        $chapter = $this->request->getParam('chapter');
        $article = ArticleManager::findByChapterNumber($chapter);

        $article_id = $article['id'];
        $comment = $this->request->getParam('comment');
        $chapter = $article['chapter_number'];

        $add = CommentManager::add($article_id, $comment);

        if ($add == true) {

            $message = static::ADD_COMMENT_SUCCESS;
            $alert = 'success';
        } else {

            $message = static::FAIL;
            $alert = 'danger';
        }

        $this->article = new ArticleController();
        $this->article->article($chapter, $alert, $message);
    }

    public function reportComment()
    {
        $comment_id = $this->request->getParam('id');
        CommentManager::report($comment_id);

        $reportedComment = CommentManager::findOneById($comment_id);
        $article_id = $reportedComment['article_id'];

        $article = ArticleManager::findOneById($article_id);
        $chapter = $article['chapter_number'];

        header("Location: /article/article?chapter=$chapter#commentForm");
    }

}