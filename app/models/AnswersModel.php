<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/4/2018
 * Time: 19:09
 */

class AnswersModel extends Model
{

    protected $primaryKey = "answer_id";
    protected $table = "answers";
    protected $fields = [
        "answer_text", "answer_correct", "question_id"
    ];

}