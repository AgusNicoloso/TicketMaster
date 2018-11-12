<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 23/10/2018
 * Time: 10:42
 */

namespace controllers;
use daos\databases\Connection;
use models\Place as Place;
//use daos\daoList\userDB as Dao;
use daos\databases\placeDB as dao;

class PlaceController
{
    protected $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        require ('views/placeForm.php');
    }

    public function addPlace()
    {
        if($this->dao->read($_POST['place_name'])) {
            $msg="El lugar ya existe.";
            require ("views/placeForm.php");
        }
        else{
            $place=new Place('',$_POST['place_name'],$_POST['capacity']);
            $this->dao->create($place);
            header("Location:".URl);
        }
    }
    public function allPlace()
    {
           return $PlaceArray=$this->dao->readAll();
    }

    public function home()
    {
        header("Location:".URl);
    }
    public function placebyid($id){
       return $this->dao->readId($id);
    }

}
