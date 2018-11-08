<?php
namespace controllers;
use daos\databases\Connection;
use models\user as User;
//use daos\daoList\userDB as Dao;
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
        if($_POST)
        {
            if(!isset($_SESSION['status'])){
                $_SESSION['status']="on";
            }
            $_SESSION['logued']=$user;
        }
    }
    public function logout() {
        if ($_POST) {
            if (isset($_POST['cs'])) {
                //unset($_SESSION['status']);
                //unset($_SESSION['logued']);
                session_destroy();
                header("Location:" . URl);
            }
        }
    }
    public function insert(){
        $us=new User($_POST['mail'],$_POST['pass'],$_POST['name'],"user");
        $this->dao->create($us);
    }
    public function searchUser(){
        $us=$this->dao->read($_POST['mail']);
        if($us)
        {

           if($us->getPass() == $_POST['pass'])
           {
               if(!isset($_SESSION)){
                   session_start();
               }
                $this->log($us);
               header('Location:'.URl);
           }
           else{
               $msg= 'Error, la password es incorrecta.';
               require("views/login.php");
           }
        }else{
            $msg= 'Error, el usuario no existe.';
            require("views/login.php");
        }
    }
    public function logverify()
    {
        if($this->dao->read($_POST['mail'])) {
            $msg="El usuario ya esta registrado.";
            require ("views/register.php");
        }
        else{
            $this->insert();

        }
    }
    public function islog(){
        if(!isset($_SESSION['status'])){
            return false;
        }
        else{
            return true;
        }
    }
    public function setOnLog()
    {
        $_SESSION['status']='on';
    }
    public function isFB()
    {
        if(isset($_SESSION['userData'])){
            return true;
        }else{
            return false;
        }
    }

    public function isAdmin($user){
        if($user->getRol()=='admin'){
            return true;
        }
        return false;
    }
}
