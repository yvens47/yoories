<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 4/1/2015
 * Time: 8:44 AM
 */

class DB {

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

    function connection(){
        $link = new mysqli($this->host, $this->user,$this->password, $this->db);

        return $link;
    }

    function prep($email){
        $db = $this->connection();
        $stmt = $db->prepare("select * from login where 'email'=? ");
        $stmt->bind_param('s', $email);

        //$stmt->bind_result($userid,$email,$password,$registerDate,$lastlogin,$sess);
        $stmt->execute();

       // print_r($stmt);
            print_r($stmt->fetch());
    }

}


$Db = new DB("Yoories");

print_r($Db);

$Db->prep("yvens47@gmail.com");