<?php
namespace controllers;
use daos\databases\Connection;
use models\EventPlace as EventPlace;
use daos\databases\eventplaceDB as dao;
use controllers\EventController as EventController;
use daos\daoList\DaoCarrito as DaoCarrito;
class EventPlaceController {
    protected $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        $c_seat = new SeatController();
        $listplace = $c_seat->allSeat();
        require ('views/eventplaceForm.php');
    }
    public function addEventPlace($quantity, $price, $idseat, $idcalendar) {
        $eplace = new EventPlace($quantity, $price);
        if ($this->dao->issetSeat()) {
            $eplace = new EventPlace($quantity, $price);
            $this->dao->create($eplace, $idseat, $idcalendar);
            $ePlaceArray = $this->dao->readAll();
        } else {
            $msg = "No hay Tipos de Plaza creados";
        }
    }
    public function getLastId() {
        $array = $this->dao->lastId();
        $arrayid = array_shift($array);
        return array_shift($arrayid);
    }
    public function home() {
        header("Location:" . URl);
    }
    public function readAll() {
        return $this->dao->readAll();
    }
    public function ver($id='', $id_tipo_plaza='', $num_product='', $fecha='') {
        if(empty($id) || empty($id_tipo_plaza) || empty($num_product) || empty($fecha)){
           $msg = "Complete todos los datos";
           $ec = new EventController();
           $ec->see1($id,$msg);
        }else{
            $carrito = new DaoCarrito();
        $ec = new EventController();
        $i = 0;
        while ($i < count($fecha)) {
            $place = $this->dao->read($id_tipo_plaza);
            $event = $ec->getEvent($id);
            $array = array('title_event' => $event->getName(), 'id_event' => $id, 'photo' => $event->getPhoto(), 'name_place' => $place->getSeatName(), 'price' => $place->getPrice(), 'quantity' => $num_product, 'total' => $place->getPrice() * $num_product, 'date' => $fecha[$i]);
            $carrito->add($array);
            $i++;
        }
        header("Location:" . URl . "product");
        }
    }
    public function capacityCounter($array) {
        $suma = 0;
        if (is_array($array)) {
            if (empty($array['0'])) {
                return '0';
            }
            foreach ($array as $key => $value) {
                $suma = $suma + $value;
            }
        } else {
            $suma = $array;
        }
        return $suma;
    }
}
