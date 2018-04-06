<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/3/2018
 * Time: 17:38
 */

class Init
{


    public static function bootstrap(){
      //  echo getcwd();

       // echo $_SERVER["REQUEST_URI"];
        self::config();
        self::autoload();
        self::dispatch();

    }

    public static function config(){

        /**
         * Define variables
         */
/*




        define("APP_CONTROLLER", APP_ROOT."controller".SP);
        define("APP_MODELS", APP_ROOT."models".SP);

        define("PUBLIC_ROOT", ROOT."public".SP);

        define("RESOURCES", ROOT."resources".SP);
        define("RESOURCES_VIEWS", RESOURCES."views".SP);
        define("RESOURCES_SCRIPTS", RESOURCES."js".SP);
        define("RESOURCES_STYLES", RESOURCES."sass".SP);

        define("APP_ENGINE", APP_ROOT."frame".SP);
        define("APP_INIT", APP_ENGINE."init".SP);
        define("APP_DB", APP_ENGINE."db".SP);


        define("CONTROLLER_NAME", isset($_REQUEST["c"]) ? $_REQUEST["c"] : "Page");
        define("CONTROLLER_ACTION", isset($_REQUEST["a"]) ? $_REQUEST["a"] : "index");
*/

        define("SP", DIRECTORY_SEPARATOR);
        define("ROOT", getcwd().SP."..".SP);

        define("APP_ROOT", ROOT."app".SP);
        define("APP_CONFIG", ROOT."config".SP);
        define("APP_RESOURCES", ROOT."resources".SP);
        define("APP_FRAME", ROOT."frame".SP);
        define("APP_STORAGE", ROOT."storage".SP);

        define("APP_CONTROLLER", APP_ROOT."controller".SP);
        define("APP_MODELS", APP_ROOT."models".SP);
        define("APP_INIT", APP_FRAME."init".SP);
        define("APP_DB", APP_FRAME."db".SP);
        define("APP_LOGS", APP_STORAGE."logs".SP);

        define("APP_ACTION", $_SERVER["REQUEST_URI"]);
        define("APP_METHOD", $_SERVER["REQUEST_METHOD"]);

        /**
         *  TODO: For now it is empty , but there should be some amazing stuff
         */
        $GLOBALS["app"] = include APP_CONFIG."app.php";


        require  APP_INIT."Logs.php";
        require  APP_DB."Database.php";
        require  APP_INIT."Model.php";

        session_start();
    }

    private static function autoload(){
        /**
         *  load my cool classes like big boys
         */
        spl_autoload_register(array(__CLASS__,'load'));
    }

    private static function load($class){

        /**
         * As laravel - if contains "Controller" it been called from controllers ELSE it will be perceived as Model
         */
        if(substr($class, -10) == "Controller") {
            require_once APP_CONTROLLER."$class.php";
        } elseif($class != "Model") {
            /**
             * Add ugly if statement because I wanted to sleep.
             * But it did a Trick!!!
             */
            require_once APP_MODELS."$class.php";
        }

    }

    private static function dispatch(){
        /**
         * TODO: Make this nice
         */
        $lastSlash = strpos(APP_ACTION, "/", 1);
        $actionLength = strlen(APP_ACTION)-1;

        $action = APP_ACTION;
        $arguments = [];

        /**
         * Remove last slash , but you know there could be more than 1 so....yeah
         */
        if($lastSlash == $actionLength) {
            $action = substr(APP_ACTION, 0, $actionLength);
        }

        /**
         *  Check if there is no values passed as params
         */
        if(strpos($action, "?") != 0) {

            foreach ($_GET as $k => $v) {
                $arguments[$k] = $v;
            }

            $action  = substr($action, 0, strpos($action, "?"));
        }

        /**
         * Super Duper ugly routing stuff. To be fair it should be in different class I think.
         * But it does what it should do like charm
         */

        if(APP_METHOD == "GET") {

            switch ($action) {
                case "":
                case "/":
                    $controllerName = "PageController";
                    $actionName = "index";
                    break;
                case "/anketa":
                    $controllerName = "PageController";
                    $actionName = "tests";
                    break;
                case "/questions":
                    $controllerName = "QuestionController";
                    $actionName = "getQuestions";
                    break;
                default:
                    $controllerName = "PageController";
                    $actionName = "notFound";
                    break;
            }

            /*ugly stuff*/
            if(substr($action, 0, 6) == "/test/") {
                $controllerName = "QuestionController";
                $actionName = "openPage";

                $arguments = [
                    "test_key"  => substr($action, 6)
                ];
            }


        } else {

            switch ($action) {
                case "/user" :
                   // die("hallo");
                    $controllerName = "UserController";
                    $actionName = "createUser";
                    break;
                case "/answer":
                    $controllerName = "UserController";
                    $actionName = "updateUser";
                    break;
                default:
                    $controllerName = "PageController";
                    $actionName = "notFound";
                    break;
            }
        }

        /**
         * Call corresponding controller for specific route
         */
        $controller = new $controllerName;

        /**
         *  Set arguments
         */
        if(!empty($arguments)) {
            $controller->setArguments($arguments);
        }

        /**
         * Call specific function from rout!
         * TODO: Should add some check for cases if function doesn't exist!
         */
        $controller->$actionName();
    }

}