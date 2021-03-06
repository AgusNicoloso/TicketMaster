<?php
namespace controllers;
use controllers\productdetailController as productdetailController;
use models\Category;
use models\event as Event;
use models\Photo as Photo;
use daos\databases\eventDB as dao;
//use daos\daoList\eventList as dao;
class EventController {
    protected $dao;
    private $obj;
    public $msg;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        $controllercategory = new \controllers\categoryController();
         if ($controllercategory->getAll()) { $list = $controllercategory->getAll();}
        require (ROOT . 'views/event.php');
    }
    public function addEvent($nombre) {
        $event = $this->dao->getEvent($nombre);
        $daocarrito = new \daos\daoList\daoCarrito();
        $daocarrito->add($event);
        header("Location: http://localhost/TicketMaster/product");
    }
    public function indexEditEvent($product) {
        $controllercategory = new \controllers\categoryController();
        if ($controllercategory->getAll()) { $list = $controllercategory->getAll();}
        require (ROOT . 'views/editevent.php');
    }
    public function deleteEvent($id) {
      $daocarrito = new \daos\daoList\daoCarrito();
      $daocarrito->delete($id);
      header("Location: http://localhost/TicketMaster/product");
    }
    public function editEvent($id) {
        $product = $this->dao->read($id);
        $this->indexEditEvent($product);
    }
        public function edit($id) {
        $id = $_POST['eventid'];
        $product = $this->dao->read($id);
        if ($product) {
            $foto = $product->getPhoto();
            $nombreevento = $product->getName();
            $categoria = $product->getIDCategory();
            if ($_FILES['fotoevento']['size'] != 0) {
                $rutaFoto = new Photo();
                $rutaFoto->uploadPhoto($_FILES['fotoevento'], "photos");
                $foto = $rutaFoto->getDirection();
            }
            if ($_POST['nombreevento'] != NULL) {
                $nombreevento = $_POST['nombreevento'];
            }
            if (isset($_POST['categoria'])) {
                $categoria = $_POST['categoria'];
            }
            $event = new Event($nombreevento, $foto, $categoria);
            $this->dao->edit($event, $id);
        }
        header("Location: http://localhost/TicketMaster/product");
    }
    public function see($id) {
        $product = $this->dao->read($id);
        $this->viewProductDetail($product);
    }
    public function viewProductDetail($product) {
        $productdetailController = new productdetailController();
        $productdetailController->index($product);
    }
    public function see1($id,$msg) {
        $product = $this->dao->read($id);
        $this->viewProductDetail1($product,$msg);
    }
    public function viewProductDetail1($product,$msg) {
        $productdetailController = new productdetailController();
        $productdetailController->index1($product,$msg);
    }
    public function getEvent($id) {
        return $this->dao->read($id);
    }
    public function insert($evento='',$categoria='') {
        if(empty($evento) || empty($categoria)){
            $msg = "Complete los datos por favor";
            $controllercategory = new \controllers\categoryController();
         if ($controllercategory->getAll()) { $list = $controllercategory->getAll();}
        require (ROOT . 'views/event.php');
        }else{
            try {

            $rutaFoto = new Photo();
            $rutaFoto->uploadPhoto($_FILES['fotoevento'], "photos");
            if(isset($_SESSION['category'])){
                $arreglo=$_SESSION['category'];
                if(is_array($arreglo)){
                    $aux=$arreglo[$categoria-1];
                }else{
                    $aux=$_SESSION['category'];
                }
                $categoria=$aux;
            }
            $us = new Event($evento, $rutaFoto->getDirection(), $categoria);
            $this->dao->create($us);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        header("Location:" . URl . "Calendar/index");
        }
        
    }
    public function getAll() {
        return $this->dao->readAll();
    }
    public function getAllNotCalendar() {
        return $this->dao->getAllNotCalendar();
    }
    public function getLimitAll($page) {
        return $this->dao->readLimitAll($page);
    }
    public function getLimit($page, $id) {
        return $this->dao->readLimit($page, $id);
    }
    public function getAllbyID($id) {
        return $this->dao->readAllbyID($id);
    }
    public function search($search_product) {
        $search_product = preg_replace("#[^0-9a-z]#i", "", $search_product);
        $product = $this->dao->search($search_product);
        $this->viewEventbysearch($product);
    }
    public function viewEventbysearch($product) {
        $controllercategory = new \controllers\categoryController();
        $dbevents = new \controllers\EventController();
        include (ROOT . 'views/eventbysearch.php');
    }
    public function deletelastevent() {
        $array = $this->dao->maxId();
        $array = array_shift($array);
        $id = array_shift($array);
        $this->dao->deleteid($id);
    }
    public function setmsg($msg) {
        $this->msg = $msg;
    }
}
