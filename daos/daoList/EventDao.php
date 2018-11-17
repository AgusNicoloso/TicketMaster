<?php namespace daos\daoList;
class EventDao extends Singleton implements idao {
    private $list;
    public function __construct() {
        $this->list = array();
    }
    public function getSessionEvent() {
        if (!isset($_SESSION['EventList'])) {
            $_SESSION['EventList'] = array();
        }
        return $_SESSION['EventList'];
    }
    public function setSessionArtist($value) {
        $_SESSION['EventList'] = $value;
    }
    function add($eventobject) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $add = true;
        if (isset($_SESSION['EventList'])) {
            $ArrayEvent = $_SESSION['EventList'];
            foreach ($ArrayEvent as $key => $value) {
                if ($eventobject->getName() == $value->getName()) {
                    $add = false;
                }
            }
        }
        if ($add) {
            $ArrayEvent[] = $eventobject;
            $_SESSION['EventList'] = $ArrayEvent;
        }
    }
    function delete($nombre) {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['EventList'])) {
            $ArrayEvent = $_SESSION['EventList'];
            foreach ($ArrayEvent as $key => $value) {
                if ($nombre == $value->getName()) {
                    unset($ArrayEvent[$key]);
                }
            }
        }
        $_SESSION['EventList'] = $ArrayEvent;
    }
    function update($dato, $datonuevo) {
        // TODO: Implement updateArtist() method.
        
    }
    function returnList() {
        return $this->list;
    }
    public function getEvent($nombre) {
        if (isset($_SESSION['EventList'])) {
            $ArrayEvent = $_SESSION['EventList'];
            foreach ($ArrayEvent as $key => $value) {
                if ($nombre == $value->getName()) {
                    return $value;
                }
            }
        }
    }
}
