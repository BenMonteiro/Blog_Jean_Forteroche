<?php
require_once ROOT_PATH.'/src/Controllers/BlogController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';
require_once ROOT_PATH.'/core/Exception/Exception404.php';

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
    public function display($chapterNumber = null , $alert = null, $message = null)
    {
        $chapterNumber = ($chapterNumber === null) ? $this->request->getParam('chapter') : $chapterNumber;
        $article = ArticleManager::findOneByChapterNumber($chapterNumber);

        if ($chapterNumber === null || empty($article['chapter_number'])) {
            throw new Exception404('La page que vous recherchez n\'existe pas');
        }

        $nbArticles = ArticleManager::count();
        $commentList = CommentManager::findArticleComments($article['id']);

        $this->renderView(
            'article.twig',
            [
                'articleList' => $this->articleList,
                'article' => $article,
                'chapterNumber' => $chapterNumber,
                'nbArticles' => $nbArticles,
                'commentList' => $commentList,
                'alert' => $alert,
                'message' => $message
            ]
        );
    }

    public function article()
    {
        try 
        {
            $this->display();

        } catch (Exception404 $e) {

            require_once ROOT_PATH.'/core/Error404Controller.php';
            $error404 = new Error404Controller();
            $error404->error($e);
        }
    }
}
