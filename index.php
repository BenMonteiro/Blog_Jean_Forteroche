<?php

define('ROOT_PATH', dirname(__FILE__));
session_start();

require_once ROOT_PATH.'/vendor/autoload.php';
$loader = new Twig_Loader_Filesystem(ROOT_PATH.'/src/Views');
$twig = new Twig_Environment($loader);


require_once ROOT_PATH.'/core/Routeur.php';
$routeur = new Routeur();
$routeur->dispatch();




