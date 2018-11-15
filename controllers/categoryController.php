<?php
namespace controllers;
use daos\databases\categoryDB as Dao;
use models\Category;
class CategoryController {
    protected $dao;
    public function __construct() {
        $this->dao = dao::getInstance();
    }
    public function index() {
        require ('views/category.php');
    }
    public function addCategory($category_name) {
        if ($this->dao->read($category_name)) {
            $msg = "La categoria ya existe.";
            require ("views/category.php");
        } else {
            $category = new Category($category_name);
            $this->dao->create($category);     
        }
    }
    public function home() {
        header("Location:" . URl);
    }
    public function getAll() {
        return $this->dao->readAll();
    }
    public function see($id) {
        $this->viewEventbyCategory($id);
    }
    public function viewEventbyCategory($id) {
        $controllercategory = new \controllers\categoryController();
        $dbevents = new \controllers\EventController();
        $pageaux = 0;
        $page = 1;
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            if ($page == "1") {
                $pageaux = 0;
            } else {
                $pageaux = ($page * 9) - 9;
            }
        }
        $count = 0;
        include (ROOT . 'views/eventbycategory.php');
    }
}
