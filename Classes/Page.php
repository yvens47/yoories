<?php
/**
 * Created by PhpStorm.
 * User: mardocheepierre
 * Date: 3/22/15
 * Time: 6:22 PM
 */

class Page {
    private $title;
    function __construct($title){
        //$this->title = $title;
        if($title == null)
            $title = "yoories";
        $this->setTitle($title);
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

}