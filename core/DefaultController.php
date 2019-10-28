<?php
/**
 * All controllers have to extend this class
 */
abstract class DefaultController
{
    protected $request;
    protected static $twig = null;

    public function __construct()
    {
        /**
         * Request class is also loaded in the construct to allow all controllers to use it.
         * *Manager class is loaded to allow access to all managers in the controllers.
         */
        $this->request = Request::getRequest();
    }

    protected function getTwig()
    {
        //Twig configuration
        if (null === static::$twig) {
            require_once ROOT_PATH.'/vendor/autoload.php';
            $loader = new Twig_Loader_Filesystem(ROOT_PATH.'/src/Views');
            static::$twig = new Twig_Environment($loader);
        }

        return static::$twig;
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
            $output = $this->getTwig()->render($viewFolder.'/Pages/'.$view, $data);

            echo $output;
        }
    }
}
