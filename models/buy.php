<?php namespace models;
class Buy {
    private $date;
    private $client;
    private $id;
    function __construct($date, $client, $id = '') {
        $this->id = $id;
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
}
?>
