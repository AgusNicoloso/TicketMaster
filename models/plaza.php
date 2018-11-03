<?php namespace models;
class Plaza {
    private $availability;
    private $precio;
    private $limite;
    private $id;
    function __construct($d, $p, $l) {
        $this->precio = $p;
        $this->availability = $d;
        $this->limite = $l;
    }
    public function getAvailability() {
        return $this->availability;
    }
    public function getPrecio() {
        return $this->precio;
    }
    public function getLimite() {
        return $this->limite;
    }
    public function setAvailability($d) {
        $this->availability = $d;
    }
    public function setPrecio($p) {
        $this->precio = $p;
    }
    public function setLimite($l) {
        $this->limite = $l;
    }
    public function getId() {return $this->id;}
}
?>
