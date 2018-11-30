<?php
namespace controllers;
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
    public function insert($number,$qr) {
        try {
            $ticket = new Ticket($number,$qr);
            $this->dao->create($ticket);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    public function search($qr) {
        return $this->dao->read($qr);
    }
    public function getLastID() {
        return $this->dao->getLastID();
    }
}
