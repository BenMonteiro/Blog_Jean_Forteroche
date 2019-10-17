<?php
require_once ROOT_PATH.'/src/Controllers/AdminController.php';
require_once ROOT_PATH.'/src/Models/CommentManager.php';

/**
 * Control the comments administration page
 */
class CommentAdminController extends AdminController
{
    const DEFAULT_TEMPLATE = 'Backend';
    const VALID = 'Le commentaire à été notifié comme conforme';
    const DELETE = 'Le commentaire a été supprimé avec succés';
    const FAIL = 'Une erreur est survenue, le commentaire n\'a pas pu être modéré';

    /**
     * Display all the comments to moderate (reported comments are on the top of the list)
     * @param string $alert    [success or danger, the param to enter in the alert class in html file]
     * @param string $message    [the message to display]
     */
    public function index(string $alert = null, string $message = null)
    {
        $toModerateList = CommentManager::toModerate();
        $toModerateNumber = count($toModerateList);
        $reported = CommentManager::countReported();

        $this->renderView('commentsModeration.twig', 
            [
                'toModerateList' => $toModerateList,
                'toModerateNumber' => $toModerateNumber,
                'reported' => $reported,
                'alert' => $alert,
                'message' => $message
            ], static::DEFAULT_TEMPLATE
        );
    }

    /**
     * Set the moderation of the comment to true. 
     * Return to the index page with the right message
     */
    public function validate()
    {
        $id = $this->request->getParam('id');
        CommentManager::validate($id);
        $valid = CommentManager::findOneById($id);

        $this->alertMessage('index', $valid['moderate'], static::VALID, null);
    }

    /**
     * Function to delete a not yet moderated comment from the database.
     * Return to the index page with the right message
     */
    public function delete()
    {
        $id = $this->request->getParam('id');
        $delete = CommentManager::deleteById($id);

        $this->alertMessage('index', $delete, static::DELETE, null);
    }
}
