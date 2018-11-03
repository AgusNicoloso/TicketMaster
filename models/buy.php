<?php namespace models;
class Buy {
    private $date;
    private $number;
    private $id;
    function __construct($d, $n) {
        $this->date = $d;
        $this->number = $n;
    }
    public function getDate() {
        return $this->date;
    }
    public function getNumero() {
        return $this->number;
    }
    public function setNumero($n) {
        $this->number = $n;
    }
    public function setDate($d) {
        $this->date = $d;
    }
    public function getId() {return $this->id;}
}
?>
