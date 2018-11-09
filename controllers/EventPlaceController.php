<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 25/10/2018
 * Time: 10:03
 */

namespace controllers;
use daos\databases\Connection;
use models\EventPlace as EventPlace;
//use daos\daoList\eventplace as Dao;
use daos\databases\eventplaceDB as dao;
use controllers\EventController as EventController;
use daos\daoList\DaoCarrito as DaoCarrito;
class EventPlaceController
{
    protected $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        require ('views/eventplaceForm.php');
    }

    public function addEventPlace($quantity,$price,$idseat,$idcalendar)
    {
         $eplace=new EventPlace($quantity,$price);
        if($this->dao->issetSeat()){
            $eplace=new EventPlace($quantity,$price);
            $this->dao->create($eplace,$idseat,$idcalendar);
            $ePlaceArray=$this->dao->readAll();
        }else{
            $msg="No hay Tipos de Plaza creados";
        }
        header("Location:".URl);
    }
    public function getLastId()
    {
        $array=$this->dao->lastId();
        $arrayid=array_shift($array);
        return array_shift($arrayid);
    }
    public function home()
    {
        header("Location:".URl);
    }
    public function readAll(){
      return $this->dao->readAll();
    }
    public function ver($id,$id_tipo_plaza, $num_product){
      $place = $this->dao->read($id_tipo_plaza);
      $ec = new EventController();
      $event = $ec->getEvent($id);
      $array = array('title_event' => $event->getName(), 'id_event' =>$id, 'photo' => $event->getPhoto(), 'name_place' => $place->getSeatName(), 'price' => $place->getPrice(), 'quantity' => $num_product, 'total' => $place->getPrice()*$num_product);
      $carrito= new DaoCarrito();
      $carrito->add($array);
      header("Location:".URl);
    }
}
