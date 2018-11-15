<?php
namespace models;
class Seat {
    private $id;
    private $descript;
    public function __construct($descript = '', $id = '') {
        $this->descript = $descript;
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
    public function getDescript() {
        return $this->descript;
    }
}
