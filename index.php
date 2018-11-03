<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "config/constantes.php";
require_once "config/Autoload.php";
require_once "config/Request.php";
require_once "config/Router.php";
require_once "daos/daoList/Singleton.php";
use config\Autoload as Autoload;
use config\Router as Router;
use config\Request as Request;
use daos\daoList\Singleton as Singleton;
Autoload::start();
session_start();
Router::direccionar(new Request());
?>
