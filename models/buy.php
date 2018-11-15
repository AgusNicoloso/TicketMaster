<?php namespace models;
class Buy {
    private $date;
    private $client;
    private $id;
    private $ticket;
    function __construct($ticket, $client, $date = '', $id = '') {
        $this->id = $id;
        $this->ticket = $ticket;
        $this->date = $date;
        $this->client = $client;
    }
    public function getDate() {
        return $this->date;
    }
    public function getClient() {
        return $this->client;
    }
    public function getID() {
        return $this->id;
    }
    public function getTicket() {
        return $this->ticket;
    }
}
?>
