<?php

session_start();
 require_once 'autoload.php';
 $title = "Login Area";

if(!apc_exists('page')){
    $page  = new Page($title);
    apc_add('page', $page);
}
$page = apc_fetch('page');

$user = new User();

if($user->isLogin()){ header('location: app.php');};
?>

<?php require_once 'templates/header.php' ;?>
<div class='row'>
    <div class='col-md-5 mid small-margin'>
        <form class="form-horizontal sregister" method='post' action='User/registration.php'>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" name='email' class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3"  class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name='password' class="form-control pass" id="inputPassword3" placeholder="Password">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default register " >Register</button>
    </div>
  </div>
</form>
    </div>
</div>



<?php require_once 'templates/footer.php' ;?>