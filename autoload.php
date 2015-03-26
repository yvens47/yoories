<?php
/**
 * Created by PhpStorm.
 * User: mardocheepierre
 * Date: 3/22/15
 * Time: 6:26 PM
 */

function __autoload($class){

        if(file_exists("Classes/".$class.".php")){
            require_once "Classes/".$class.".php";
        }



}