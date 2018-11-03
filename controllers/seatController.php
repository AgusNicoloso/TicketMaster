<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 23/10/2018
 * Time: 14:16
 */

namespace controllers;
use daos\databases\Connection;
use models\seat as Seat;
//use daos\daoList\seatDB as Dao;
use daos\databases\seatDB as dao;

class SeatController
{
    protected $dao;

    public function __construct()
    {
        $this->dao = dao::getInstance();
    }

    public function index()
    {
        require('views/seatForm.php');
    }

    public function addSeat($seatName)
    {
        if ($this->dao->read($seatName)) {
            $msg = "El lugar ya existe.";
            require("views/seatForm.php");
        } else {
            $seat = new Seat($seatName);
            $this->dao->create($seat);
        }
    }
    public function allSeat()
    {
        return $SeatArray = $this->dao->readAll();
    }
    public function home()
    {
        header("Location:" . URl);
    }
}
