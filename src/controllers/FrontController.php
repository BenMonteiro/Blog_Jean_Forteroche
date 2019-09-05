<?php

require_once ROOT_PATH.'/core/DefaultController.php';

class FrontController extends DefaultController
{

    public function homePage()
    {
        $this->renderView('Frontend/accueil.twig', []);
    }

    public function chapter1Page()
    {
        $this->renderView('Frontend/chapitre1.twig', []);
    }

    public function chapter2Page()
    {
        $this->renderView('Frontend/chapitre2.twig', []);
    }

    public function authorPage()
    {
        $this->renderView('Frontend/author.twig', []);
    }

    public function contactPage()
    {
        $this->renderView('Frontend/contact.twig', []);
    }

    public function error404()
    {
        $this->renderView('Frontend/error404.html', []);
    }

    public function postContact()
    {
        require_once ROOT_PATH.'/src/Models/PostContact.php';
        $formResponse = new PostContact();
        $formResponse->send();
        
        $this->renderView('Frontend/contactSuccess.twig',[]);
    }
}




