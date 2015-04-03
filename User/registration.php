
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
    if(empty($email)){

        echo "enter email address";
    }elseif(!ereg('[a-z0-9]+@[a-z]+\.[a-z]+$',$string, $reds)){
            echo "invalid email address";
                exit;
    }
    elseif(empty($password)){
        echo "password cant be empty";
    }
    elseif(strlen($password) <8 ){
        echo "too short";
    }else{
        $user->register($email, $password);
    }


}else {

    // $user->doRegister($email, $password);
	header("location:/user/signup");
}
