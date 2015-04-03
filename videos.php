<?php

session_start();
require_once 'autoload.php';
$title = "watch Haitian Movies";

if(!apc_exists('page')){
    $page  = new Page($title);
    apc_add('page', $page);
}

if(!apc_exists('youtube')){
    $youtube = new GoogleApiYoutube();
    apc_add('youtube', $youtube,10);
}
$page = apc_fetch('page');
$page->setTitle($title);
$user = new User();

?>

<?php require_once 'templates/header.php' ;?>
<div class="row">
    <div class="col-md-8">
        <div class="top-filter">

        </div>

        <div class="videos">

        </div>
    </div>
</div>

<?php require_once 'templates/footer.php' ;?>