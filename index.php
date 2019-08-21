<?php

require_once './src/controllers/ViewController.php';
$viewController = new ViewController();

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


