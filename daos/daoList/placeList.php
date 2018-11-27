<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 20/11/2018
 * Time: 23:29
 */

namespace daos\daoList;
use daos\daoList\Singleton as SingletonDao;

class placeList extends SingletonDao
{
    public function create($place) {
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['places'])){
            $a=array();
            if(is_array($_SESSION['places'])){
                foreach ($_SESSION['places'] as $key=>$value){
                    $a[]=$value;
                }
                $id=count($a)+1;
            }else{
                $a[]=$_SESSION['places'];
                $id=2;
            }
            $place->setId($id);
            $a[]=$place;
            $_SESSION['places']=$a;
        }else{
            $place->setId(1);
            $_SESSION['places']=$place;
        }



    }
    public function read($cat) {
        if(!isset($_SESSION['places'])){
            return false;
        }else{
            foreach ($_SESSION['places'] as $key=>$value){
                if ($value->getDescript() == $cat){
                    return true;
                }
            }
        }
        return false;

    }

    public function readAll() {

        if(isset($_SESSION['places'])){
            $a=$_SESSION['places'];
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