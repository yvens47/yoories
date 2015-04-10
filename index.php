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


?>

<?php require_once 'templates/header2.php' ;?>

<div class="large-head">
    <div class="container">
    <div class="post-wrap">
        <div class="titlePost">
                <h1>Yoories</h1>
            <h2>The Haitian Most Popular Media Center</h2>
             <p>
                We Currently Have 65 haitian Movies <i class="glyphicon glyphicon-earphone"></i>
             </p>
        </div>
        <div class="form-post-wrap">
            <form class="form-inline" method="get" action="search">

                <div class="form-group search-wrap">
                    <label for="exampleInputEmail2">Email</label>
                    <input type="search" class="form-control" name="q" id="exampleInputEmail2" placeholder="enter search Query">
                </div>

            </form>

        </div>
    </div>
    </div>


</div>
    <div class="container">

        <div class="row">
            <ul class="addons">
                <li class="">

                        <h2><i class="glyphicon glyphicon-play"></i> </h2>
                   <p class="play"></p>
                        <p>Watch as much Haitian movies as you can, free of chargemauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                        <p><a class="btn btn-default" href="#" role="button">Watch  »</a></p>

                </li>

                <li>

                    <h2><i class="glyphicon glyphicon-open"></i> </h2>
                    <p class="add"></p>
                    <p> Sometimes it could be a pain to upload some file to the internet
                         but in this site We make it very easy to upload  your movies on the site... </p>
                    <p><a class="btn btn-default" href="#" role="button">Let's Upload»</a></p>

                </li>


                <li>

                    <h2><i class="glyphicon glyphicon-pushpin"></i> </h2>
                    <p class="up"></p>
                    <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                    <p><a class="btn btn-default" href="#" role="button">List »</a></p>

                </li>
            </ul>

        </div>
        <hr/>

<div class="row">

    <div class="col-md-8">
        <h2 class="p-title">Latest Post </h2>
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object" src="pic.png" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Videos One</h4>
                ...Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged



            </div>
        </div>


        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object" src="pic.png" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Videos One</h4>
                ...Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged



            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Cras justo odio
            </a>
            <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item">Morbi leo risus</a>
            <a href="#" class="list-group-item">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item">Vestibulum at eros</a>
        </div>

        <div class="subs">

        </div>
        <div class="ltweets">

        </div>
        <div class="ads"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2 class="center-title">Most popular</h2>
        </div>
    </div>

</div>


<?php require_once 'templates/footer.php' ;?>