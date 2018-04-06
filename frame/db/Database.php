<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/3/2018
 * Time: 23:24
 */

class Database
{

    const DB_USER = "root";
    const DB_PW = "";
    const DB_NAME = "anketas";
    const DB_PORT = "3306";

    private $con = false;

    private $host;
    private $pw;
    private $user;
    private $db;
    private $port;

    private $errorMessage = "";

    public function __construct($params = array())
    {
        $this->host = isset($params["host"]) ? $params["host"] : "localhost";
        $this->user = isset($params["user"]) ? $params["user"] : self::DB_USER;
        $this->pw = isset($params["password"]) ? $params["password"] : self::DB_PW;
        $this->db = isset($params["database"]) ? $params["database"] : self::DB_NAME;
        $this->port = isset($params["port"]) ? $params["port"] : self::DB_PORT;


        /*
         * Select DB from connection because we will use only 1 db
         */
        $this->con = mysqli_connect($this->host, $this->user, $this->pw, $this->db, $this->port) or die("Did I died?");
    }


    public function query($sql)
    {

        /*
         * Manage queries and log them
         */

        $log = new Logs();
        $log->setLogText($sql . " [STARTED]");
        $log->setLogName("database.txt");

        $log->saveLog();
        $result = mysqli_query($this->con, $sql);

        if (!$result) {

            $error = $this->mysqlError();

            $log->setLogText($sql . " : ". $error ." [ERROR]");
            $log->saveLog();

            die($error);
        }

        $log->setLogText($sql. " [DONE]");
        $log->saveLog();

        return $result;
    }

    public function single($sql){

        $result = $this->query($sql);

        if($row = mysqli_fetch_array($result)) {
            return $row;
        } else {
            return false;
        }
    }

    public function all($sql) {

        $result = $this->query($sql);
        $all = array();

        while($row = mysqli_fetch_array($result)) {
            $all[] = $row;
        }

        return $all;
    }

    public function getId(){
        return mysqli_insert_id($this->con);
    }

    public function affectedRows(){
        return mysqli_affected_rows($this->con);
    }


    private function mysqlError(){
        $this->errorMessage = mysqli_error($this->con);
        return $this->errorMessage;
    }



}