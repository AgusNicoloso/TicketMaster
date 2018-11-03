<?php namespace controllers;
class cartController {
    public function __construct() {
    }
    public function index() {
        require (ROOT . 'views/cart.php');
    }
}
