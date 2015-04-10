<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 4/10/2015
 * Time: 10:46 AM
 */
require_once "autoload.php";

if(isset($_POST)){
    var_dump($_POST);
    $title = $_POST['title'];
    $type = $_POST['type'];
    $body = $_POST['body'];

    $p = Post::make($type,$title,$body);
    $p->insert();
}

