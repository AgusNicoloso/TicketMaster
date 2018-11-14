<?php namespace controllers;
class CheckoutController {
    public function __construct() {
    }
    public function index() {
        $ticketsController = new \controllers\ticketsController();
        $buyController = new \controllers\buyController();
        $qr = new \models\Qr_barcode();
        $foto = new \models\Photo();
        $compra = false;
        if(isset($_SESSION['CarritoList'])){
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fechanow = date('c');
            $user=$_SESSION['logued'];
            $email = $user->getMail();
            $name = $user->getName();
            if(is_array($_SESSION['CarritoList'])){
                $i=0;
                while ($i<count($_SESSION['CarritoList'])) {
                    $Evento[] = $_SESSION['CarritoList'][$i]['title_event'];
                    $Plazas[] = $_SESSION['CarritoList'][$i]['name_place'];
                    $i++;
                }
                $events = implode(' - ',$Evento);
                $seat = implode(' - ',$Plazas);
            }else{
                $events = $_SESSION['CarritoList']['title_event'];
                $seat = $_SESSION['CarritoList']['name_place'];
            }
            $qr->text("Gracias por la compra en TicketMaster!!
	Estos son los detalles de tu compra: 
	Fecha de compra: $fechanow
	Eventos: $events 
	Plazas: $seat
	Nombre: $name
	Email: $email");
            $imageDirectory = ROOT . "photos/qr" . '/';
            if (!file_exists($imageDirectory)) {
                mkdir($imageDirectory);
            }
            $namear= str_replace(
                array("\\", "¨", "º", "-", "~",
                    "#", "@", "|", "!", "\"",
                    "·", "$", "%", "&", "/",
                    "(", ")", "?", "'", "¡",
                    "¿", "[", "^", "<code>", "]",
                    "+", "}", "{", "¨", "´",
                    ">", "< ", ";", ",", ":",
                    ".", " "),
                '',
                $fechanow
            );
            $ruta = "photos/qr" . '/' . $namear . ".png";
            $file = $imageDirectory . $namear . ".png";
            $qr->qrCode(500,$file);
            $ticketsController->insert($ruta);
            $ticket = $ticketsController->search($ruta);
            $buyController->insert($ticket,$user->getID(),$fechanow);
            $url = URl;
            unset($_SESSION['CarritoList']);
            $compra=true;
        }
        require (ROOT . 'views/checkout.php');
    }
}
?>
