<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/4/2018
 * Time: 19:09
 */

class TestsModel extends Model
{

    protected $primaryKey = "test_id";
    protected $table = "tests";
    protected $fields = [
        "test_name", "test_description"
    ];

}