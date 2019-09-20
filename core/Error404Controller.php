<?php
require_once ROOT_PATH.'/core/DefaultController.php';

class Error404Controller extends DefaultController
{

    public function error($e)
    {
        $this->renderView('error404.twig', ['message' => $e->getMessage()]);
    }
}