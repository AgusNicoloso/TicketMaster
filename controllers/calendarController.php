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
        $c_event=new EventController();
        $c_place=new PlaceController();
        $c_category=new CategoryController();
        $c_seat=new SeatController();
        $seatList=$c_seat->allSeat();
        $categoryList=$c_category->getAll();
        $eventList=$c_event->getAll();
        $placeList=$c_place->allPlace();
        require ('views/calendarForm.php');
    }
    public function index2() {
        $c_eventplace=new EventPlaceController();
        $c_place=new PlaceController();
        $c_seat=new SeatController();
        $lista= new ArtistController();
        $dateStart = new \DateTime($_POST['dateIn']);
        $dateFinish = new \DateTime($_POST['dateOut']);
        $dayCounter = $dateStart->diff($dateFinish);
        $dayCounter = $dayCounter->format('%a');
        $seatList=$_POST['seats'];
        $seatList=$c_seat->arrayseat($seatList);
        $_SESSION['dates']=array();
        $place=$c_place->placebyid($_POST['place']);
        $lista= $lista->showArtist();
                require('views/calendar2Form.php');
    }
    public function quatity()
    {

        $c_eventplace = new EventPlaceController();
        $c_place = new PlaceController();
        if ($_POST) {
            $cant = $c_eventplace->capacityCounter($_POST['cantidad']);

            $place = $c_place->placebyid($_SESSION['data']['place']);
            if ($place->getCapacity() < $cant) {
                return false;
            }
        }
        return true;
    }
    public function oktoadd(){
        $c_eventplace=new EventPlaceController();
        $c_place=new PlaceController();
        $c_seat=new SeatController();
        $c_event=new EventController();
        if($this->quatity()!=true){

            $msg='Supera la capacidad del establecimiento';
            require ('views/calendarForm.php');
        }else{
            $this->addCalendar();
        }
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
                    // $quant=$_SESSION['data']['cantidad'];
                    //$price=$_SESSION['data']['precios'];
                    $quant=$_POST['cantidad'];
                    $price=$_POST['precios'];
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
