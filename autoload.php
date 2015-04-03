<?php
/**
 * Created by PhpStorm.
 * User: mardocheepierre
 * Date: 3/22/15
 * Time: 6:26 PM
 */
spl_autoload_register(function($class){

    $dir = __DIR__.DIRECTORY_SEPARATOR.'/Classes/';
    if(file_exists($dir.$class.".php")){
        require  $dir.$class.".php";
    }

});


   