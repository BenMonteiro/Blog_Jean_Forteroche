<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Services/Mail.php';

/**
* Control the contact feature
*/
class ContactController extends DefaultController
{
    protected $articleList;

    const MAIL_SUCCESS = 'Merci de nous avoir contacté !';
    const FAIL = 'Un problème est survenu, veuillez rééssayer ultérieurement';

    /**
     * Display the page of the contact from
     * @param string $alert    [success or danger, the param to enter in the alert class in html file]
     * @param string $message    [the message to display]
     */
    public function index(string $alert = null, string $message = null)
    {
        $this->articleList = ArticleManager::findAll();
        $this->renderView('contact.twig',
            [
                'articleList' => $this->articleList,
                'alert' => $alert,
                'message' => $message
            ]
        );
    }

    /**
     * Collect the infos passed in the contact form and send an email to the administrator.
     * Display index page with adapted message
    */
    public function sendMail()
    {
        $subject = $this->request->getParam('subject');
        $mailMessage = $this->request->getParam('message');
        $headers = [
            'FROM' => $this->request->getParam('firstname'). ' ' . $this->request->getParam('name'), 
            'Reply-To' => $this->request->getParam('email')
        ];

        $contactForm = new Mail();
        $contact = $contactForm->send($subject, $mailMessage, $headers);

        if ($contact === true){

            $alert = 'success';
            $message = static::MAIL_SUCCESS;

        } else {

            $alert = 'danger';
            $message = static::FAIL;
        }

        $this->index($alert, $message);
    }
}
