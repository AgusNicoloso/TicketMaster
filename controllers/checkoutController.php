<?php namespace controllers;
class CheckoutController {
    public function __construct() {
    }
    public function index() {
        require (ROOT . 'views/checkout.php');
    }
}
?>
