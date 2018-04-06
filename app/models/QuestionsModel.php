<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/4/2018
 * Time: 19:09
 */

class QuestionsModel extends Model
{

    protected $primaryKey = "question_id";
    protected $table = "questions";
    protected $fields = [
        "question_name"
    ];

}