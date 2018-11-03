<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 25/10/2018
 * Time: 10:05
 */

namespace models;


class EventPlace
{
    private $id;
    private $quantity;
    private $available;
    private $price;
    private $seat;


    /**
     * EventPlace constructor.
     * @param $id
     * @param $quantity
     * @param $available
     * @param $price
     */
    public function __construct($quantity, $price,$seatObject='',$available='',$id='')
    {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->available = $available;
        $this->price = $price;
        $this->seat=$seatObject;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }
    public function getSeatId()
    {
       return $this->seat->getId();
    }
    public function getSeatName(){
      return $this->seat->getDescript();
    }

}
