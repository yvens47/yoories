<?php
/**
 * Created by PhpStorm.
 * User: mardocheepierre
 * Date: 3/22/15
 * Time: 7:56 PM
 */

class Form {

    private $email;


    function validateEmail($email){
        $this->email = $email;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){

        }
    }
    
    function passwordLen($password){
         return strlen($password) >8;
    }

}