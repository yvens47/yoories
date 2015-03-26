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

    function set($url){
        $this->url = $url;
    }

    function getUrl(){
        return $this->url;
    }


    function Url($url){
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl,CURLOPT_URL, $url);

        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
 function dom($url){
     $dom =new DOMDocument();
     @$dom->load($url);
     $xpath = new DOMXPath($dom);
     return $xpath;

 }
    function SiteUrl($url){
        $files = file_get_contents($url);
        $data = preg_match('/<title>(.*)<\/title>/i',$files,$arr);
        print_r($arr);

        $links  = preg_match_all('/<a href="(.*)" \/>/i', $files, $link);

        print_r($link);


    }

}