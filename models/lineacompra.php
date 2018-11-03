<?php namespace models;
class LineaCompra {
    private $cantidad;
    private $precio;
    function __construct($c, $p) {
        $this->cantidad = $c;
        $this->precio = $p;
    }
    public function getCantidad() {
        return $this->cantidad;
    }
    public function getPrecio() {
        return $this->precio;
    }
    public function setCantidad($c) {
        $this->cantidad = $c;
    }
    public function setPrecio($p) {
        $this->precio = $p;
    }
}
?>
