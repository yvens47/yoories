<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 3/25/15
 * Time: 8:21 PM
 */


function url($url){
    $u = file_get_contents($url);

    return $u;

}



/**
 * @param $url
 */
function DomPath($url)
{
    $html = new DOMDocument();
    @$html->loadHTML($url);
    $domXpath = new DOMXPath($html);
    print_r($domXpath);

    return $domXpath;
}


$url = url("http://www.wow509.com/");
$dom = DomPath($url);
$q =$dom->query('title');
print_r($q);

