<?php
require_once ROOT_PATH.'/src/Controllers/BlogController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';

/**
* Controll the page to display 
*/
class ArticleController extends BlogController
{
    public function index()
    {
        $this->home();
    }

    public function article($id = null, $addCommentMesssage = null)
    {
        $id = (null === $id) ? $this->request->getParam('id') : $id;

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
                'creation_date' => $article['creation_date'],
                'date_of_update' => $article['date_of_update'],
                'commentList' => $commentList,
                'author' => $author['name'],
                'addCommentMessage' => $addCommentMesssage
            ]
        );
    }


}