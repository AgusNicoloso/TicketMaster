<?php namespace models;
class Client {
    private $name;
    private $dni;
    private $id;
    function __construct($n, $d) {
        $this->dni = $d;
        $this->name = $n;
    }
    public function getDni() {
        return $this->dni;
    }
    public function getName() {
        return $this->name;
    }
    public function setDni($d) {
        $this->dni = $d;
    }
    public function setName($n) {
        $this->name = $n;
    }
    public function getId() {return $this->id;}
}
?>
