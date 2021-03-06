<?php
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
class calendarDB extends SingletonDao implements IDao {
    private $connection;
    public function create($calendar, $a) {
        $sql = "INSERT INTO calendarios (date_event,id_place,id_event)VALUES (:date_event,:id_place,:id_event)";
        $parameters['date_event'] = $a;
        $parameters['id_place'] = $calendar->getPlace();
        $parameters['id_event'] = $calendar->getEvent();
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }
    public function discountavailable($id_event,$place,$quantity){
        $sql = "UPDATE calendarios AS c
INNER JOIN plaza_eventos AS P 
ON 
c.id_calendar = p.id_calendar
SET 
p.available = p.available - $quantity
WHERE 
p.available > 0 and c.id_event = $id_event and p.id_tipo_plaza = $place";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $this->connection->ExecuteNonQuery($sql);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }
    public function verifyDate($date_event, $id_place) {
        $sql = "select c.id_place,c.date_event FROM calendarios c where c.id_place = :id_place and c.date_event = :date_event";
        $parameters['id_place'] = $id_place;
        $parameters['date_event'] = $date_event;
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $asd = $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
        if (!empty($asd)) {
            return true;
        } else {
            return false;
        }
    }
    public function lastId() {
        $sql = "SELECT MAX(id_calendar) FROM calendarios";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            throw $ex;
        }
        $a = array_shift($resultSet);
        $b = array_shift($a);
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
            $event = $this->mapeoEvent($p['id_event']);
            $place = $this->mapeoPlacetype($p['id_plaza_evento']);
            return new Calendar($event, $p['id_place'], $place, $p['id_calendar'], '', '', $p['date_event']);            
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
    public function mapeoCalendar() {
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
      from  
        calendarios c 
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
        if (!empty($value)) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function ($p) {
                $category = NEW Category($p['category_name'], $p['id_category']);
                $event = new Event($p['title_event'], $p['photo'], $category, $p['id_event']);
                $place = new Place($p['id_place'], $p['place_name'], $p['capacity']);
                $placeevent = new eventplaceDB();
                $artist = new artistxcalendarDB();
                $placeevent->read($p['id_calendar']);
                $artist->mapeoART($p['id_calendar']);
                return new Calendar($event, $place, $placeevent, $p['id_calendar'], '', $artist, $p['date_event']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
    }
    public function mapeoCalendarDetail($id) {
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
from    calendarios c 
        inner join eventos e on  c.id_event=e.id_event
        inner join categorias cat on e.id_category=cat.id_category
        inner join lugares_eventos le on c.id_place = le.id_place
where
        e.id_event = $id";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $value = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            throw $ex;
        }
        if (!empty($value)) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function ($p) {
                $category = NEW Category($p['category_name'], $p['id_category']);
                $event = new Event($p['title_event'], $p['photo'], $category, $p['id_event']);
                $place = new Place($p['id_place'], $p['place_name'], $p['capacity']);
                $pdb = new eventplaceDB();
                $adb = new artistxcalendarDB();
                $placeevent = $pdb->mapeoPlacetype($p['id_calendar']);
                $artist = $adb->mapeoART($p['id_calendar']);
                return new Calendar($event, $place, $placeevent, $p['id_calendar'], '', $artist, $p['date_event']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
    }
    function delete($nombre) {    
    }
    function update($dato, $datonuevo) {        
    }
    public function filter($startdate, $enddate) {
        $sql = "select DISTINCT
        e.id_event,
        e.title_event,
        e.photo,
        e.id_category,
        cat.category_name
from    calendarios c 
        inner join eventos e on  c.id_event=e.id_event
        inner join categorias cat on e.id_category=cat.id_category
where e.id_event in (select id_event from calendarios where date_event between '$startdate' and '$enddate' order by date_event)";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $value = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            throw $ex;
        }
        if (!empty($value)) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function ($p) {
                $category = NEW Category($p['category_name'], $p['id_category']);
                return new Event($p['title_event'], $p['photo'], $category, $p['id_event']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
    }
}
