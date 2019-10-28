<?php
/**
 * This class take the URL infos and assign it to variables
 */
class Request 
{
    protected $controllerName;
    protected $actionName;

    private static $request = null;

    /**
     * Construct analyse the URL path and decomposed it to get Url components.
     * The first element [0] of the URL is the controller name 
     * The second element [1] is the action name 
     */
    public function __construct()
    {
        $this->controllerName = !empty($this->getURLComponents()[0]) ? ucfirst($this->getURLComponents()[0].'Controller') : null;
        $this->actionName = $this->getURLComponents()[1] ?? null;
    }

    /**
     * Request class is handled by singleton pattern. 
     * In this way, if a Request object already exist, the application use the same instance instead of create a new 
     * @return      [return an instance of the class]
     */
    public static function getRequest()
    {
        return static::$request ?? new Request();
    }

    /**
     * Break down the url to get the different components of it
     * @return     [return an array of the url components]
     */
    public function getURLComponents()
    {
        $uri = $_SERVER["REQUEST_URI"];
        $path = trim(parse_url($uri, PHP_URL_PATH),"/");
        $urlComponent = explode('/', $path);

        return $urlComponent;
    }

    /**
     * @return      [return the name of the controller to call]
     */
    public function getControllerName() 
    {
        return $this->controllerName;
    }

    /**
     * @return        [return the name of the action to call]
     */
    public function getActionName()
    {
        return $this->actionName;
    }

       /**
     * @param $key    [The key of the data we want to return ]
     * @param $defaultValue     [the defaultValue of the param]
     * @return     [return the value of the key in parameter]
     */
    public function getParam($key, $defaultValue = null)
    {
        return $this->getGetParam($key) ??
            $this->getPostParam($key) ??
            $defaultValue;
    }

    /**
     * @param $key    [The key of the getdata we want to return ]
     * @param $defaultValue     [the defaultValue of the param]
     * @return     [return the value of the key in parameter]
     */
    public function getGetParam($key, $defaultValue = null)
    {
        return isset($_GET[$key]) ? 
            ($_GET[$key]) : 
            $defaultValue;
    }

    /**
     * @param $key      [The key of the postData we want to return]
     * @param $defaultValue     [the defaultValue of the param]
     * @return      [return the value of the key in parameter]
     */
    public function getPostParam($key, $defaultValue = null)
    {
        return isset($_POST[$key]) && '' !== $_POST[$key] ? 
            ($_POST[$key]) :
            $defaultValue;
    }
}
