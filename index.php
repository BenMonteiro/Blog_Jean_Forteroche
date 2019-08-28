<?php

define('DIR', 'C:/wamp64/www/Blog_P4/');

require_once DIR.'Vendor/autoload.php';
$loader = new Twig_Loader_Filesystem(DIR.'src/Views/');
$twig = new Twig_Environment($loader);

require_once DIR.'src/Controllers/FrontController.php';
$viewController = new FrontController();

$page = $_GET['page'] ?? null;
switch($page)
{
    case 'Accueil':
        $viewController->displayHomePage();
    break;

    case 'chapitre1':
        $viewController->displayChapter1Page();
    break;

    case 'chapitre2':
        $viewController->displayChapter2Page();
    break;

    case 'author':
        $viewController->displayAuthorPage();
    break;

    case 'contact':
        $viewController->displayContactPage();
    break;

    default: 
        $viewController->displayHomePage();
}


