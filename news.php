<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 3/25/15
 * Time: 8:21 PM
 */
session_start();

require_once 'autoload.php';
$fomt = new Form();

$n = new GoogleApiYoutube();

//$n->video("GibJrsSj-0M");

$d = $n->playlist("PLXnl5zCv8dG8k67afx_pv0cjhyjTQ4dz7");

foreach($d as $list){
    $id = (($list['snippet']['resourceId']['videoId']));
    $n->save($id);
}

$n->showsAll();