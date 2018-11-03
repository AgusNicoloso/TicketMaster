<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 22/10/2018
 * Time: 23:37
 */

namespace models;


class Category
{

    private $id;
    private $category_name;
    public function __construct($category='',$id='')
    {
        $this->id=$id;
        $this->category_name=$category;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param string $category_name
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }
    public function getID(){
        return $this->id;
    }



}
