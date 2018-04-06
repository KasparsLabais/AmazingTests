<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/3/2018
 * Time: 20:36
 */

class PageController extends BaseController {

    public function index(){

        $test = new TestsModel();
        $allTests = $test->get();

        $response = [
            "tests" => []
        ];

        if($allTests) {
            $response["tests"] = $allTests;

            $rand1 = rand(0,99999);
            $rand2 = rand(0,99999);

            $response["hash"] = crypt($rand1, $rand2);
        }

        self::setParams($response);
        self::page("main","pages/index");
    }

    public function tests(){

    }

    public function questions(){
        return page();
    }


}