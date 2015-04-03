<?php
/**
 * Created by PhpStorm.
 * User: mardocheepierre
 * Date: 3/22/15
 * Time: 7:54 PM
 */


require_once 'Database.php';

class User {

    private $username;
    private $email;
    private $password;
    private $form;
    private $db;
    function __construct()

    {

        $this->db = new Database('Yoories');
    }


    function login($email, $password){
         // $email =$this->safe($email);


        //var_dump($this->db->connect());
             // login user in
            mysqli_real_escape_string($this->db, $email);
            mysqli_real_escape_string($this->db, $password);
             $sql = "Select password,email from login where email ='$email' and password='$password'";
             $q = $this->db->query($sql);
             if(mysqli_num_rows($q) ==0){
                  echo "You need to register";
                 //$worngCred = "Sorry you have not signed up yet"

                 //header("location: /user/signup?wrong='".$worngCred"');

             }
             else{
                 // save user credentials to session
                   $userdata = ( mysqli_fetch_assoc($q));
                   $_SESSION['userdata'] = $userdata['email'];
                   $sessionid = 1;

                   $location = $_SERVER['HTTP_REFERER'];
                    header("location: $location");
             }


        


       
    }

    function safe($string){

        return mysqli_real_escape_string($this->db->connect(), $string);

    }

    /*
     * to recover or change password
     */
    function recorvery($email){



    }

    function isLogin(){
        $login = false;
         if(isset($_SESSION['userdata'])){
             $login = true;
         }

        return $login;
    }

    function Session(){

    }



    function register($email, $password){

        $sql ="select email from login where email ='$email'";
        $query = $this->db->query($sql);

        if(mysqli_num_rows($query) == 1){
            echo "Sorry email is already taken";
        }

        else{
            $date = date('Y-m-d');
            $last = date('Y-m-d h:i:s');
            $sql = "INSERT INTO `Yoories`.`login` (`userid`, `email`, `password`, `registerDate`, `lastlogin`, `sess`)
                    VALUES (NULL, '$email', '$password', '$date', '$last', '')";

            $query = $this->db->query($sql);


            if($query){

                        header("location :  login.php");

            }
        }

    }






}

