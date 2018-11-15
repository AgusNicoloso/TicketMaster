<?php namespace daos\daoList;
class ArtistDao extends Singleton implements idao {
    private $list;
    public function __construct() {
        $this->list = array();
    }
    public function getSessionArtist() {
        if (!isset($_SESSION['ArtistList'])) {
            $_SESSION['ArtistList'] = array();
        }
        return $_SESSION['ArtistList'];
    }
    public function setSessionArtist($value) {
        $_SESSION['ArtistList'] = $value;
    }
    function add($artistobject) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $add = true;
        if (isset($_SESSION['ArtistList'])) {
            $arrayArtist = $_SESSION['ArtistList'];
            foreach ($arrayArtist as $key => $value) {
                if ($artistobject->getName() == $value->getName()) {
                    $add = false;
                }
            }
        }
        if ($add) {
            $arrayArtist[] = $artistobject;
            $_SESSION['ArtistList'] = $arrayArtist;
        }
    }
    function delete($nombre) {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['ArtistList'])) {
            $arrayArtist = $_SESSION['ArtistList'];
            foreach ($arrayArtist as $key => $value) {
                if ($nombre == $value->getName()) {
                    unset($arrayArtist[$key]);
                }
            }
        }
        $_SESSION['ArtistList'] = $arrayArtist;
    }
    function update($dato, $datonuevo) {
        // TODO: Implement updateArtist() method.
        
    }
    function save() {
        // TODO: Implement saveArtist() method.
        
    }
    function returnList() {
        return $this->list;
    }
}
