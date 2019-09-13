<?php
/**
 * This class take the URL infos and assign it to variables
 */
class Request 
{
    protected $path;
    protected $urlComponent;
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
        $uri = $_SERVER["REQUEST_URI"];
        $path = trim(parse_url($uri, PHP_URL_PATH),"/");
        $urlComponent = explode('/', $path);
        $this->controllerName = isset($urlComponent[0]) ? $urlComponent[0] : null;
        $this->actionName = isset($urlComponent[1]) ? $urlComponent[1] : null;
    }

    /**
     * Request class is handled by singleton pattern. 
     * In this way, if a Request object already exist, the application use the same instance instead of create a new 
     */
    public static function getRequest()
    {
        if (null === static::$request) {

            static::$request = new Request();
        }

        return static::$request;
    }

    /**
     * @return       [return the name of the controller to call]
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return       [return the name of the action to call]
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @param string $key    [The key of the getdata we want to return ]
     * @return      [return the value of the key in parameter]
     */
    public function getGetParams(string $key)
    {
        if (isset($key)) {

            return htmlspecialchars($_GET[$key]);
        }
    }

    /**
     * @param string $key      [The key of the postData we want to return]
     * @return       [return the value of the key in parameter]
     */
    public function getPostParams(string $key)
    {
        if (isset($key)) {

        return htmlspecialchars($_POST[$key]);
        }
    }
}