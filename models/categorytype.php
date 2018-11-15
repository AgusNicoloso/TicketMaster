<?php namespace models;
class CategoryType {
    private $name;
    private $photo;
    private $id;
    function __construct($n, $p) {
        $this->name = $n;
        $this->photo = $p;
    }
    public function getName() {
        return $this->name;
    }
    public function getPhoto() {
        return $this->photo;
    }
    public function setName($n) {
        $this->name = $n;
    }
    public function setPhoto($p) {
        $this->photo = $p;
    }
    public function getId() {
        return $this->id;
    }
}
?>
