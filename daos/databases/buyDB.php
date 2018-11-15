<?php
namespace daos\databases;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use daos\daoList\idao as idao;
use models\Buy as Buy;
use models\Ticket as Ticket;
class BuyDB extends SingletonDao implements idao {
    private $connection;
    function __construct() {
    }
    public function create($buy) {
        $sql = "INSERT INTO compras (id_ticket,date_buy,id_client) VALUES (:id_ticket,:date_buy,:id_client)";
        $parameters['id_ticket'] = $buy->getTicket()->getID();
        $parameters['date_buy'] = $buy->getDate();
        $parameters['id_client'] = $buy->getClient();
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
            $sql = "SELECT * from compras c inner join tickets t where c.id_ticket = t.id_ticket";
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
            $sql = "SELECT * from compras c inner join tickets t on c.id_ticket = t.id_ticket where c.id_client = $user";
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
            $ticket = new Ticket($p['qr'], $p['id_ticket']);
            $user = $userdb->readBYID($p['id_client']);
            return new Buy($ticket, $user, $p['date_buy'], $p['id_buy']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
}
