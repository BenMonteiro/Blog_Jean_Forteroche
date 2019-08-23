<?php

require_once 'core\DefaultController.php';

class FrontController extends DefaultController
{

    private static $_template = 'src/views/template.php';

    public function displayHomePage()
    {
        $this->renderView('Accueil', ['content' => $this->content], self::$_template);
    }

    public function displayChapter1Page()
    {
        $this->renderView('chapitre1', ['content' => $this->content], self::$_template);
    }

    public function displayChapter2Page()
    {
        $this->renderView('chapitre2', ['content' => $this->content], self::$_template);
    }

    public function displayAuthorPage()
    {
        $this->renderView('author', ['content' => $this->content], self::$_template);
    }

    public function displayContactPage()
    {
        $this->renderView('contact', ['content' => $this->content], self::$_template);
    }
}




