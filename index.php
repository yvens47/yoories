<?php

session_start();
 require_once 'autoload.php';
 $title = "Homepage title";

if(!apc_exists('page')){
    $page  = new Page($title);
    apc_add('page', $page);
}
$page = apc_fetch('page');
$user = new User();

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
                        <img src="http://static1.gamespot.com/uploads/original/1365/13658182/2559558-mortalkombatx_kotal_scorpion_snowforest_choke.jpg" alt="...">
                        <div class="carousel-caption">
                            ...
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://media1.gameinformer.com/imagefeed/screenshots/MortalKombatX/MKX_GamescomScreenshot_KanoScorpion.jpg" alt="...">
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
        <div class="panel panel-primary" style="height:422px">
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
                    </li><li>
                        <img src="http://static1.gamespot.com/uploads/original/1365/13658182/2559558-mortalkombatx_kotal_scorpion_snowforest_choke.jpg" alt="">
                        <p class="ltitle"> title for the  latest video in the database display here</p>
                    </li>

                </ul>
            </div>

        </div>
        <hr/>
        <div class="row">

        </div>




    </div>
       </div>



<?php require_once 'templates/footer.php' ;?>