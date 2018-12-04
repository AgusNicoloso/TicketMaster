<?php namespace controllers;
class CheckoutController {
    public function __construct() {
    }
    public function index() {
        $ticketsController = new \controllers\ticketsController();
        $buyController = new \controllers\buyController();
        $Linebuycontroller = new \controllers\Linebuycontroller();
        $SeatController = new \controllers\SeatController();
        $calendarController = new \controllers\calendarController();
        $qr = new \models\Qr_barcode();
        $foto = new \models\Photo();
        $compra = false;
        if (isset($_SESSION['CarritoList'])) {
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fechanow = date("Y-m-d H:i:s");
            $user = $_SESSION['logued'];
            $email = $user->getMail();
            $name = $user->getName();
            if (is_array($_SESSION['CarritoList'])) {
                $carrito = count($_SESSION['CarritoList']);
                $i=0;
                while ($i<$carrito) {
                    $nro_ticket = rand(0,999999999);
                    $event = $_SESSION['CarritoList'][$i]['title_event'];
                    $place = $_SESSION['CarritoList'][$i]['name_place'];
                     $qr->text("Gracias por la compra en TicketMaster
    Numero de ticket: $nro_ticket
    Fecha de compra: $fechanow
    Evento: $event
    Plaza: $place
    Nombre: $name
    Email: $email");
            $imageDirectory = ROOT . "photos/qr" . '/';
            if (!file_exists($imageDirectory)) {
                mkdir($imageDirectory);
            }
            $namear = str_replace(array("\\", "¨", "º", "-", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "&", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "<code>", "]", "+", "}", "{", "¨", "´", ">", "< ", ";", ",", ":", ".", " "), '', $nro_ticket);
            $ruta = "photos/qr" . '/' . $namear . ".png";
            $file = $imageDirectory . $namear . ".png";
            $qr->qrCode(300, $file);
            $ticketsController->insert($nro_ticket,$ruta);
            $buyController->insert($fechanow, $user->getID());
            $id_buy = $buyController->getLastID();
            $id_ticket = $ticketsController->getLastID();
            $id_plaza_evento = $SeatController->searchbyplace($_SESSION['CarritoList'][$i]['name_place']);
            $Linebuycontroller->insert($_SESSION['CarritoList'][$i]['quantity'],$_SESSION['CarritoList'][$i]['total'],$id_plaza_evento,$id_buy,$id_ticket);
            $calendarController->discountavailable($_SESSION['CarritoList'][$i]['id_event'],$id_plaza_evento,$_SESSION['CarritoList'][$i]['quantity']);
            $i++;
                $compra = true;
                 }
            } else {
                $nro_ticket = rand(0,999999999);
                    $event = $_SESSION['CarritoList']['title_event'];
                    $place = $_SESSION['CarritoList']['name_place'];
                     $qr->text("Gracias por la compra en TicketMaster
    Numero de ticket: $nro_ticket
    Fecha de compra: $fechanow
    Evento: $event
    Plaza: $place
    Nombre: $name
    Email: $email");
            $imageDirectory = ROOT . "photos/qr" . '/';
            if (!file_exists($imageDirectory)) {
                mkdir($imageDirectory);
            }
            $namear = str_replace(array("\\", "¨", "º", "-", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "&", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "<code>", "]", "+", "}", "{", "¨", "´", ">", "< ", ";", ",", ":", ".", " "), '', $fechanow);
            $ruta = "photos/qr" . '/' . $namear . ".png";
            $file = $imageDirectory . $namear . ".png";
            $qr->qrCode(300, $file);
            $ticketsController->insert($nro_ticket,$ruta);
            $buyController->insert($fechanow, $user->getID());
            $id_buy = $buyController->getLastID();
            $id_ticket = $ticketsController->getLastID();
            $id_plaza_evento = $PlaceController->searchbyplace($_SESSION['CarritoList']['name_place']);
            $Linebuycontroller->insert($_SESSION['CarritoList']['quantity'],$_SESSION['CarritoList']['total'],$id_plaza_evento,$id_buy,$id_ticket);
                $compra = true;
            }
        unset($_SESSION['CarritoList']);  
        }
        $url = URl;
        $buyController->userbuylist();
    }
}
?>
