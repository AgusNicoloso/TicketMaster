<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 20/11/2018
 * Time: 23:12
 */

namespace daos\daoList;
use daos\daoList\Singleton as SingletonDao;


class seatList extends SingletonDao
{
    public function create($seat) {
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['seats'])){
            $a=array();
            if(is_array($_SESSION['seats'])){
                foreach ($_SESSION['seats'] as $key=>$value){
                    $a[]=$value;
                }
                $id=count($a)+1;
            }else{
                $a[]=$_SESSION['seats'];
                $id=2;
            }
            $seat->setId($id);
            $a[]=$seat;
            $_SESSION['seats']=$a;
        }else{
            $seat->setId(1);
            $_SESSION['seats']=$seat;
        }



    }
    public function read($cat) {
        if(!isset($_SESSION['seats'])){
            return false;
        }else{
            foreach ($_SESSION['seats'] as $key=>$value){
                if ($value->getDescript() == $cat){
                    return true;
                }
            }
        }
        return false;

    }

    public function readAll() {

        if(isset($_SESSION['seats'])){
            $a=$_SESSION['seats'];
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