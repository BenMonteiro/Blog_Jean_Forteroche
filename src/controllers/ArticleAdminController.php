<?php
require_once ROOT_PATH.'/src/Controllers/AdminController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';

/**
 * Control the administration of articles, extends AdminController
 */
class ArticleAdminController extends AdminController
{
    const DEFAULT_TEMPLATE = 'Backend';
    const ADD_SUCCESS = 'Votre article a bien été ajouté';
    const UPDATE_SUCCESS = 'L\'article a été mis à jour avec succés';
    const DELETE_SUCCESS = 'L\'article a été supprimé avec succès';
    const FAIL = 'Un problème est survenu, veuillez rééssayé ultérieurement';

    /**
     * Display the page to update and delete articles
     * @param string $alert    [success or danger, the param to enter in the alert class in html file]
     * @param string $message    [the message to display]
     */
    public function index(string $alert = null , string $message = null)
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

    /**
     * Display the form to update an article
     */
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

    /**
     * Function call when the updateForm is submited, return to the index page with the adapted message
     */
    public function update()
    {
        $id = $this->request->getParam('id');
        $updateData = $this->request->getParam('article');

        ArticleManager::update($updateData, $id);

        $this->index('success', static::UPDATE_SUCCESS);
    }

    /**
     * Display the form to add a new article to the database
     * @param string $alert    [success or danger, the param to enter in the alert class in html file]
     * @param string $message    [the message to display]
     */
    public function addForm(string $alert = null, string $message = null, $chapterNumber = null)
    {
        
        $authorList = UserManager::findAll();

        $this->renderView('addArticleForm.twig', 
            [
                'authorList' => $authorList,
                'alert' => $alert,
                'message' => $message,
                'chapter_number' => $chapterNumber
            ], static::DEFAULT_TEMPLATE
        );
    }

    /**
     * Function call when the addForm is submited, return to the addForm page with the adapted message
     */
    public function add()
    {
        $newArticleData = $this->request->getParam('article');
        $add = ArticleManager::add($newArticleData);
        $chapterNumber = $newArticleData['chapter_number'];

        $this->alertMessage('addForm', $add, static::ADD_SUCCESS, $chapterNumber);
    }

    /**
     * Function call to delete an article from the database, return to the index page with the adapted message
     */
    public function delete()
    {
        $id = $this->request->getParam('id');
        $delete = ArticleManager::deleteById($id);

        $this->alertMessage('index', $delete, static::DELETE_SUCCESS);
    }
}
