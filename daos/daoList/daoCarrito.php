<?php namespace daos\daoList;
class DaoCarrito extends Singleton implements idao {
    private $list;
    public function __construct() {
        $this->list = array();
    }
    public function getSessionEvent() {
        if (!isset($_SESSION['CarritoList'])) {
            $_SESSION['CarritoList'] = array();
        }
        return $_SESSION['CarritoList'];
    }
    public function setSessionArtist($value) {
        $_SESSION['CarritoList'] = $value;
    }
    function add($array) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['CarritoList'][]= $array;
    }
    function delete($i) {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['CarritoList'])) {
            $ArrayEvent = $_SESSION['CarritoList'];
            unset($ArrayEvent[$i]);
        }
        $_SESSION['CarritoList'] = $ArrayEvent;
    }
    function update($dato, $datonuevo) {
        // TODO: Implement updateArtist() method.

    }
    function save() {
        // TODO: Implement save() method.

    }
    function returnList() {
        return $this->list;
    }
}
