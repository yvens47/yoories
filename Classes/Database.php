<?php
/**
 * Created by PhpStorm.
 * User: mardocheepierre
 * Date: 3/23/15
 * Time: 5:34 PM
 */

class Database {

    private $host;
    private $user;
    protected $password;
    private $db ;

    private static $instance;

   function __construct($db){

        $this->host ='localhost';
        $this->user ='root';
        $this->password = "yvenstij43gt";
        $this->db = $db;

    }

    function connect(){

        $link = mysqli_connect($this->host, $this->user, $this->password, $this->db);

        if(mysqli_errno($link))
            die(" could not connect to database ".mysqli_errno($link));



        return $link;
    }


    function query($sql){

        return mysqli_query($this->connect(), $sql);
    }

    /*public  function getInstace(){

        if(!isset(self::$instance)){
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;

    }*/


    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

}