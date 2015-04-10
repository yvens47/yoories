<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 4/10/2015
 * Time: 10:46 AM
 */

require_once "PostImp.php";
require_once "Database.php";

/**
 * Class Post
 */
class Post implements PostImp  {
    private $title;
    private $body;
    private $type;
    private $postData;
    private $db ;
    private static $instance;

    private  function __construct($type, $title, $body){
        $this->title = $title;
        $this->body = $body;
        $this->type = $type;
        $this->db  = new Database("Yoories");
    }

    static function make($type, $title, $body){
        if(self::$instance == null)
            self::$instance = new Post($type, $title, $body);

        return  self::$instance;

    }

    function postData(){
         return array('title'=>$this->title, 'type'=>$this->type, 'body'=>$this->body,"date"=>date("Y-m-d H:i:s"));
    }

    function readAll(){

        $sql = "select * from posts";
        $this->db->connect();
        $query = $this->db->query($sql);
        while($row = mysqli_fetch_assoc($query)){
            $rows[] = $row;
        }
        print_r($rows);
    }

    function edit($id){
        
    }



    function insert(){

        $post = $this->postData();
        $title = $post['title'];
        $type = $post['type'];
        $body =$post['body'];
        $date = $post['date'];

         $con = $this->db->connect();
        $sql = "select title from posts WHERE  title='$this->title'";
        $q = mysqli_query($con, $sql);
        if(mysqli_num_rows($q) >=1){
            echo "pick another title";
            exit;
        }else{
            $sql  = "insert into posts VALUES (null ,'$title', '$body', '$date','$type')";
            $q = $this->db->query($sql);
            print_r($q);
            $this->db->close();
        }







    }





}


