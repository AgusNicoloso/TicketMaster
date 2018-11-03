<?php namespace models;
class TipoCategoria {
  private $name;
  private $photo;
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
}
?>
