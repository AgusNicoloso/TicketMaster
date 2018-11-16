<?php
namespace controllers;
use daos\databases\Connection;
use models\user as User;
use daos\databases\userDB as dao;
class UserController {
    protected $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        require (ROOT . "Views/register.php");
    }
    public function log($user) {
        if ($_POST) {
            if (!isset($_SESSION['status'])) {
                $_SESSION['status'] = "on";
            }
            $_SESSION['logued'] = $user;
        }
    }
    public function logout($cs) {
        
            if (isset($cs)) {
                session_destroy();
                header("Location:" . URl);
            }
    }
    public function insert($name,$mail,$pass) {
        $us = new User($mail, $pass, $name, "user");
        $this->dao->create($us);
    }
    public function searchUser($mail,$pass) {
        $us = $this->dao->read($mail);
        if ($us) {
            if ($us->getPass() == $pass) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $this->log($us);
                header('Location:' . URl);
            } else {
                $msg = 'Error, la password es incorrecta.';
                require ("views/login.php");
            }
        } else {
            $msg = 'Error, el usuario no existe.';
            require ("views/login.php");
        }
    }
    public function logverify($name,$mail,$pass) {
        if ($this->dao->read($mail)) {
            $msg = "El usuario ya esta registrado.";
            require ("views/register.php");
        } else {
            $this->insert($name,$mail,$pass);
        }
    }
    public function islog() {
        if (!isset($_SESSION['status'])) {
            return false;
        } else {
            return true;
        }
    }
    public function setOnLog() {
        $_SESSION['status'] = 'on';
    }
    public function isFB() {
        if (isset($_SESSION['userData'])) {
            return true;
        } else {
            return false;
        }
    }
    public function isAdmin($user) {
        if ($user->getRol() == 'admin') {
            return true;
        }
        return false;
    }
    public function search($user) {
        return $this->dao->read($user);
    }
}
