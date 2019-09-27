<?php
require_once ROOT_PATH.'/src/Models/Manager.php';
/**
 * All controllers have to extend this class
 */
class DefaultController
{
    protected $request;

    public function __construct()
    {
        /**
         * Twig is loaded in the index.php file.
         * So we use it in global.
         * Request class is also loaded in the construct to allow all controllers to use it.
         * *Manager class is loaded to allow access to all managers in the controllers.
         */
        global $twig;
        $this->twig = $twig;
        $this->request = Request::getRequest();
        new Manager();
    }

    /**
     * Display a view file with infos on parameters
     * @param string $view      [the file to display]
     * @param array $data      [parameters given to the view]
     * @param string $viewFolder    [name of the folder of the called view]
     * @return [void]       [if the file of the view exist, it load the view in the template]
     */
    public function renderView(string $view = '', array $data = [], string $viewFolder = null ): void
    {
        $output = '';

        $viewFolder = $viewFolder ?? 'Frontend';
        $defaultPath = ROOT_PATH.'/src/Views/'.$viewFolder.'/Pages/';

        if (file_exists($defaultPath.$view)) {

            $output = $this->twig->render($viewFolder.'/Pages/'.$view, $data);

            echo $output;
        }
    }
}
