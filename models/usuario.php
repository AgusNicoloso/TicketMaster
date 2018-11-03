<?php namespace models;
class Usuario {
    private $mail;
    private $pass;
    private $name;
    private $rol;
    public function __construct($mail, $pass, $name, $rol) {
        $this->mail = $mail;
        $this->pass = $pass;
        $this->name = $name;
        $this->rol = $rol;
    }
    /**
     * @return mixed
     */
    public function getMail() {
        return $this->mail;
    }
    /**
     * @return mixed
     */
    public function getPass() {
        return $this->pass;
    }
    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }
    /**
     * @return mixed
     */
    public function getRol() {
        return $this->rol;
    }
}
