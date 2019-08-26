<?php

require_once 'core\DefaultController.php';

class FrontController extends DefaultController
{
    private static $_template = './src/views/template.php';

    public function displayHomePage()
    {
        $this->getView(self::$_template, 'Accueil');
    }

    public function displayChapter1Page()
    {
        $this->getView(self::$_template, 'chapitre1');

    }

    public function displayChapter2Page()
    {
        $this->getView(self::$_template, 'chapitre2');
    }

    public function displayAuthorPage()
    {
        $this->getView(self::$_template, 'author');
    }

    public function displayContactPage()
    {
        $this->getView(self::$_template, 'contact');
    }
}




