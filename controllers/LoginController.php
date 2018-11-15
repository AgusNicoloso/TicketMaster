<?php namespace controllers;


use models\user as User;
class LoginController {
    public function __construct() {
    }
    public function index() {
    
        require (ROOT . "Views/login.php");
    }
    public function log() {
    }
    public function logout() {
        if ($_POST) {
            if (isset($_POST['cs'])) {
                session_destroy();
                header("Location:" . URl);
            }
        }
    }
    public function verify() {
        if ($_POST) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $user = new User("admin@admin", "admin", "Maximiliano Morales", "admin");
            $_SESSION['users'] = $user;
            $log = false;
            if (!isset($_SESSION['users'])) {
                echo "Usuario inexistente.";
            } else {
                $arrayusers[] = $_SESSION['users'];
                foreach ($arrayusers as $key => $value) {
                    if ($value->getMail() == $_POST['mail']) {
                        if ($value->getPass() == $_POST['pass']) {
                            $_SESSION['logued'] = $user;
                            $_SESSION['status'] = "on";
                            header("Location:" . URl);
                        } else {
                            $msg = "La contraseña es incorrecta.";
                            include (ROOT . "views/login.php");
                        }
                    } else {
                        $msg = "El mail es incorrecto.";
                        include (ROOT . "views/login.php");
                    }
                }
            }
        }
    }
}
