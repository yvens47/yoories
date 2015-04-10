<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 4/10/2015
 * Time: 11:12 AM
 */

 class AbstractPost {
    private $title;
    private $body;
    private $type;
    private $postData;

    private  function __construct($type, $title, $body){
        $this->title = $title;
        $this->body = $body;
        $this->type = $type;
    }
}