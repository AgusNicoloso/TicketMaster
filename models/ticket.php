<?php namespace models;
class Ticket {
    private $qr;
    private $id;
    private $number;
    function __construct($number,$qr, $id = "") {
        $this->id = $id;
        $this->qr = $qr;
        $this->number = $number;
    }
    public function getQR() {
        return $this->qr;
    }
    public function getID() {
        return $this->id;
    }
    public function getNumber() {
        return $this->number;
    }
}
?>
