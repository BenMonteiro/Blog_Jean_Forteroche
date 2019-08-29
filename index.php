<?php

define('DIR', 'C:/wamp64/www/Blog_P4/');

require_once DIR.'Vendor/autoload.php';
$loader = new Twig_Loader_Filesystem(DIR.'src/Views/');
$twig = new Twig_Environment($loader);


require_once DIR.'Core/Routeur.php';
$routeur = new Routeur();
$routeur->dispatch();



