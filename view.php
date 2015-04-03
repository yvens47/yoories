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
        <div style="margin-top: 20px"></div>

        <div class="col-md-8">
            <div class="embed-responsive embed-responsive-16by9">
                <?php apc_fetch('youtube')->vidInfo($id);?>
            </div>

            <div class="share-tab">
                <i class="glyphicon glyphicon-plus-sign"></i>
                <p>6 comments</p>
            </div>
        </div>
        <div class="col-md-4">
            <ul class="most-popular">
                <?php  apc_fetch('youtube')->mostPopularYoutube();?>
            </ul>



        </div>
    </div>
    <hr/>
    <div class="row">
        <h3 class="lrecom">Similar Movies <i class="glyphicon glyphicon-arrow-right"></i> </h3>
        <div class="col-md-4 pull-left recom">
            <img class="" src="http://upload.wikimedia.org/wikipedia/commons/5/53/Eiffel_tower_fireworks_on_July_14th_Bastille_Day.jpg"/>
            <p> a bunch of contents will be here here to describe this videos
            <a href="" class="btn btn-warning">Vierw </a>
            </p>

        </div>
        <div class="col-md-8 pull-left ">
            <div class="lthumbs">
                <img class="" src="http://upload.wikimedia.org/wikipedia/commons/5/53/Eiffel_tower_fireworks_on_July_14th_Bastille_Day.jpg"/>
               <!-- <p> a bunch of contents will be here here to describe this videos
                    <a href="" class="btn btn-warning">Vierw </a>
                </p>-->
            </div>

            <div class="lthumbs">
                <img class="" src="http://upload.wikimedia.org/wikipedia/commons/5/53/Eiffel_tower_fireworks_on_July_14th_Bastille_Day.jpg"/>
                <!-- <p> a bunch of contents will be here here to describe this videos
                     <a href="" class="btn btn-warning">Vierw </a>
                 </p>-->
            </div>


            <div class="lthumbs">
                <img class="" src="http://upload.wikimedia.org/wikipedia/commons/5/53/Eiffel_tower_fireworks_on_July_14th_Bastille_Day.jpg"/>
                <!-- <p> a bunch of contents will be here here to describe this videos
                     <a href="" class="btn btn-warning">Vierw </a>
                 </p>-->
            </div>


            <div class="lthumbs">
                <img class="" src="http://upload.wikimedia.org/wikipedia/commons/5/53/Eiffel_tower_fireworks_on_July_14th_Bastille_Day.jpg"/>
                <!-- <p> a bunch of contents will be here here to describe this videos
                     <a href="" class="btn btn-warning">Vierw </a>
                 </p>-->
            </div>


        </div>


    </div>
    <div class="row">
        <hr/>
        <h3>Comments</h3>
        <div class="col-md-7">
            <div class="comments">
                <?php apc_fetch('youtube')->commentsfeed($id);?>

            </div>
        </div>

    </div>

    <?php require_once 'templates/footer.php' ;?>


<?php } ?>
