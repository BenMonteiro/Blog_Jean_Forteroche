<?php

require_once ROOT_PATH.'/core/DefaultController.php';
 
/**
* Controll the page to display 
*/
class FrontController extends DefaultController
{


    public function home()
    {
        $this->renderView('home.twig',[]);
    }

    public function chapter1()
    {
        $this->renderView('chapter1.twig', []);
    }

    public function chapter2()
    {
        $this->renderView('chapter2.twig', []);
    }

    public function author()
    {
        $this->renderView('author.twig');
    }

    public function contact()
    {
        $this->renderView('contact.twig');
    }

    public function error404()
    {
        $this->renderView('error404.html');
    }

    /**
     * Require the ContactFormManager class and the send method with $datas for parameters. 
     * $datas are the informations obtained via the contact form.
     * Then load the contactSuccess page
     */
    public function contactSuccess()
    {
        $data = [
            'subject' => $this->request->getPostParams('subject'),
            'message' => $this->request->getPostParams('message'),
            'headers' => [
                'FROM' => $this->request->getPostParams('firstname'). ' ' . $this->request->getPostParams('name'), 
                'Reply-To' => $this->request->getPostParams('email')]
            ];

        require_once ROOT_PATH.'/src/Services/Mail.php';
        $contactForm = new Mail();
        $contactForm->send($data);

        $this->renderView('contactSuccess.twig');
    }
}
