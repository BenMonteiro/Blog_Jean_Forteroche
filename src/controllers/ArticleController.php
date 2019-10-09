<?php
require_once ROOT_PATH.'/src/Controllers/BlogController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';

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
    public function article($chapter_number = null , $alert = null, $message = null)
    {
        $chapter_number = ($chapter_number === null) ? $this->request->getParam('chapter') : $chapter_number;
        $article = ArticleManager::findByChapterNumber($chapter_number);

        $nbArticles = count($this->articleList);
        $commentList = CommentManager::findArticleComments($article['id']);

        $this->renderView(
            'article.twig',
            [
                'articleList' => $this->articleList,
                'article' => $article,
                'chapter' => $chapter_number,
                'nbArticles' => $nbArticles,
                'commentList' => $commentList,
                'alert' => $alert,
                'message' => $message
            ]
        );
    }
}
