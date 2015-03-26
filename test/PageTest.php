<?php
/**
 * Created by PhpStorm.
 * User: mardocheepierre
 * Date: 3/22/15
 * Time: 6:52 PM
 */

require_once '../Classes/Page.php';
class PageTest extends PHPUnit_Framework_TestCase {

    private $page;

    function __construct(){
        $this->page = new Page("hello");
    }

    function testGetTitle(){
        $this->assertEquals("hello",$this->page->getTitle());

    }


}
