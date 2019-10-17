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
        $articleId = $this->request->getParam('id');
        $comment = $this->request->getParam('comment');

        $add = CommentManager::add($articleId, $comment);

        if ($add == true) {

            $message = static::ADD_COMMENT_SUCCESS;
            $alert = 'success';

        } else {

            $message = static::FAIL;
            $alert = 'danger';
        }

        $chapterNumber = $this->request->getParam('chapter');

        $articleController = new ArticleController();
        $articleController->article($chapterNumber, $alert, $message);
    }

    /**
     * function to report a comment
     */
    public function report()
    {
        $commentId = $this->request->getParam('id');
        $chapterNumber = $this->request->getParam('chapter');

        CommentManager::report($commentId);

        header("Location: /article/article?chapter=$chapterNumber#commentForm");
    }
}
