<?php

require_once DIR.'Core/DefaultController.php';

class FrontController extends DefaultController
{

    public function HomePage()
    {
        $this->renderView('Frontend/accueil.twig', ['article' => 7]);
    }

    public function Chapter1Page()
    {
        $this->renderView('Frontend/chapitre1.twig', []);
    }

    public function Chapter2Page()
    {
        $this->renderView('Frontend/chapitre2.twig', []);
    }

    public function AuthorPage()
    {
        $this->renderView('Frontend/author.twig', []);
    }

    public function ContactPage()
    {
        $this->renderView('Frontend/contact.twig', []);
    }
}




