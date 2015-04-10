<?php
/**
 * Created by PhpStorm.
 * User: mardocheepierre
 * Date: 4/5/15
 * Time: 10:12 AM
 */

$title = "hello slick";
require_once 'autoload.php';
$page = new Page($title);
$user = new User();
require_once "templates/header.php" ; ?>

<div style="margin: 40px;"></div>
<div class="row">
    <div class="col-md-5">
        <div class="slide">
            <div class="item one"></div>
            <div class="item two"></div>
            <div class="item three"></div>
            <div class="item four"></div>
            <div class="item five"></div>
            <div class="item six"></div>
            <div class="item seven"></div>
            <div class="item eight"></div>
            <div class="item nine"></div>
            <div class="item ten"></div>

        </div>
    </div>
</div>


<?php require_once "templates/footer.php" ;?>