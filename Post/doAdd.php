<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 4/10/2015
 * Time: 10:46 AM
 */
require_once "autoload.php";

var_dump($_FILES);

$accepted = array("jpeg","jpg");
$name = $_FILES['image']['name'];
$type =     $_FILES['image']['type'];
$temp = $_FILES['image']['tmp_name'];
$type = explode("/" ,$type);

echo $name;
$dir = $_SERVER['DOCUMENT_ROOT']."/Upload";
if(in_array($type[1],$accepted)){
    // save Image
    if(file_exists("Upload/".$name)){
            echo "yes";
    }
    else{
        echo " we write the name of the file";
        move_uploaded_file($temp, $dir.'/'.$name);
    }

}else{

}
if(isset($_POST)){
    var_dump($_POST);
    $title = $_POST['title'];
    $type = $_POST['type'];
    $body = $_POST['body'];

    $p = Post::make($type,$title,$body);
   // $p->insert();
}

