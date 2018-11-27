<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 23/11/2018
 * Time: 10:11
 */

namespace daos\daoList;
use daos\daoList\Singleton as SingletonDao;

use models\Artist;

class artistList extends SingletonDao
{
    public function create($nombre) {
        if(!isset($_SESSION)){
            session_start();
        }
        $artist=new Artist($nombre);
        if(isset($_SESSION['artists'])){
            $a=array();
            if(is_array($_SESSION['artists'])){
                foreach ($_SESSION['artists'] as $key=>$value){
                    $a[]=$value;
                }
                $id=count($a)+1;
            }else{
                $a[]=$_SESSION['artists'];
                $id=2;
            }
            $artist->setId($id);
            $a[]=$artist;
            $_SESSION['artists']=$a;
        }else{
            $artist->setId(1);
            $_SESSION['artists']=$artist;
        }



    }
    public function read($cat) {
        if(!isset($_SESSION['artists'])){
            return false;
        }else{
            foreach ($_SESSION['artists'] as $key=>$value){
                if ($value->getName() == $cat){
                    return true;
                }
            }
        }
        return false;

    }

    public function readAll() {

        if(isset($_SESSION['artists'])){
            $a=$_SESSION['artists'];
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