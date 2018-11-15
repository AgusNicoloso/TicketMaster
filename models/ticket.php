<?php namespace models;
class Ticket {
    private $qr;
    private $id;
    function __construct($qr, $id = "") {
        $this->id = $id;
        $this->qr = $qr;
    }
    public function getQR() {
        return $this->qr;
    }
    public function getID() {
        return $this->id;
    }
}
?>
