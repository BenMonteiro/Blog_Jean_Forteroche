<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';


class AdminController extends DefaultController
{
    const DEFAULT_TEMPLATE = 'Backend';

    public function __construct()
    {
        parent::__construct();
        return $this->isAuthentified();
    }
 
    public function index()
    {
        header("Location: /login/login");
    }

    public function isAuthentified()
    {
        if (false === $_SESSION['auth'] || !isset($_SESSION['auth'])) {

            header("location: /login/errorLog");
        }
    }

    public function home()
    {
        $this->renderView('adminHome.twig', ['admin' => $_SESSION['admin']], static::DEFAULT_TEMPLATE);
    }

    public function addArticleForm()
    {
        $authorList = UserManager::findAll();
        $this->renderView('addArticleForm.twig', ['authorList' => $authorList], static::DEFAULT_TEMPLATE);
    }

    public function addArticle()
    {
        $title = $this->request->getParam('title');
        $imageURL = $this->request->getParam('imageURL');
        $imageDescription = $this->request->getParam('imageDescription');
        $chapterDescription = $this->request->getParam('chapterDescription');
        $content = $this->request->getParam('chapterText');
        $user_id = $this->request->getParam('author');

        ArticleManager::add( $imageURL, $imageDescription, $title, $content, $chapterDescription, $user_id);
        $this->renderView('adminHome.twig', ['admin' => $_SESSION['admin'], 'addSuccess' => 'Votre article a bien été ajouté'], static::DEFAULT_TEMPLATE);
    }

    public function manageArticle()
    {
        $this->renderView('manageArticle.twig', [], static::DEFAULT_TEMPLATE);
    }


    public function commentsModeration()
    {
        $this->renderView('commentsModeration.twig', [], static::DEFAULT_TEMPLATE);
    }
}