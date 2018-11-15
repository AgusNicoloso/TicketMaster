<?php
namespace controllers;
use daos\databases\Connection;
use daos\databases\calendarDB as dao;
use daos\databases\eventplaceDB;
use models\Calendar as Calendar;
use models\Category;
use models\EventPlace;
use models\Seat;
class CalendarController {
    protected $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        $c_event = new EventController();
        $c_place = new PlaceController();
        $c_category = new CategoryController();
        $c_seat = new SeatController();
        $c_artist = new ArtistController();
        $art = $c_artist->showArtist();
        $seatList = $c_seat->allSeat();
        $categoryList = $c_category->getAll();
        $eventList = $c_event->getAll();
        $placeList = $c_place->allPlace();
        $msg;
        if (empty($seatList) || empty($art) || empty($eventList) || empty($placeList)) {
            $msg = "No estan todas las listas cargadas";
        }
        require ('views/calendarForm.php');
    }
     public function index2($event,$dateIn,$dateOut,$place,$seats) {
        $c_eventplace = new EventPlaceController();
        $c_place = new PlaceController();
        $c_seat = new SeatController();
        $lista = new ArtistController();
        $dateStart = new \DateTime($dateIn);
        $dateFinish = new \DateTime($dateOut);
        $dayCounter = $dateStart->diff($dateFinish);
        $dayCounter = $dayCounter->format('%a');
        $seatList = $c_seat->arrayseat($seats);
        $_SESSION['dates'] = array();
        $place = $c_place->placebyid($place);
        $lista = $lista->showArtist();
        require ('views/calendar2Form.php');
    }
    public function quatity($cantidad,$place) {
        $c_eventplace = new EventPlaceController();
        $c_place = new PlaceController();
        if ($_POST) {
            $cant = $c_eventplace->capacityCounter($cantidad);
            $place = $c_place->placebyid($place);
            if ($place->getCapacity() < $cant) {
                return false;
            }
        }
        return true;
    }
    public function oktoadd($precios,$cantidad,$event,$dateIn,$dateOut,$place,$days,$seats,$dates) {
        $c_eventplace = new EventPlaceController();
        $c_place = new PlaceController();
        $c_seat = new SeatController();
        $c_event = new EventController();
        if ($this->quatity($cantidad,$place) != true) {
            $msg = 'Supera la capacidad del establecimiento';
            require ('views/calendarForm.php');
        } else {
            $this->addCalendar($precios,$cantidad,$event,$dateIn,$dateOut,$place,$days,$seats,$dates);
        }
    }
    public function addCalendar($precios,$cantidad,$event,$dateIn,$dateOut,$place,$days,$seats,$dates) {
        $i = 1;
        $a = $dates;
        $c_eventPlace = new EventPlaceController();
        $axc = new ArtistperCalendarController();
        $controller = false;
        while (!empty($a)) {
            $b = array_shift($a);
            $aux = $this->dao->verifyDate($b, $place);
            if ($aux == true) {
                $controller = true;
            }
        }
        if ($controller) {
            $c_event = new EventController();
            $c_place = new PlaceController();
            $c_seat = new SeatController();
            $seatList = $c_seat->allSeat();
            
            $eventList = $c_event->getAll();
            $placeList = $c_place->allPlace();
            $msg = "La fecha en ese lugar ya está ocupada";
            require ("views/calendarForm.php");
        } else {
            $a = $dates;
            while ($i <= $days) {
                $dia = 'dia' . $i;
                // $quant=$_SESSION['data']['cantidad'];
                //$price=$_SESSION['data']['precios'];
                $quant = $cantidad;
                $price = $precios;
                $seatid = $seats;
                $b = array_shift($a);
                $calendar = new Calendar($event, $place);
                $this->dao->create($calendar, $b);
                while (!empty($seatid)) {
                    $artists = $_POST[$dia];
                    $seatparam = array_shift($seatid);
                    $priceparam = array_shift($price);
                    $quantparam = array_shift($quant);
                    while (!empty($artists)) {
                        $artistparam = array_shift($artists);
                        $idCalendar = $this->dao->lastId();
                        $axc->addArtistxCalendar($idCalendar, $artistparam);
                    }
                    $c_eventPlace->addEventPlace($quantparam, $priceparam, $seatparam, $idCalendar);
                }
                $i++;
            }
            header("Location:" . URl);
        }
    }
    public function allCalendars() {
        return $Calendarios = $this->dao->mapeoCalendar();
    }
    public function last() {
        if (is_array($this->allCalendars())) {
            return $array = array_reverse($this->allCalendars());
        } else {
            return $this->allCalendars();
        }
    }
    public function home() {
        header("Location:" . URl);
    }
    public function infoEvent($id) {
        return $this->dao->mapeoEventDetail($id);
    }
    public function filter($startdate = '', $enddate = '') {
        $product = $this->dao->filter($startdate, $enddate);
        $this->viewEventbyfilter($product);
    }
    public function viewEventbyfilter($product) {
        $controllercategory = new \controllers\categoryController();
        $dbevents = new \controllers\EventController();
        include (ROOT . 'views/eventbyfilter.php');
    }
}
