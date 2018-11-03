<?php namespace models;
class Cliente {
    private $nombre;
    private $dni;
    function __construct($n, $d) {
        $this->dni = $d;
        $this->nombre = $n;
    }
    public function getDni() {
        return $this->dni;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function setDni($d) {
        $this->dni = $d;
    }
    public function setNombre($n) {
        $this->nombre = $n;
    }
}
?>
