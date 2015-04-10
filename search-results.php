<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 4/7/15
 * Time: 8:00 PM
 */



if(isset($_GET['q'])){
    if(!empty($_GET['q'])){

    }else{
        echo "Please Enter A search Term";
    }
}

else{
     $location = $_SERVER['HTTP_REFERER'];
    header("location: $location");
}