<?php namespace models;
class Evento {
    private $description;
    private $name;
    private $photo;
    private $id;
    function __construct($d, $n, $p, $id) {
        $this->description = $d;
        $this->name = $n;
        $this->photo = $p;
        $this->id = $id;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getName() {
        return $this->name;
    }
    public function getPhoto() {
        return $this->photo;
    }
    public function getID() {
        return $this->id;
    }
    public function setDescription($d) {
        $this->description = $d;
    }
    public function setName($n) {
        $this->name = $n;
    }
    public function setPhoto($p) {
        $this->photo = $p;
    }
}
?>
