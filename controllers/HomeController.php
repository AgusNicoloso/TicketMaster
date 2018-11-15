<?php namespace controllers;
class HomeController {
    public function __construct() {
    }
    public function index() {
        $controllercategory = new \controllers\categoryController();
        $c_calendar = new CalendarController();

        if ($controllercategory->getAll()) { 
        	$list = $controllercategory->getAll();
        }


        require (ROOT . 'views/home.php');
    }
}
?>
