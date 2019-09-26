<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';
require_once ROOT_PATH.'/src/Services/Mail.php';


/**
* Controll the page to display 
*/
class ContactController extends DefaultController
{
    protected $articleList;

    const MAIL_SUCCESS = 'Merci de nous avoir contacté !';
    const FAIL = 'Un problème est survenu, veuillez rééssayer ultérieurement';

    public function index()
    {
        $this->contactForm();
    }

    public function contactForm($alert = null, $message = null)
    {
        $this->articleList = ArticleManager::findAll();
        $this->renderView('contact.twig',
            [
                'articleList' => $this->articleList,
                'alert' => $alert,
                'message' => $message
            ]);
    }

    /**
     * Require the ContactFormManager class and the send method with $datas for parameters. 
     * $datas are the informations obtained via the contact form.
     * Then load the contactSuccess page
    */
    public function contact()
    {
        $subject = $this->request->getParam('subject');
        $mailMessage = $this->request->getParam('message');
        $headers = [
            'FROM' => $this->request->getParam('firstname'). ' ' . $this->request->getParam('name'), 
            'Reply-To' => $this->request->getParam('email')
        ];

        $contactForm = new Mail();
        $contact = $contactForm->send($subject, $mailMessage, $headers);

        if ($contact == true){

            $alert = 'success';
            $message = static::MAIL_SUCCESS;
        } else {

            $alert = 'danger';
            $message = static::FAIL;
        }

        $this->contactForm($alert, $message);
    }
}
