<?php namespace daos\daoList;
class CategoryDao extends Singleton implements idao {
    private $list;
    public function __construct() {
        $this->list = array();
    }
    public function getSessionEvent() {
        if (!isset($_SESSION['CategoryList'])) {
            $_SESSION['CategoryList'] = array();
        }
        return $_SESSION['CategoryList'];
    }
    public function setSessionArtist($value) {
        $_SESSION['CategoryList'] = $value;
    }
    function add($categoryobject) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $add = true;
        if (isset($_SESSION['CategoryList'])) {
            $ArrayCategory = $_SESSION['CategoryList'];
            foreach ($ArrayCategory as $key => $value) {
                if ($categoryobject->getName() == $value->getName()) {
                    $add = false;
                }
            }
        }
        if ($add) {
            $ArrayCategory[] = $categoryobject;
            $_SESSION['CategoryList'] = $ArrayCategory;
        }
    }
    function delete($nombre) {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['CategoryList'])) {
            $ArrayCategory = $_SESSION['CategoryList'];
            foreach ($ArrayCategory as $key => $value) {
                if ($nombre == $value->getName()) {
                    unset($ArrayCategory[$key]);
                }
            }
        }
        $_SESSION['CategoryList'] = $ArrayCategory;
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
