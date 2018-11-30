<?php
namespace controllers;
use models\Buy as Buy;
use daos\databases\BuyDB as dao;
use daos\databases\linebuyDB as linebuyDB;
use controllers\UserController as UserController;
class BuyController {
    protected $dao;
    private $obj;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        $buys=NULL;
        if ($this->getAll()) { $buys = $this->getAll(); }
        require (ROOT . 'views/allbuy.php');
    }
    public function insert($date, $client) {
        try {
            $buy = new Buy($date, $client);
            $this->dao->create($buy);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAll() {
        return $this->dao->getAll();
    }
    public function getbuyuser($email) {
        $userdb = new UserController();
        $user = $userdb->search($email);
        $linebuyDB = new linebuyDB();
        return $linebuyDB->getbuyuser($user->getID());
    }
    public function userbuylist() {
        $buys = $this->getbuyuser($_SESSION['logued']->getMail());
        require (ROOT . 'views/userbuylist.php');
    }
    public function getLastID() {
        return $this->dao->getLastID();
    }
}
