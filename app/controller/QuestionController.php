<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/5/2018
 * Time: 22:01
 */

class QuestionController extends BaseController
{

    public function openPage(){
        $u = new UserModel();

        $args = $this->getArguments();
       // die(var_dump($args));
        $user = $u->one(["test_key" => "'".$args["test_key"]."'"]);

        $response = [
            "user" => $user
        ];

        self::setParams($response);
        self::page("main","pages/test");
    }

    public function getQuestions(){

        //die($_GET["test_key"]);

        /**
         * Get test info
         */
        $args = $this->getArguments();

      //  $t = new TestsModel();
      //  $test = $t->where(["test_key" => $args["test_key"]]);

     //   die(var_dump($t));
        /**
         * Get questions
         */

        $q = new QuestionsModel();
        $questions = $q->where(["test_id" => $args["test_id"]]);

        $a = new AnswersModel();

        foreach ($questions as &$q) {
            $answers = $a->where(["question_id" => $q["question_id"]]);
            $q["answers"] = $answers;
        }


        die(json_encode($questions));


        /**
         * get for each question a answers
         */

    }

}