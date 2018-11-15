<?php namespace models;
class BuyLine {
    private $quantity;
    private $price;
    private $id;
    function __construct($c, $p) {
        $this->quantity = $c;
        $this->price = $p;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function getPrice() {
        return $this->price;
    }
    public function setQuantity($c) {
        $this->quantity = $c;
    }
    public function setPrice($p) {
        $this->price = $p;
    }
    public function getId() {
        return $this->id;
    }
}
?>
