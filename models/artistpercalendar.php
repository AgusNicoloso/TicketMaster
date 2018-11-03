<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 2/11/2018
 * Time: 11:27
 */

namespace models;


class ArtistPerCalendar
{
    private $idCalendar;
    private $idArtist;

    /**
     * ArtistPerCalendar constructor.
     * @param $idCalendar
     * @param $idArtist
     */
    public function __construct($idCalendar='', $idArtist='')
    {
        $this->idCalendar = $idCalendar;
        $this->idArtist = $idArtist;
    }

    /**
     * @return string
     */
    public function getIdCalendar()
    {
        return $this->idCalendar;
    }

    /**
     * @return string
     */
    public function getIdArtist()
    {
        return $this->idArtist;
    }


}