<?php
namespace models;
class EventPlace {
    private $id;
    private $quantity;
    private $available;
    private $price;
    private $seat;
    public function __construct($quantity, $price, $seatObject = '', $available = '', $id = '') {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->available = $available;
        $this->price = $price;
        $this->seat = $seatObject;
    }
    public function getID() {
        return $this->id;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function getAvailable() {
        return $this->available;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getSeatId() {
        return $this->seat->getId();
    }
    public function getSeatName() {
        return $this->seat->getDescript();
    }
}
