<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 20/11/2018
 * Time: 20:17
 */

namespace daos\daoList;
use daos\daoList\Singleton as SingletonDao;


class categoryList extends SingletonDao
{

    public function create($category) {
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['category'])){
            $a=array();
            if(is_array($_SESSION['category'])){
                foreach ($_SESSION['category'] as $key=>$value){
                    $a[]=$value;
                }
                $id=count($a)+1;
            }else{
                $a[]=$_SESSION['category'];
                $id=2;
            }
            $category->setId($id);
            $a[]=$category;
            $_SESSION['category']=$a;
        }else{
            $category->setId(1);
            $_SESSION['category']=$category;
        }



    }
    public function read($cat) {
        if(!isset($_SESSION['category'])){
            return false;
        }else{
            foreach ($_SESSION['category'] as $key=>$value){
                if ($value->getCategoryName() == $cat){
                    return true;
                }
            }
        }
        return false;

    }

    public function readAll() {

        if(isset($_SESSION['category'])){
            $a=$_SESSION['category'];
        }else{
            $a=null;
        }
        return $a;
    }

    public function edit($_user) {

    }
    public function update($value, $valiue) {
    }
    public function delete($email) {

    }

}