<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 23/10/2018
 * Time: 10:42
 */

namespace controllers;
use daos\databases\Connection;
//use daos\daoList\userDB as Dao;
use daos\databases\calendarDB as dao;
use daos\databases\eventplaceDB;
use models\Calendar as Calendar;
use models\Category;
use models\EventPlace;
use models\Seat;

class CalendarController
{
    protected $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        require ('views/calendarForm.php');
    }
    public function index2() {
        require ('views/calendar2Form.php');
    }

    public function addCalendar()
    {
        $i=1;
        $a=$_SESSION['dates'];
        $event=$_SESSION['data']['event'];
        $place=$_SESSION['data']['place'];
        $c_eventPlace=new EventPlaceController();
        $axc=new ArtistperCalendarController();
        $controller=false;
        while(!empty($a)){
            $b=array_shift($a);
            $aux=$this->dao->verifyDate($b,$place);
            if($aux==true){
                $controller=true;
            }
        }
        if($controller){
            $msg="La fecha en ese lugar ya está ocupada";
            require("views/calendarForm.php");
        }else{
            $a=$_SESSION['dates'];
            while ($i <= $_SESSION['data']['days']){
                $dia='dia'.$i;
                $quant=$_SESSION['data']['cantidad'];
                $price=$_SESSION['data']['precios'];
                $seatid=$_SESSION['data']['seats'];
                $b=array_shift($a);
                $calendar=new Calendar($event,$place);
                $this->dao->create($calendar,$b);
                while(!empty($seatid)){
                    $artists=$_POST[$dia];
                    $seatparam=array_shift($seatid);
                    $priceparam=array_shift($price);
                    $quantparam=array_shift($quant);
                    while(!empty($artists)){
                        $artistparam=array_shift($artists);
                        $idCalendar=$this->dao->lastId();
                        $axc->addArtistxCalendar($idCalendar,$artistparam);
                    }
                    $c_eventPlace->addEventPlace($quantparam,$priceparam,$seatparam,$idCalendar);
                }
                $i++;
            }
            header("Location:" . URl);
        }
        unset($_SESSION['data'],$_SESSION['dates']);
    }
    public function allCalendars()
    {

          return $Calendarios=$this->dao->mapeoCalendar();
    }
    public function last(){
        if(is_array($this->allCalendars())){
            return $array=array_reverse($this->allCalendars());
        }
        else{
            return $this->allCalendars();
        }

    }

    public function home()
    {
        header("Location:".URl);
    }
    public function infoEvent($id){
        return $this->dao->mapeoEventDetail($id);
    }
    public function filter($startdate='',$enddate=''){
      $product =  $this->dao->filter($startdate,$enddate);
      $this->viewEventbyfilter($product);
    }
    public function viewEventbyfilter($product) {
      include (ROOT . 'views/eventbyfilter.php');
    }

}
