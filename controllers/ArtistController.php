<?php
namespace controllers;
//use daos\daoList\ArtistDao as Dao;
use daos\databases\artistDB as dao;
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
        $artist = new Artist($nombre);
        $this->dao->create($artist->getName());
    }
    public function deleteArtist($nombre) {
        $this->dao->delete($nombre);
    }
    public function showArtist() {
        return $this->dao->readAll();
    }
}
