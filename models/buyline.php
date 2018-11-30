<?php namespace models;
class BuyLine {
    private $quantity;
    private $total_price;
    private $id_plaza_evento;
    private $id_buy;
    private $id_ticket;
    private $id;
    function __construct($quantity,$total_price,$id_plaza_evento,$id_buy,$id_ticket,$id='') {
        $this->quantity = $quantity;
        $this->total_price = $total_price;
        $this->id_plaza_evento = $id_plaza_evento;
        $this->id_buy = $id_buy;
        $this->id_ticket = $id_ticket;
        $this->id = $id;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function getTotal_price() {
        return $this->total_price;
    }
    public function getId_plaza_evento() {
        return $this->id_plaza_evento;
    }
    public function getId_buy() {
        return $this->id_buy;
    }
    public function getId_ticket() {
        return $this->id_ticket;
    }
    public function getId() {
        return $this->id;
    }
}
?>
