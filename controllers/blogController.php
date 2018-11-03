<?php namespace controllers;
class BlogController {
    public function __construct() {
    }
    public function index() {
        require (ROOT . 'views/blog.php');
    }
}
?>
