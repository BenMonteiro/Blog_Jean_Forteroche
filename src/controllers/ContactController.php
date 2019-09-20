<?php
require_once ROOT_PATH.'/core/DefaultController.php';
require_once ROOT_PATH.'/src/Models/ArticleManager.php';

/**
* Controll the page to display 
*/
class ContactController extends DefaultController
{
    protected $articleList;

    public function __construct()
    {
        parent::__construct();
        return $this->articleList = ArticleManager::findAll();
    }

    public function index()
    {
        $this->contact();
    }

    public function contact()
    {
        $this->renderView('contact.twig',['articleList' => $this->articleList]);
    }

    /**
     * Require the ContactFormManager class and the send method with $datas for parameters. 
     * $datas are the informations obtained via the contact form.
     * Then load the contactSuccess page
    */
    public function contactSuccess()
    {
        $subject = $this->request->getParam('subject');
        $message = $this->request->getParam('message');
        $headers = [
            'FROM' => $this->request->getParam('firstname'). ' ' . $this->request->getParam('name'), 
            'Reply-To' => $this->request->getParam('email')
        ];

        require_once ROOT_PATH.'/src/Services/Mail.php';
        $contactForm = new Mail();
        $contactForm->send($subject, $message, $headers);

        $this->renderView('contactSuccess.twig',['articleList' => $this->articleList]);
    }
}
