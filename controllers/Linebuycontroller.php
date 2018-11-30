<?php
namespace controllers;
use models\Buyline as Buyline;
use daos\databases\linebuyDB as dao;
use controllers\UserController as UserController;
class Linebuycontroller {
    protected $dao;
    private $obj;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        $buys=NULL;
        if ($this->getAll()) { 
            $buys = $this->getAll(); 
        }
        require (ROOT . 'views/allbuy.php');
    }
    public function insert($quantity,$total_price,$id_plaza_evento,$id_buy,$id_ticket) {
        try {
            $buy = new Buyline($quantity,$total_price,$id_plaza_evento,$id_buy,$id_ticket);
            $this->dao->create($buy);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAll() {
        return $this->dao->getAll();
    }
}
