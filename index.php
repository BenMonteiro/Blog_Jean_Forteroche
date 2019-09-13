<?php
session_start();
//file path constant
define('ROOT_PATH', dirname(__FILE__));

//Twig configuration
require_once ROOT_PATH.'/vendor/autoload.php';
$loader = new Twig_Loader_Filesystem(ROOT_PATH.'/src/Views');
$twig = new Twig_Environment($loader);

require_once ROOT_PATH.'/core/PDOConnection.php';
$dbConnect = PDOConnection::getMySqlConnection();

//Creation of the routeur object and call to dispatch function
require_once ROOT_PATH.'/core/Routeur.php';
$routeur = new Routeur();
$routeur->dispatch();
