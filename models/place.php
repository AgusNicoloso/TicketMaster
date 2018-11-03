<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 23/10/2018
 * Time: 10:54
 */

namespace models;


class Place
{
    private $id;
    private $place;
    private $capacity;

    /**
     * Place constructor.
     * @param $id
     * @param $place
     * @param $capacity
     */
    public function __construct($id='',$place='', $capacity='')
    {
        $this->id=$id;
        $this->place = $place;
        $this->capacity = $capacity;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @return string
     */
    public function getCapacity()
    {
        return $this->capacity;
    }




}
