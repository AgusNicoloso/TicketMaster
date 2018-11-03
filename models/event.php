<?php namespace models;
class Event {
    private $name;
    private $photo;
    private $id;
    private $category;
    function __construct($n, $p, $category="",$id="") {
        $this->name = $n;
        $this->photo = $p;
        $this->id = $id;
        $this->category = $category;
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
    public function getCategory(){
      return $this->category;
    }
    public function getNameCategory() {
        return $this->category->getCategoryName();
    }
    public function getIDCategory(){
      return $this->category->getID();
    }
    public function setName($n) {
        $this->name = $n;
    }
    public function setPhoto($p) {
        $this->photo = $p;
    }
}
?>
