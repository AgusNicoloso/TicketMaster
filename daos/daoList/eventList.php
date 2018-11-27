<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 21/11/2018
 * Time: 08:20
 */

namespace daos\daoList;
use daos\daoList\Singleton as SingletonDao;

class eventList extends SingletonDao
{
    public function create($event) {
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['events'])){
            $a=array();
            if(is_array($_SESSION['events'])){
                foreach ($_SESSION['events'] as $key=>$value){
                    $a[]=$value;
                }
                $id=count($a)+1;
            }else{
                $a[]=$_SESSION['events'];
                $id=2;
            }
            $event->setId($id);
            $a[]=$event;
            $_SESSION['events']=$a;
        }else{
            $event->setId(1);
            $_SESSION['events']=$event;
        }



    }
    public function read($cat) {
        if(!isset($_SESSION['events'])){
            return false;
        }else{
            foreach ($_SESSION['events'] as $key=>$value){
                if ($value->getCategoryName() == $cat){
                    return true;
                }
            }
        }
        return false;

    }
    public function readLimitAll($page) {
        if(isset($_SESSION['events'])){
            $a=$_SESSION['events'];
        }else{
            $a=null;
        }
        return $a;
    }
    public function readAll() {

        if(isset($_SESSION['events'])){
            $a=$_SESSION['events'];
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