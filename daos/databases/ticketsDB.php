<?php
namespace daos\databases;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use daos\daoList\idao as idao;
use models\Ticket as Ticket;
class TicketsDB extends SingletonDao implements idao {
    private $connection;
    function __construct() {
    }
    public function create($ticket) {
        $sql = "INSERT INTO tickets (qr) VALUES (:qr)";
        $parameters['qr'] = $ticket->getQR();
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }
    public function read($qr) {
        $sql = "SELECT * FROM tickets where qr = :qr";
        $parameters['qr'] = $qr;
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
}
