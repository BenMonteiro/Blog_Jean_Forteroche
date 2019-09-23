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

    public function __construct()
    {
        parent::__construct();

        return $this->article = new ArticleController();
    }
    public function index()
    {
        $this->home();
    }

    public function addComment()
    {
        $article_id = $this->request->getParam('id');
        $comment = $this->request->getParam('message');
        $author = $this->request->getParam('name');

        $commentList = CommentManager::findArticleComments($article_id);
        $nbComment = count($commentList);
        $_SESSION['nbComment'] = $nbComment;

        CommentManager::add($article_id, $comment, $author);

        $newCommentList = CommentManager::findArticleComments($article_id);
        $newNbComments = count($newCommentList);
        $addCommentMessage = ($newNbComments === $_SESSION['nbComment'] + 1) ? static::ADD_COMMENT_SUCCESS : static::FAIL;

        $this->article->article($id = $article_id, $addCommentMessage);

    }

    public function reportComment()
    {
        $comment_id = $this->request->getParam('id');
        CommentManager::report($comment_id);

        $reportedComment = CommentManager::findOneById($comment_id);
        $article_id = $reportedComment['article_id'];

        ArticleManager::findOneById($article_id);
        $this->article->article($id = $article_id);
    }

}