<?php
require_once ROOT_PATH.'/src/Controllers/AdminController.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';

class CommentAdminController extends AdminController
{
    const DEFAULT_TEMPLATE = 'Backend';

    public function index()
    {
        $this->moderation();
    }
    
    public function moderation()
    {
        $toModerateList = CommentManager::toModerate();
        $toModerate = count($toModerateList);
        $reported = count(CommentManager::findReported());

        $this->renderView('commentsModeration.twig', 
            [
                'toModerateList' => $toModerateList,
                'toModerate' => $toModerate,
                'reported' => $reported
            ], static::DEFAULT_TEMPLATE
        );
    }

    public function validate()
    {
        $id = $this->request->getParam('id');
        CommentManager::validate($id);
        $this->moderation();
    }

    public function delete()
    {
        $id = $this->request->getParam('id');
        CommentManager::deleteById($id);
        $this->moderation();
    }
}