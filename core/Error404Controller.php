<?php
require_once ROOT_PATH.'/core/DefaultController.php';

/**
 * This class redirect to the error 404 page
 */
class Error404Controller extends DefaultController
{
      /**
     * Display a view file with infos on parameters
     * 
     * @param $e      [exception to call]
     * @return [void]       [display the error404 page]
     */
    public function error($e): void 
    {
        $this->renderView('error404.twig', ['message' => $e->getMessage()]);
    }
}
