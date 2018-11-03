<?php namespace controllers;
class ProductdetailController {
	private $obj;
    public function __construct() {
    }
    public function index() {
        require (ROOT . 'views/productdetail.php');
    }
}
?>
