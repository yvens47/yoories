<?php

session_start();
 require_once 'autoload.php';
 $title = "Homepage title";

if(!apc_exists('page')){
    $page  = new Page($title);
    apc_add('page', $page);
}

if(!apc_exists('youtube')){
    $youtube = new GoogleApiYoutube();
    apc_add('youtube', $youtube);
}
$page = apc_fetch('page');
$user = new User();
$data = $data = apc_fetch('youtube')->showsAll() ;
$pagination = new Pagination($data);

?>

<?php require_once 'templates/header.php' ;?>

   <div class="row">
    <div class="col-lg-8">
        <div class="starter-template">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="pic.png" alt="...">
                        <div class="carousel-caption">
                            ...
                        </div>
                    </div>
                    <div class="item">
                        <img src="pic2.png" alt="...">
                        <div class="carousel-caption">
                            ...
                        </div>
                    </div>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>
    <div class="col-md-4 tpad">
        <div class="panel panel-primary" style="height:318px">
            <div class="panel-heading"> <h3 class="panel-title">Latest Movies</h3></div>
            <div class="panel-body">
                <ul class="latest">
                    <li>
                        <img src="http://static1.gamespot.com/uploads/original/1365/13658182/2559558-mortalkombatx_kotal_scorpion_snowforest_choke.jpg" alt="">
                        <p class="ltitle"> title for the  latest video in the database display here</p>
                    </li><li>
                        <img src="http://static1.gamespot.com/uploads/original/1365/13658182/2559558-mortalkombatx_kotal_scorpion_snowforest_choke.jpg" alt="">
                        <p class="ltitle"> title for the  latest video in the database display here</p>
                    </li><li>
                        <img src="http://static1.gamespot.com/uploads/original/1365/13658182/2559558-mortalkombatx_kotal_scorpion_snowforest_choke.jpg" alt="">
                        <p class="ltitle"> title for the  latest video in the database display here</p>
                    </li>

                </ul>
            </div>

        </div>

    </div>
       </div>
    <hr/>
    <div class="row">
        <div class='col-md-9'>

            <?php //$chunk =  array_chunk(apc_fetch('youtube')->showsAll(),5)?>

            <?php $data = apc_fetch('youtube')->showsAll() ;
                   $d= ($pagination->getPaginData());
                    foreach($d as $ds){

                       apc_fetch('youtube')->video($ds);
                       // echo "<br/>";
                    }


            ?>

        </div>
        <div class="col-md-3">

        </div>
        <div class="clearfix"></div>
        <hr/>

        <?php
                if($pagination->getPaginData()->getPages()){
                  //  print_r($pagination->getPaginData()->getPages());
                }

        ?>
        <ul class="pagination pagination-lg">
            <li>
                <a href="?page=<?php ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
             <?php   $pagination->link();     ?>
            <li> <a href="?page=<?php?>" aria-label="Next"><span aria-hidden="true">&raquo;</span>  </a>   </li>
            </ul>


    </div>





<?php require_once 'templates/footer.php' ;?>
