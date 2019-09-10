<?php
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
         */
        global $twig;
        $this->twig = $twig;
        $this->request = Request::getRequest();
    }

    /**
     * Display a view file with infos on parameters
     * 
     * @param string $view      [the file to display]
     * @param array $data      [parameters given to the view]
     * @return [void]       [if the file of the view exist, it load the block embeding the view in the template]
     */
    public function renderView(string $view = '', array $data = [], $DefaultPath = ROOT_PATH.'/src/Views/Frontend/Pages/' ): void
    {
        if (file_exists($DefaultPath.$view)) {

            echo $this->twig->render('Frontend/Pages/'.$view, $data);
        } else {

            echo $this->twig->render('Backend/Pages/'.$view, $data);
        }
    }
}