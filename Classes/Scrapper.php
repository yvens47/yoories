<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 3/25/15
 * Time: 8:23 PM
 */

class Scrapper {

    private  $url;


    function __construct(){

    }

    function SiteUrl($url){
        $files = file_get_contents($url);
        $data = preg_match('/<title>.*<\/title>/i',$files,$arr);
        print_r($arr);

        $links  = preg_match_all('/<a href="(.*)" \/>/i', $files, $link);

        print_r($link);


    }

}

