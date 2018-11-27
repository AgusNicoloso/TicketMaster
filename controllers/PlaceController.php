<?php
namespace controllers;
use daos\databases\Connection;
use models\Place as Place;
use daos\databases\placeDB as dao;
//use daos\daoList\placeList as dao;
class PlaceController {
    protected $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        require ('views/placeForm.php');
    }
  
     public function addPlace($place_name,$capacity) {
        if ($this->dao->read($place_name)) {
            $msg = "El lugar ya existe.";
            require ("views/placeForm.php");
        } else {
            $place = new Place('', $place_name, $capacity);
            $this->dao->create($place);
            header("Location:" . URl);
        }
    }
    public function allPlace() {
        return $PlaceArray = $this->dao->readAll();
    }
    public function home() {
        header("Location:" . URl);
    }
    public function placebyid($id) {
        return $this->dao->readId($id);
    }
}
