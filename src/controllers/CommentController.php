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

    public function add()
    {
        $chapter = $this->request->getParam('chapter');
        $article = ArticleManager::findByChapterNumber($chapter);


        $article_id = $article['id'];
        $comment = $this->request->getParam('comment');
        $chapter = $article['chapter_number'];

        $add = CommentManager::add($article_id, $comment);

        $addCommentMessage = ($add == true) ? static::ADD_COMMENT_SUCCESS : static::FAIL;

        $this->article->article($chapter, $addCommentMessage);

    }

    public function reportComment()
    {
        $comment_id = $this->request->getParam('id');
        CommentManager::report($comment_id);

        $reportedComment = CommentManager::findOneById($comment_id);
        $article_id = $reportedComment['article_id'];

        $article = ArticleManager::findOneById($article_id);
        $chapter = $article['chapter_number'];

        $this->article->article($chapter);
    }

}