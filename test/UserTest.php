<?php
/**
 * Created by PhpStorm.
 * User: mardocheepierre
 * Date: 3/23/15
 * Time: 6:30 PM
 */

require_once '../Classes/User.php';
class UserTest extends PHPUnit_Framework_TestCase {

    private $user;

    function __construct(){
        $this->user = new User();
    }

    function testRegister(){
        $this->assertEquals('Sorry email is already taken', $this->user->register("yvens47@yahoo.com","tij43gt"));
    }

}
