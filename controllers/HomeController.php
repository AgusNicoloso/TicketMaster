<?php namespace controllers;
class HomeController {
    public function __construct() {
    }
    public function index() {
        $c_calendar=new CalendarController();
        require (ROOT . 'views/home.php');
    }
}
?>
