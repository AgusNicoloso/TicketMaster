<?php
namespace models;
class Place {
    private $id;
    private $place;
    private $capacity;
    public function __construct($id = '', $place = '', $capacity = '') {
        $this->id = $id;
        $this->place = $place;
        $this->capacity = $capacity;
    }
    public function getId() {
        return $this->id;
    }
    public function getPlace() {
        return $this->place;
    }
    public function getCapacity() {
        return $this->capacity;
    }
}
