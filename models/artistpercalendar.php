<?php
namespace models;
class ArtistPerCalendar {
    private $idCalendar;
    private $idArtist;
    public function __construct($idCalendar = '', $idArtist = '') {
        $this->idCalendar = $idCalendar;
        $this->idArtist = $idArtist;
    }
    public function getIdCalendar() {
        return $this->idCalendar;
    }
    public function getIdArtist() {
        return $this->idArtist;
    }
}
