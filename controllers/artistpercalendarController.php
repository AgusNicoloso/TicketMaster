<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 2/11/2018
 * Time: 11:25
 */

namespace controllers;
use daos\databases\Connection;
use models\ArtistPerCalendar as Artistc;
//use daos\daoList\seatDB as Dao;
use daos\databases\artistxcalendarDB as dao;

class ArtistperCalendarController
{
    private $dao;
    public function __construct()
    {
        $this->dao = dao::getInstance();
    }
    public function addArtistxCalendar($idCalendar,$idArtist){
        $axc= new Artistc($idCalendar,$idArtist);
        $this->dao->create($axc);
    }
}
