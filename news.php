<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 3/25/15
 * Time: 8:21 PM
 */
session_start();

require_once 'autoload.php';
$scrapper = new Scrapper();


//$url = $scrapper->SiteUrl("http://www.radiotelevisioncaraibes.com/");
print_r($scrapper->dom("http://www.radiotelevisioncaraibes.com/"));
