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
        $reportedCommentList = CommentManager::findReportedComments();
        $commentsToModerate = count($reportedCommentList);
        $this->renderView('commentsModeration.twig', 
            [
                'reportedCommentList' => $reportedCommentList, 
                'commentsToModerate' => $commentsToModerate
            ], static::DEFAULT_TEMPLATE
        );
    }

    public function validate()
    {
        $id = $this->request->getParam('id');
        CommentManager::validateComment($id);
        $this->moderation();
    }

    public function delete()
    {
        $id = $this->request->getParam('id');
        CommentManager::deleteById($id);
        $this->moderation();
    }
}