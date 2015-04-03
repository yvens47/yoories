<?php

session_start();
require_once 'autoload.php';
$title = "Homepage title";


    $page  = new Page($title);


    $youtube = new GoogleApiYoutube();



$user = new User();


?>

<?php require_once 'templates/header.php' ;?>

<div class="large-head">
    <div class="post-wrap">
        <div class="titlePost">
                <h1>Yoories Media Center</h1>
             <p>
                We Currentlyevev skjdbsdHave 65 haitian Mobjhhvvies <i class="glyphicon glyphicon-earphone"></i>
             </p>
        </div>
        <div class="form-post-wrap">
            <form class="form-inline">

                <div class="form-group">
                    <label for="exampleInputEmail2">Email</label>
                    <input type="search" class="form-control" name="q" id="exampleInputEmail2" placeholder="enter search Query">
                </div>
                <button type="submit" class="btn btn-primary">Send invitation</button>
            </form>

        </div>
    </div>


</div>
<hr/>
<div class="row">

    <div class="col-md-8">
        <h2>Latest Post </h2>
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object" src="pic.png" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Media heading</h4>
                ...Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchangedeefeeew



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
    </div>
</div>


<?php require_once 'templates/footer.php' ;?>