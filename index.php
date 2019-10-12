<?php
session_start();
//file path constant
define('ROOT_PATH', dirname(__FILE__));

//Creation of the routeur object and call to dispatch function
require_once ROOT_PATH.'/core/Routeur.php';
$routeur = new Routeur();
$routeur->dispatch();
