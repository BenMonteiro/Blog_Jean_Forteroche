<?php
require_once ROOT_PATH.'/src/Controllers/BlogController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';

/**
* Control the page to display one article
*/
class ArticleController extends BlogController
{
    public function index()
    {
        $this->home();
    }

    /**
     * Display an article found by his chapter number
     * @param $chapter      [the number of the article chapter we want to display]
    * @param $alert    [success or danger, the param to enter in the alert class in html file]
     * @param $message    [the message to display]
     */
    public function article($chapter = null , $alert = null, $message = null)
    {
        $chapter = ($chapter === null) ? $this->request->getParam('chapter') : $chapter;
        $article = ArticleManager::findByChapterNumber($chapter);

        $nbArticles = count($this->articleList);
        $commentList = CommentManager::findArticleComments($article['id']);

        $this->renderView(
            'article.twig',
            [
                'articleList' => $this->articleList,
                'article' => $article,
                'chapter' => $chapter,
                'nbArticles' => $nbArticles,
                'commentList' => $commentList,
                'alert' => $alert,
                'message' => $message
            ]
        );
    }
}
