<?php
require_once ROOT_PATH.'/src/Controllers/AdminController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';


class ArticleAdminController extends AdminController
{
    protected $nbArticles;
    protected $newNbArticles;

    const DEFAULT_TEMPLATE = 'Backend';
    const ADD_SUCCESS = 'Votre article a bien été ajouté';
    const UPDATE_SUCCESS = 'Votre article a bien été mis à jour';
    const DELETE_SUCCESS = 'L\'article a été supprimé avec succès';
    const FAIL = 'Un problème est survenu, veuillez rééssayé ultérieurement';

    public function __construct()
    {
        parent::__construct();

        $articleList = ArticleManager::findAll();
        $nbArticles = count($articleList);
        $_SESSION['nbArticles'] = $nbArticles;
    }

    public function index()
    {
        $this->home();
    }

    public function addArticleForm($addMessage = null)
    {
        $authorList = UserManager::findAll();
        $this->renderView('addArticleForm.twig', ['authorList' => $authorList, 'addMessage' => $addMessage], static::DEFAULT_TEMPLATE);
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

        $newArticleList = ArticleManager::findAll();
        $this->newNbArticles = count($newArticleList);
        $addMessage = ($this->newNbArticles === $_SESSION['nbArticles'] + 1) ? static::ADD_SUCCESS : static::FAIL;

        $this->addArticleForm($addMessage);
    }

    public function manageArticle($deleteMessage = null, $updateMessage = null)
    {
        $articleList = ArticleManager::findAll();

        $this->renderView('manageArticle.twig', 
            [
                'articleList' => $articleList, 
                'deleteMessage' => $deleteMessage,
                'updateMessage' => $updateMessage
            ], static::DEFAULT_TEMPLATE
        );
    }

    public function updateArticleForm()
    {
        $id = $this->request->getParam('id');
        $article = ArticleManager::findOneById($id);
        $authorList = UserManager::findAll();

        $this->renderView('updateArticleForm.twig', 
            [
                'id' => $article['id'],
                'title' => $article['title'],
                'image_url' => $article['image_url'], 
                'alt_image' => $article['alt_image'], 
                'content' => $article['content'],
                'description' => $article['chapter_description'],
                'authorList' => $authorList
            ], static::DEFAULT_TEMPLATE
        );
    }

    public function updateArticle()
    {
        $id = $this->request->getParam('id');
        $title = $this->request->getParam('title');
        $imageURL = $this->request->getParam('imageURL');
        $imageDescription = $this->request->getParam('imageDescription');
        $chapterDescription = $this->request->getParam('chapterDescription');
        $content = $this->request->getParam('chapterText');
        $user_id = $this->request->getParam('author');

        ArticleManager::update($imageURL, $imageDescription, $title, $content, $chapterDescription, $user_id, $id);

        $article = ArticleManager::findOneById($id);
        $updateMessage = ($article['date_of_update'] !== null) ? static::UPDATE_SUCCESS : static::FAIL;

        $this->manageArticle($updateMessage);
    }

    public function deleteArticle()
    {
        $id = $this->request->getParam('id');
        ArticleManager::deleteById($id);

        $newArticleList = ArticleManager::findAll();
        $this->newNbArticles = count($newArticleList);
        $deleteMessage = ($this->newNbArticles === $_SESSION['nbArticles'] - 1) ? static::DELETE_SUCCESS : static::FAIL;
        
        $this->manageArticle($deleteMessage);
    }
}
