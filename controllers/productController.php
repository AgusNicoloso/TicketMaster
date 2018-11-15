<?php namespace controllers;
class productController {
    public function __construct() {
    }
    public function index() {
        $controllercategory = new \controllers\categoryController();
        $dbevents = new \controllers\EventController();
        $pageaux = 0;
        $page = 1;
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            if ($page == "1") {
                $pageaux = 0;
            } else {
                $pageaux = ($page * 9) - 9;
            }
        }
        if ($controllercategory->getAll()) { $list = $controllercategory->getAll();  }
         if ($dbevents->getLimitAll($pageaux)) {
                    $i=0;
                    $listevent = $dbevents->getLimitAll($pageaux);}
                    $total = $dbevents->getAll();
        require (ROOT . 'views/product.php');
    }
}
