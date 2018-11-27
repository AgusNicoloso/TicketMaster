<?php
namespace controllers;
use daos\databases\artistDB as dao;
//use daos\daoList\artistList as dao;
use models\Artist as Artist;
class ArtistController {
    protected $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        include ("views/artist.php");
    }
    public function addArtist($nombre) {

        $this->dao->create($nombre);
        header("Location:".URl);
    }
    public function deleteArtist($nombre) {
        $this->dao->delete($nombre);
    }
    public function showArtist() {
        if(isset($_SESSION['artists'])){
            return $_SESSION['artists'];
        }
        return $this->dao->readAll();
    }
}
