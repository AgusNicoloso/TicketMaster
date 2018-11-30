<?php
namespace daos\databases;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use daos\daoList\idao as idao;
use models\Buy as Buy;
use models\BuyLine as BuyLine;
use models\Ticket as Ticket;
class linebuyDB extends SingletonDao implements idao {
    private $connection;
    function __construct() {
    }
    public function create($buy) {
        $sql = "INSERT INTO lineas_compra (quantity,total_price,id_plaza_evento,id_buy,id_ticket) VALUES (:quantity,:total_price,:id_plaza_evento,:id_buy,:id_ticket)";
        $parameters['quantity'] = $buy->getQuantity();
        $parameters['total_price'] = $buy->getTotal_price();
        $parameters['id_plaza_evento'] = $buy->getId_plaza_evento();
        $parameters['id_buy'] = $buy->getId_buy();
        $parameters['id_ticket'] = $buy->getId_ticket();
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }
    public function read($id) {
        $sql = "SELECT * FROM eventos where id_event = :id_event";
        $parameters['id_event'] = $id;
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql, $parameters);
        }
        catch(Exception $ex) {
            throw $ex;
        }
        if (!empty($resultSet)) return $this->mapear($resultSet);
        else return false;
    }
    public function update($value, $valiue) {
    }
    public function delete($id) {
        try {
            $sql = "DELETE FROM eventos WHERE id_event = $id";
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
        }
        if (!empty($resultSet)) return $this->mapear($resultSet);
        else return false;
    }
    protected function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function ($p) {
            return new Ticket($p['qr'], $p['id_ticket']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
    public function getAll() {
        try {
            $sql = "SELECT * 
from 
lineas_compra l inner join compras c on l.id_buy = c.id_buy
inner join tickets t on l.id_ticket = t.id_ticket";
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
        }
        if (!empty($resultSet)) return $this->mapearAll($resultSet);
        else return false;
    }
    public function getbuyuser($user) {
        try {
            $sql = "SELECT * 
from 
lineas_compra l inner join compras c on l.id_buy = c.id_buy
inner join tickets t on l.id_ticket = t.id_ticket
where 
c.id_client = $user";
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
        }
        if (!empty($resultSet)) return $this->mapearAll($resultSet);
        else return false;
    }
    protected function mapearAll($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function ($p) {
            $userdb = new userDB();
            $user = $userdb->readBYID($p['id_client']);
            $ticket = new Ticket($p['number_ticket'], $p['qr'],$p['id_ticket']);
            $buy = new Buy($p['date_buy'], $user, $p['id_buy']);
            return new BuyLine($p['quantity'], $p['total_price'], $p['id_plaza_evento'], $buy, $ticket, $p['id_buy_line']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
}
