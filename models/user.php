<?php namespace models;
class User {
    private $mail;
    private $pass;
    private $name;
    private $rol;
    private $id;
    public function __construct($mail, $pass, $name, $rol, $id = '') {
        $this->mail = $mail;
        $this->pass = $pass;
        $this->name = $name;
        $this->rol = $rol;
        $this->id = $id;
    }
    public function getMail() {
        return $this->mail;
    }
    public function getPass() {
        return $this->pass;
    }
    public function getName() {
        return $this->name;
    }
    public function getRol() {
        return $this->rol;
    }
    public function getID() {
        return $this->id;
    }
}
