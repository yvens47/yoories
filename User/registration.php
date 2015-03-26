
<?php
session_start();
require "../Classes/User.php";
//if(!apc_exists('user')){
$user  = new User();
//  apc_add('user', $user);
//}
//$user = apc_fetch('user');

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $email = $_POST['email'];
    $password = $_POST['password'];

    $user->register($email, $password);
}else {

    // $user->doRegister($email, $password);
}