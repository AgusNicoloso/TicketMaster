<?php namespace controllers;
class BlogdetailController {
    public function __construct() {
    }
    public function index() {
        require (ROOT . 'views/blogdetail.php');
    }
}
?>
