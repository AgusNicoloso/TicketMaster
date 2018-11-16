<?php namespace controllers;
class cartController {
    public function __construct() {
    }
    public function index() {
    	if (isset($_SESSION['CarritoList'])) {
    		$carrito = $_SESSION['CarritoList'];
    		$i=1;
    		$total=0;
    	}
        require (ROOT . 'views/cart.php');
    }
}
