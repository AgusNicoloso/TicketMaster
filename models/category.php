<?php
namespace models;
class Category {
    private $id;
    private $category_name;
    public function __construct($category = '', $id = '') {
        $this->id = $id;
        $this->category_name = $category;
    }
    public function getCategoryName() {
        return $this->category_name;
    }
    public function setCategoryName($category_name) {
        $this->category_name = $category_name;
    }
    public function getID() {
        return $this->id;
    }
}
