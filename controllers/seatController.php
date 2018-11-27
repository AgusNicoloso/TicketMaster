<?php
namespace controllers;
use daos\databases\Connection;
use models\seat as Seat;
use daos\databases\seatDB as dao;
//use daos\daolist\seatList as dao;
class SeatController {
    protected $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        require ('views/seatForm.php');
    }
    public function addSeat($seatName) {
        if ($this->dao->read($seatName)) {
            $msg = "El lugar ya existe.";
            require ("views/seatForm.php");
        } else {
            $seat = new Seat($seatName);
            $this->dao->create($seat);
            print_r($_SESSION['seats']);
        }
    }
    public function allSeat() {
        return $SeatArray = $this->dao->readAll();
    }
    public function home() {
        header("Location:" . URl);
    }
    public function seatbyid($id) {
        return $this->dao->seatbyid($id);
    }
    public function arrayseat($array) {
        $arreglo = array();
        if (is_array($array)) {
            if (count($array) > 1) {
                foreach ($array as $key => $value) {
                    $seat = $this->seatbyid($value);
                    array_push($arreglo, $seat);
                }
            } else {
                $arreglo = $array[0];
                $seat = $this->seatbyid($arreglo);
                $arreglo = $seat;
            }
        }
        return $arreglo;
    }
}
