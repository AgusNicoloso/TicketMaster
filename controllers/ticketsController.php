<?php
namespace controllers;
//use daos\daoList\EventDao as Dao;
use models\Ticket as Ticket;
use daos\databases\TicketsDB as dao;
class TicketsController {
    protected $dao;
    private $obj;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
    }
    public function insert($qr){
        try {
          $ticket=new Ticket($qr);
          $this->dao->create($ticket);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
    public function search($qr){
      return $this->dao->read($qr);
    }
    

}
