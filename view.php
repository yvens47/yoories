<?php
/**
 * Created by PhpStorm.
 * User: hjp
 * Date: 3/26/2015
 * Time: 10:08 AM
*/

$id = (string) $_GET['id'];
if(strlen($id)> 11  || strlen($id)< 11){
    echo  "<h1> Videos Does not exist</h1>";
}else{?>

    <?php

    session_start();
    require_once 'autoload.php';
    $title = "Haitian title";

  $location = "http://yoories.com".($_SERVER['REQUEST_URI']);


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
     if(!apc_fetch("youtube")->isVideoExists($id))
            header("location: home");

    ?>

    <?php require_once 'templates/header.php' ;?>
    <div class="row">
        <div style="margin-top: 20px"></div>

        <div class="col-md-8 views-main">
            <div class="embed-responsive embed-responsive-16by9">
                <?php apc_fetch('youtube')->vidInfo($id);?>
            </div>



<hr/>




            <div class="comments">
                <?php //apc_fetch('youtube')->commentsfeed($id);?>

                <div class="fb-comments" data-width="100%"
                     data-numposts="5" data-colorscheme="light" data-href="<?php echo $location ;?>"></div>

            </div>
        </div>
        <div class="col-md-4 views-left">
            <ul class="most-popular">
                <?php  apc_fetch('youtube')->mostPopularYoutube();?>
            </ul>
    <h2> Most Popular</h2>
            <div class=" recom">
                <img class="" src="http://upload.wikimedia.org/wikipedia/commons/5/53/Eiffel_tower_fireworks_on_July_14th_Bastille_Day.jpg"/>
                <p> a bunch of contents will be here here to describe this videos
                    <a href="" class="btn btn-warning">Vierw </a>
                </p>

            </div>



        </div>
    </div>




    <div class="row">


    </div>

    <?php require_once 'templates/footer.php' ;?>


<?php } ?>
