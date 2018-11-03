<?php namespace models;
class Ticket {
    private $number;
    private $qr;
    private $id;
    function __construct($n, $q) {
        $this->number = $n;
        $this->qr = $q;
    }
    public function getNumber() {
        return $this->number;
    }
    public function getQr() {
        return $this->qr;
    }
    public function setNumber($n) {
        $this->number = $n;
    }
    public function setQr($q) {
        $this->qr = $q;
    }
    public function getId() {return $this->id;}
}
?>
