<?php
namespace controllers;
use daos\databases\Connection;
use models\ArtistPerCalendar as Artistc;
use daos\databases\artistxcalendarDB as dao;
class ArtistperCalendarController {
    private $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function addArtistxCalendar($idCalendar, $idArtist) {
        $axc = new Artistc($idCalendar, $idArtist);
        $this->dao->create($axc);
    }
}
