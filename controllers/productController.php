<?php namespace controllers;
class productController {
    public function __construct() {
    }
    public function index() {
        require (ROOT . 'views/product.php');
    }
}
