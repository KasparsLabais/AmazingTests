<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/4/2018
 * Time: 19:09
 */

class UserModel extends Model
{

    protected $primaryKey = "user_id";
    protected $table = "users";
    protected $fields = [
        "user_name", "test_id", "test_key", "test_length", "correct_answers", "current_question"
    ];

}