
<?php
session_start();
require "../Classes/User.php";
 //if(!apc_exists('user')){
    $user  = new User();
  //  apc_add('user', $user);
//}
//$user = apc_fetch('user');

  $flsh = array('short'=> "password is to short", 'empty'=> "Please enter a password", 'email'=> "please enter a email adress");

    
   if(empty($_POST['email'])) {
       echo $flsh['email'];

   }elseif(empty($_POST['password'])){
       echo $flsh['empty'];

   }elseif(strlen($_POST['password'])<8){
       echo $flsh['short'];
   }
else{
     $email = $_POST['email'];
     $password = strtolower($_POST['password']);
     $user->login($email, $password);

}
