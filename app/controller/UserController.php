<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/4/2018
 * Time: 21:42
 */

class UserController extends BaseController
{

    public function createUser(){

        /**
         * TODO: Add some backend check for values;
         */

        $t = new QuestionsModel();
        $questions = $t->where(["test_id" => $_POST["test_id"]]);

        $amount = 0;

        if($questions) {
            $amount = count($questions);
        }

        $params = [
            "user_name" =>  $_POST["user_name"],
            "test_id" => $_POST["test_id"],
            "test_key" => $_POST["hash"],
            "test_length" => $amount
        ];

        $u = new UserModel();
        $entry = $u->insert($params);

        $response = [
            "success" => 1,
            "payload" => $entry
        ];

        die(json_encode($response));
    }


    public function updateUser(){

        $params = [
            "correct_answers" =>  $_POST["correct"]+$_POST["answer"],
            "current_question" => $_POST["current"]+1,
        ];

        //"user_name", "test_id", "test_key", "test_length", "correct_answers", "current_question"

        $u = new UserModel();
        $entry = $u->update($params, ["user_id" => $_POST["user_id"]]);

        if($entry) {
            die(json_encode(["success" => 1, "current" => $_POST["current"]+1, "correct" => $_POST["correct"]+$_POST["answer"]]));
        }

        die(json_encode(["success" => 0, "message" => "Do not know!"]));
    }

}