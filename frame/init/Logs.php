<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/4/2018
 * Time: 18:01
 */

class Logs
{
    private $logDate;
    private $logName;
    private $logText;


    public function setLogDate($date = ""){
        if($date == "") {
            $date = date("Y-m-d H:i:s");
        }
        $this->logDate = $date;
        return $this->logDate;
    }

    public function getLogDate(){
        return $this->logDate;
    }

    public function setLogName($name = ""){

        if($name == "") {
            $name = "access_log.txt";
        }

        if(substr($name, -4) != ".txt") {
            $name = $name.".txt";
        }

        $this->logName = $name;
        return $this->logName;
    }

    public function getLogName(){
        return $this->logName;
    }

    public function setLogText($text = ""){
        $this->logText = $text;
        return $this->logText;
    }

    public function getLogText(){
        return $this->logText;
    }

    public function __construct($list = array())
    {
        self::setLogDate();
        self::setLogName();
        self::setLogText();
    }

    public function saveLog()
    {
        $text = "[".$this->logDate."]".$this->logText.PHP_EOL;
        file_put_contents(APP_LOGS.$this->logName, $text,FILE_APPEND);
    }

}