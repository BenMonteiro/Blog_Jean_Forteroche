<?php

require_once DIR.'Core\DefaultController.php';

class FrontController extends DefaultController
{

    public function displayHomePage()
    {
        $this->renderView('Frontend/accueil.twig', ['article' => 7]);
    }

    public function displayChapter1Page()
    {
        $this->renderView('Frontend/chapitre1.twig', []);
    }

    public function displayChapter2Page()
    {
        $this->renderView('Frontend/chapitre2.twig', []);
    }

    public function displayAuthorPage()
    {
        $this->renderView('Frontend/author.twig', []);
    }

    public function displayContactPage()
    {
        $this->renderView('Frontend/contact.twig', []);
    }
}




