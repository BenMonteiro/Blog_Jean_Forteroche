<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';

/**
* Controll the page to display 
*/
class CommentController extends DefaultController
{
    public function addComment()
    {
        $article_id = $this->request->getParam('id');
        $comment = $this->request->getParam('message');
        $author = $this->request->getParam('name');

        CommentManager::add($article_id, $comment, $author);
        header("Location: /article/article?id=".$article_id);
    }
}