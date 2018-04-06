<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/4/2018
 * Time: 19:19
 */

abstract class Model
{
    /*
     * Name of table and db
     */
    protected $primaryKey;
    protected $table;
    protected $db;

    /*
     * List of fields
     */
    protected $fields = [];

    private $values;
    private $keys;
    private $sql;
    private $where = 0;

    public function __construct()
    {
        $this->db = new Database();

        /**
         * TODO: add maybe something to get basic info? like by id
         */
    }


    public function get()
    {
        $this->sql = "SELECT * FROM {$this->table}";
        $result = $this->db->all($this->sql);

        if($result) {
            return $result;
        }

        return false;
    }

    public function where($w = []){

        $this->sql = "SELECT * FROM {$this->table}";

        foreach ($w as $k => $v) {
            $this->where = "`$k`=$v";
        }

        $this->sql.=" WHERE {$this->where} Order by {$this->primaryKey} DESC";
        $result = $this->db->all($this->sql);

        if($result) {
            return $result;
        }

        return false;
    }

    public function one($w = []){

        $this->sql = "SELECT * FROM {$this->table}";

        foreach ($w as $k => $v) {
            $this->where = "`$k`=$v";
        }

        $this->sql.=" WHERE {$this->where} Order by {$this->primaryKey} DESC";
        $result = $this->db->single($this->sql);

        if($result) {
            return $result;
        }
        return false;
    }

    /**
     * insert new values
     */

    public function insert($params){

        $this->prepareParams($params);
        $this->sql = "INSERT INTO {$this->table} ({$this->keys}) VALUES ({$this->values})";

        $result = $this->db->query($this->sql);

        if($result){
            $id = $this->db->getId();
            $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = {$id}";

            return $this->db->single($sql);
        } else {
            return false;
        }
        
        
    }

    public function update($params, $where){

        $this->prepareUpdate($params, $where);
        $this->sql = "UPDATE {$this->table} SET {$this->values} WHERE {$this->where}";

        $result = $this->db->query($this->sql);

        if($result) {
            $rows = $this->db->affectedRows();
            if($rows){
                return $rows;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    private function prepareParams($p){
        foreach ($p as $k => $v) {
            if(in_array($k, $this->fields)) {
                $this->keys.="`".$k."`" . ',';
                $this->values.= "'".$v."'" . ',';
            }
        }

        $this->keys = rtrim($this->keys,',');
        $this->values = rtrim($this->values,',');
    }

    private function prepareUpdate($p, $w) {
        foreach ($p as $k => $v) {
            $this->values .= "`$k`='$v'".",";
        }

        foreach ($w as $k => $v) {
            $this->where = "`$k`=$v";
        }

        $this->values = rtrim($this->values, ',');
    }

    private function prepareKeys(){

    }


}