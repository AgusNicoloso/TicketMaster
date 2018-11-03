<?php namespace models;
class Compra {
    private $fecha;
    private $numero;
    function __construct($f, $n) {
        $this->fecha = $f;
        $this->numero = $n;
    }
    public function getFecha() {
        return $this->fecha;
    }
    public function getNumero() {
        return $this->numero;
    }
    public function setNumero($n) {
        $this->numero = $n;
    }
    public function setFecha($f) {
        $this->fecha = $f;
    }
}
?>
