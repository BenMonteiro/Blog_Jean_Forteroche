<?php
require_once ROOT_PATH.'/src/Controllers/AdminController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';


class ArticleAdminController extends AdminController
{
    const DEFAULT_TEMPLATE = 'Backend';
    const ADD_SUCCESS = 'Votre article a bien été ajouté';
    const UPDATE_SUCCESS = 'Votre article a bien été mis à jour';
    const DELETE_SUCCESS = 'L\'article a été supprimé avec succès';
    const FAIL = 'Un problème est survenu, veuillez rééssayé ultérieurement';

    public function addForm($addMessage = null)
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

        $add = ArticleManager::add( $imageURL, $imageDescription, $title, $content, $chapterDescription, $user_id);

        $addMessage = ($add == true) ? static::ADD_SUCCESS : static::FAIL;

        $this->addForm($addMessage);
    }

    public function index($deleteMessage = null, $updateMessage = null)
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
        $title = $this->request->getParam('title');
        $imageURL = $this->request->getParam('imageURL');
        $imageDescription = $this->request->getParam('imageDescription');
        $chapterDescription = $this->request->getParam('chapterDescription');
        $content = $this->request->getParam('chapterText');
        $author_id = $this->request->getParam('author');
        $user_id = $author_id;

        $update = ArticleManager::update($imageURL, $imageDescription, $title, $content, $chapterDescription, $user_id, $id);

        $updateMessage = ($update == true) ? static::UPDATE_SUCCESS : static::FAIL;

        $this->index($updateMessage);
    }

    public function delete()
    {
        $id = $this->request->getParam('id');
        $delete = ArticleManager::deleteById($id);

        $deleteMessage = ($delete == true) ? static::DELETE_SUCCESS : static::FAIL;
        
        $this->index($deleteMessage);
    }
}
