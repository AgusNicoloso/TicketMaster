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
    public $msg;
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
    public function indexEditEvent($product) {
        require (ROOT . 'views/editevent.php');
    }
    public function deleteEvent($i){
      $this->dao->delete($i);
      header("Location: http://localhost/TicketMaster/product");
    }
    public function editEvent($id){
      $product=$this->dao->read($id);
      $this->indexEditEvent($product);
    }
    public function edit($id){
        $id=$_POST['eventid'];
        $product=$this->dao->read($id);
          if($product){
            $foto = $product->getPhoto();
            $nombreevento = $product->getName();
            $categoria = $product->getIDCategory();
          if(isset($_FILES['fotoevento'])){
              $rutaFoto = new Photo();
              $rutaFoto->uploadPhoto($_FILES['fotoevento'], "photos");
              $foto = $rutaFoto->getDirection();
          }
          if (isset($_POST['nombreevento'])){
            $nombreevento = $_POST['nombreevento'];
          }
           if (isset($_POST['categoria'])){
            $categoria = $_POST['categoria'];
          }
        $event=new Event($nombreevento,$foto,$categoria);
        $this->dao->edit($event,$id); 

          }

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
        try {
          $rutaFoto = new Photo();
          $rutaFoto->uploadPhoto($_FILES['fotoevento'], "photos");
          $us=new Event($_POST['nombreevento'],$rutaFoto->getDirection(),$_POST['categoria']);
          $this->dao->create($us);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
      header("Location:" . URl . "Calendar/index");
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
    public function search($search_product){
      $search_product = preg_replace("#[^0-9a-z]#i", "", $search_product);
      $product = $this->dao->search($search_product);
      $this->viewEventbysearch($product);
    }
    public function viewEventbysearch($product) {
      include (ROOT . 'views/eventbysearch.php');
    }
    public function deletelastevent(){
       $array=$this->dao->maxId();
       $array=array_shift($array);
        $id=array_shift($array);
        $this->dao->deleteid($id);
    }
    public function setmsg($msg){
        $this->msg=$msg;
    }

}
