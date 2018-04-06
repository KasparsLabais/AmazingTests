<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/3/2018
 * Time: 19:34
 */

class BaseController
{

    private $params = [];
    private $arguments = [];

    public function setArguments($args = []) {
        $this->arguments = $args;
        return $this->arguments;
    }

    public function getArguments() {
        return $this->arguments;
    }

    public function __construct()
    {
    }

    public function page($view,$page){

        $response = [
            "construct" => [
                "page" => $page,
                "view" => $view
            ],
            "params" => $this->params
        ];

        include APP_RESOURCES."views".SP.$view.".php";
    }

    public function setParams($params){
        $this->params = $params;
    }

    public function getParams() {
        return $this->params;
    }

    public function notFound(){
       // header("Location: 404.php");
        include APP_RESOURCES."views".SP."404.php";
    }
}