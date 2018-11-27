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

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }

    /**
     * @param string $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

}
