<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 4/10/2015
 * Time: 8:14 AM
 */

session_start();
require_once 'autoload.php';
$title = "Login Area";

if (!apc_exists('page')) {
    $page = new Page($title);
    apc_add('page', $page);
}
$page = apc_fetch('page');

$user = new User();

if ($user->isLogin()) {
    header('location: app.php');
};
?>

<?php require_once 'templates/header.php'; ?>
<div class='row'>
    <div class="sm-margin" style="margin-top: 20px"></div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Sharing Center
            </div>
            <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                  <li role="presentation" class="active"><a href="#" class="share-add" >add</a></li>
                  <li role="presentation"><a href="#" >Profile</a></li>
                  <li role="presentation"><a href="#">Messages</a></li>
                </ul>
            </div>


            </div>
            <div class="panel-footer">Panel footer</div>
        </div>

    <div class='col-md-8 sharer'>
                <h1>Share Any Tips Tricks </h1>
        <p>Add Any tips Tricks That you May Have Here.</p>
    </div>
</div>





<?php require_once 'templates/footer.php'; ?>