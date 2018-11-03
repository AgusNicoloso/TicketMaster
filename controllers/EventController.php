<?php
namespace controllers;
//use daos\daoList\EventDao as Dao;
use controllers\productdetailController as productdetailController;
use models\event as Event;
use models\Photo as Photo;
use daos\databases\eventDB as dao;
class EventController {
    protected $dao;
    private $obj;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        require (ROOT . 'views/event.php');
    }
    public function addEvent($nombre){
      $event = $this->dao->getEvent($nombre);
      $daocarrito = new \daos\daoList\daoCarrito();
      $daocarrito->add($event);
      header("Location: http://localhost/TicketMaster/product");
    }
    public function deleteEvent($i){
      $daocarrito = new \daos\daoList\daoCarrito();
      $daocarrito->delete($i);
      header("Location: http://localhost/TicketMaster/product");
    }
    public function see($id){
      $product=$this->dao->read($id);
      $this->viewProductDetail($product);
    }
    public function viewProductDetail($product) {
      include (ROOT . 'views/productdetail.php');
    }
    public function getEvent($id){
      return $this->dao->read($id);
    }
    public function insert(){
      print_r($_POST);
        try {
          $rutaFoto = new Photo();
          $rutaFoto->uploadPhoto($_FILES['fotoevento'], "photos");
          $us=new Event($_POST['nombreevento'],$rutaFoto->getDirection(),$_POST['categoria']);
          $this->dao->create($us);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
    public function getAll(){
      return $this->dao->readAll();
    }
    public function getLimitAll($page){
      return $this->dao->readLimitAll($page);
    }
    public function getLimit($page,$id){
      return $this->dao->readLimit($page,$id);
    }
    public function getAllbyID($id){
      return $this->dao->readAllbyID($id);
    }

}
