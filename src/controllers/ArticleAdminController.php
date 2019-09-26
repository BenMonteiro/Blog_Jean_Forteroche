<?php
require_once ROOT_PATH.'/src/Controllers/AdminController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';


class ArticleAdminController extends AdminController
{
    const DEFAULT_TEMPLATE = 'Backend';
    const ADD_SUCCESS = 'Votre article a bien été ajouté';
    const UPDATE_SUCCESS = 'L\'article a été mis à jour avec succés';
    const DELETE_SUCCESS = 'L\'article a été supprimé avec succès';
    const FAIL = 'Un problème est survenu, veuillez rééssayé ultérieurement';

    public function index($alert = null , $message = null)
    {

        $articleList = ArticleManager::findAll();

        $this->renderView('manageArticle.twig', 
            [
                'articleList' => $articleList, 
                'alert' => $alert,
                'message' => $message
            ], static::DEFAULT_TEMPLATE
        );
    }

    public function updateForm()
    {
        $id = $this->request->getParam('id');
        $article = ArticleManager::findOneById($id);
        $authorList = UserManager::findAll();

        $this->renderView('updateArticleForm.twig', 
            [
                'article' => $article,
                'authorList' => $authorList
            ], static::DEFAULT_TEMPLATE
        );
    }

    public function update()
    {
        $id = $this->request->getParam('id');
        $updateArticle = $this->request->getParam('article');

        ArticleManager::update($updateArticle, $id);

        $this->index('success', static::UPDATE_SUCCESS);
    }

    public function addForm($alert = null, $message = null)
    {
        $authorList = UserManager::findAll();
        $this->renderView('addArticleForm.twig', 
            [
                'authorList' => $authorList,
                'alert' => $alert,
                'message' => $message
            ], static::DEFAULT_TEMPLATE);
    }

    public function add()
    {
        $newArticle = $this->request->getParam('article');
        $add = ArticleManager::add( $newArticle);

        $this->alertMessage('addForm', $add, static::ADD_SUCCESS);
    }

    public function delete()
    {
        $id = $this->request->getParam('id');
        $delete = ArticleManager::deleteById($id);

        $this->alertMessage('index', $delete, static::DELETE_SUCCESS);
    }
}
