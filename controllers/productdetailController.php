<?php namespace controllers;
class ProductdetailController {
    private $obj;
    public function __construct() {
    }
    public function index($product) {
    	if (isset($_SESSION['logued'])) {
    		$logued = $_SESSION['logued'];
    		$cc = new calendarController();
    		$info= $cc->infoEvent($product->getID());
    	}
      require (ROOT . 'views/productdetail.php');
    }
}
?>
