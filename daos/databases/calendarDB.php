<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 29/10/2018
 * Time: 16:49
 */

namespace daos\databases;
use daos\daoList\idao as IDao;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;


class calendarDB extends SingletonDao implements IDao
{
    private $connection;
    public function create($calendar,$a) {
        // Guardo como string la consulta sql utilizand o como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
        $sql = "INSERT INTO calendarios (date_event,id_place,id_event,id_plaza_evento)VALUES (:date_event,:id_place,:id_event,:id_plaza_evento)";
        $parameters['date_event'] = $a;
        $parameters['id_place'] = $calendar->getPlace();
        $parameters['id_event'] = $calendar->getEvent();
        $parameters['id_plaza_evento'] = $calendar->getTypeplace();
        try {
            // creo la instancia connection
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            // Ejecuto la sentencia.
            //return $this->connection->ExecuteNonQuery($sql, $parameters);
            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }
    public function verifyDate($date_event,$id_place)
    {
        $sql="select c.id_place,c.date_event FROM calendarios c where c.id_place = :id_place and c.date_event = :date_event";
        $parameters['id_place']=$id_place;
        $parameters['date_event']=$date_event;
        try {
            // creo la instancia connection
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            // Ejecuto la sentencia.
            $asd=$this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
        if(!empty($asd)){
            return true;
        }
        else{
            return false;
        }

    }
    public function lastId()
    {
        $sql = "SELECT MAX(id_calendar) FROM calendarios";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            throw $ex;
        }
        $a=array_shift($resultSet);
        $b=array_shift($a);
        return $b;

    }
    function add($artist)
    {
        // TODO: Implement add() method.
    }

    function delete($nombre)
    {
        // TODO: Implement delete() method.
    }

    function update($dato, $datonuevo)
    {
        // TODO: Implement update() method.
    }

    function save()
    {
        // TODO: Implement save() method.
    }

}