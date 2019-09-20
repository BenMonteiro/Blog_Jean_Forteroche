<?php
require_once ROOT_PATH.'/src/Controllers/AdminController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Models/UserManager.php';


class ArticleAdminController extends AdminController
{
    const DEFAULT_TEMPLATE = 'Backend';

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

    public function manageArticle($deleteSuccess = null, $updateSuccess = null)
    {
        $articleList = ArticleManager::findAll();

        $this->renderView('manageArticle.twig', 
            [
                'articleList' => $articleList, 
                'deleteSuccess' => $deleteSuccess,
                'updateSuccess' => $updateSuccess
            ], static::DEFAULT_TEMPLATE
        );
    }

    public function updateArticleForm()
    {
        $id = $this->request->getParam('id');
        $article = ArticleManager::findOneById($id);
        $author_id = $article['user_id'];
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

        $this->manageArticle($updateSuccess = 'L\'article a bien été mis à jour.');
    }

    public function deleteArticle()
    {
        $id = $this->request->getParam('id');
        ArticleManager::deleteById($id);
        $this->manageArticle($deleteSuccess = 'L\'article a été supprimé avec succès');
    }
}
