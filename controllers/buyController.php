<?php
namespace controllers;
//use daos\daoList\EventDao as Dao;
use models\Buy as Buy;
use daos\databases\BuyDB as dao;
class BuyController {
    protected $dao;
    private $obj;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
      require (ROOT . 'views/allbuy.php');
    }
    public function insert($ticket,$client,$date){
        try {
          $buy=new Buy($ticket,$client,$date);
          $this->dao->create($buy);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
    public function getAll(){
      return $this->dao->getAll();
    }
    

}
