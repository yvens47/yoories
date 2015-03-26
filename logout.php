<?php
/**
 * Created by PhpStorm.
 * User: hjp
 * Date: 3/25/2015
 * Time: 11:13 PM
 */
session_start();


if(isset($_SESSION))
    unset($_SESSION);
session_destroy();
header("location: index.php?logout=1");