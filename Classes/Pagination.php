<?php
/**
 * Created by PhpStorm.
 * User: jypierre
 * Date: 4/1/2015
 * Time: 10:57 AM
 */

require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Paginator');
class Pagination
{
    private $per_page;
    private $page;
    private $param;
    private $pages;

    function __construct($data)
    {
        $this->page = Zend_Paginator::factory($data);

        $this->param = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $this->page->setCurrentPageNumber($this->param);
        $this->pages = $this->page->count();

        $this->page->setItemCountPerPage(15);


    }

    function getPaginData()
    {

        return $this->page;
    }

    function paginate()
    {
        return $this->pages;
    }


    function link()   {


        for ($i = 1; $i <= $this->page->count(); $i++) {
            if ($i == $this->param) {
                echo " <li class='active'><a href=\"?page=$i\">" . $i . '</a></li>    ';
            } else {
                echo " <li><a href=\"?page=$i\">" . $i . '</a></li>    ';
            }
        }
    }

}

?>

