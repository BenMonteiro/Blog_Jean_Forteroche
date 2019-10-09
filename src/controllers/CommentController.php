<?php
require_once ROOT_PATH.'/src/Controllers/BlogController.php';
require_once ROOT_PATH.'/src/Controllers/ArticleController.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';

/**
* Control comments in client side of the website
*/
class CommentController extends BlogController
{
    const ADD_COMMENT_SUCCESS = "Votre commentaire a bien été ajouté";
    const FAIL = 'Nous n\'avons pas pu ajouté votre commentaire, veuillez rééssayer ultérieurement';

    public function index()
    {
        $this->home();
    }

    /**
     * function to add a comment on the display article 
     * Display the article page
     */
    public function add()
    {
        $article_id = $this->request->getParam('id');
        $comment = $this->request->getParam('comment');

        $add = CommentManager::add($article_id, $comment);

        if ($add == true) {

            $message = static::ADD_COMMENT_SUCCESS;
            $alert = 'success';

        } else {

            $message = static::FAIL;
            $alert = 'danger';
        }

        $chapter_number = $this->request->getParam('chapter');

        $articleController = new ArticleController();
        $articleController->article($chapter_number, $alert, $message);
    }

    /**
     * function to report a comment
     */
    public function report()
    {
        $comment_id = $this->request->getParam('id');
        $chapter_number = $this->request->getParam('chapter');

        CommentManager::report($comment_id);

        header("Location: /article/article?chapter=$chapter_number#commentForm");
    }
}
