<?php

require_once 'core\DefaultController.php';

class ViewController extends DefaultController
{
    public function displayHomePage()
    {
        require_once 'src\views\Accueil.php';
        $this->renderView('src\views\template.php', ['content' => $content]);
    }

    public function displayChapter1Page()
    {
        require_once 'src\views\chapitres\chapitre1.php';
        $this->renderView('src\views\template.php', ['content' => $content]);
    }

    public function displayChapter2Page()
    {
        require_once 'src\views\chapitres\chapitre2.php';
        $this->renderView('src\views\template.php', ['content' => $content]);

    }

    public function displayAuthorPage()
    {
        require_once 'src\views\author.php';
        $this->renderView('src\views\template.php', ['content' => $content]);
    }

    public function displayContactPage()
    {
        require_once 'src\views\contact.php';
        $this->renderView('src\views\template.php', ['content' => $content]);
    }
}




