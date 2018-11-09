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
use models\Artist;
use models\Calendar as Calendar;
use models\Category;
use models\Event as Event;
use models\EventPlace;
use models\Place;
use models\Seat;


class calendarDB extends SingletonDao implements IDao
{
    private $connection;
    public function create($calendar,$a) {
        // Guardo como string la consulta sql utilizand o como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
        $sql = "INSERT INTO calendarios (date_event,id_place,id_event)VALUES (:date_event,:id_place,:id_event)";
        $parameters['date_event'] = $a;
        $parameters['id_place'] = $calendar->getPlace();
        $parameters['id_event'] = $calendar->getEvent();
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
    public function readAll() {
        try {
            $sql = "SELECT * FROM calendarios";
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
            $event=$this->mapeoEvent($p['id_event']);
            $place=$this->mapeoPlacetype($p['id_plaza_evento']);
            return new Calendar($event,$p['id_place'],$place,$p['id_calendar'],'','',$p['date_event']);
            // return new EventPlace($p['id_lugar_evento'],$p['quantity'],$p['available'],$p['price'],$p['id_tipo_plaza']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }

    public function mapeoCalendar(){
        $sql = "
select 
		c.id_calendar,
		c.date_event,
		c.id_place,
		c.id_event,
		e.title_event,
		e.photo,
		e.id_category,
		cat.category_name,
		le.place_name,
		le.capacity
from 	calendarios c 
		inner join eventos e on  c.id_event=e.id_event 
		inner join categorias cat on e.id_category=cat.id_category
		inner join lugares_eventos le on c.id_place = le.id_place";

        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $value = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            throw $ex;
        }
        if (!empty($value)){
            $value = is_array($value) ? $value : [];
            $resp = array_map(function ($p) {
                $category=NEW Category($p['category_name'],$p['id_category']);
                $event=new Event($p['title_event'],$p['photo'],$category,$p['id_event']);
                $place=new Place($p['id_place'],$p['place_name'],$p['capacity']);
                $placeevent=$this->mapeoPlacetype($p['id_calendar']);
                $artist=$this->mapeoART($p['id_calendar']);
                return new Calendar($event,$place,$placeevent,$p['id_calendar'],'',$artist,$p['date_event']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
    }

    public function mapeoPlacetype($id)
    {
        $sql = "select * from plaza_eventos p where p.id_calendar=$id";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $value = $this->connection->execute($sql);
        } catch (Exception $ex) {
            throw $ex;
        }
        if (!empty($value)) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function ($p) {
                $seat=$this->mapeoSeat($p['id_tipo_plaza']);
                return new EventPlace($p['quantity'],$p['price'],$seat,$p['available'],$p['id_plaza_evento']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
    }
    protected function mapeoSeat($id)
    {
        $sql = "SELECT * FROM tipo_plaza t where t.id_tipo_plaza = $id ";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $value = $this->connection->execute($sql);
        } catch (Exception $ex) {
            throw $ex;
        }
        if (!empty($value)) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function ($p) {
                return new Seat($p['descript'], $p['id_tipo_plaza']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
    }
    protected function mapeoART($id)
    {
        $sql = "
		SELECT * FROM artistas_x_calendarios axc inner join artistas a on axc.id_artist = a.id_artist where axc.id_calendar=$id ";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $value = $this->connection->execute($sql);
        } catch (Exception $ex) {
            throw $ex;
        }
        if (!empty($value)) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function ($p) {
                return new Artist($p['artist_name']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
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