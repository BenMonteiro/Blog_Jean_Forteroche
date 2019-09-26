<?php
require_once ROOT_PATH.'/src/Controllers/AdminController.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';

class CommentAdminController extends AdminController
{
    const DEFAULT_TEMPLATE = 'Backend';
    const VALID = 'Le commentaire à été notifié comme conforme';
    const DELETE = 'Le commentaire a été supprimé avec succés';
    const FAIL = 'Une erreur est survenue, le commentaire n\'a pas pu être modéré';

    public function index($alert = null, $message = null)
    {
        $toModerateList = CommentManager::toModerate();
        $toModerate = count($toModerateList);
        $reported = count(CommentManager::findReported());

        $this->renderView('commentsModeration.twig', 
            [
                'toModerateList' => $toModerateList,
                'toModerate' => $toModerate,
                'reported' => $reported,
                'alert' => $alert,
                'message' => $message
            ], static::DEFAULT_TEMPLATE
        );
    }

    public function validate()
    {
        $id = $this->request->getParam('id');
        CommentManager::validate($id);
        $valid = CommentManager::findOneById($id);

        $this->alertMessage('index', $valid['moderate'], static::VALID);

    }

    public function delete()
    {
        $id = $this->request->getParam('id');
        $delete = CommentManager::deleteById($id);

        $this->alertMessage('index', $delete, static::DELETE);
    }
}


