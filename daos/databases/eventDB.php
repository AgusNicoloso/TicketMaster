<?php
namespace daos\databases;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use daos\daoList\idao as idao;
use models\Event as Event;
use models\Category as Category;
class EventDB extends SingletonDao implements idao {
    private $connection;
    function __construct() {

    }
    /**
     *
     */
    public function create($_event) {
        // Guardo como string la consulta sql utilizand o como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
        $sql = "INSERT INTO eventos (title_event,photo,id_category)VALUES (:title_event, :photo,:id_category)";
        $parameters['title_event'] = $_event->getName();
        $parameters['photo'] = $_event->getPhoto();
        $parameters['id_category'] = $_event->getCategory();
        try {
            // creo la instancia connection
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            // Ejecuto la sentencia.
            //return $this->connection->ExecuteNonQuery($sql, $parameters);
            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }
    /**
     *
     */
    public function read($id) {
        $sql = "SELECT * FROM eventos where id_event = :id_event";
        $parameters['id_event'] = $id;
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql, $parameters);
        }
        catch(Exception $ex) {
            throw $ex;
        }
        if (!empty($resultSet)) return $this->mapear($resultSet);
        else return false;
    }
    /**
     *
     */
    public function maxId(){
        $sql = "select MAX(id_event) from eventos";

        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            throw $ex;
        }
        return $resultSet;
    }
    public function deleteId($id){
        $sql = "Delete from eventos where id_event= $id";
        $parameters['id_event'] = $id;
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            throw $ex;
        }
    }
    public function readAll() {
        try {
            $sql = "SELECT * FROM eventos";
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
        }
        if (!empty($resultSet)) return $this->mapear($resultSet);
        else return false;
    }
    public function readLimit($page,$id){
        try {
            $sql = "SELECT * FROM eventos WHERE id_category = $id limit $page,9";
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
        }
        if (!empty($resultSet)) return $this->mapear($resultSet);
        else return false;
    }
    public function readLimitAll($page){
        try {
            $sql = "SELECT * FROM eventos limit $page,9";
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
        }
        if (!empty($resultSet)) return $this->mapear($resultSet);
        else return false;
    }
    public function readAllbyID($id){
        try {
            $sql = "SELECT * FROM eventos WHERE id_category = $id";
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
        }
        if (!empty($resultSet)) return $this->mapear($resultSet);
        else return false;
    }
    /**
     *
     */
    public function edit($event,$id) {
        $sql = "UPDATE eventos SET title_event = :title_event, photo = :photo, id_category = :id_category where id_event = $id";
        $parameters['title_event'] = $event->getName();
        $parameters['photo'] = $event->getPhoto();
        $parameters['id_category'] = $event->getCategory();
        try {
            // creo la instancia connection
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            // Ejecuto la sentencia.
            //return $this->connection->ExecuteNonQuery($sql, $parameters);
            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    /**
     *
     */
    public function update($value, $valiue) {
    }
    /**
     *
     */
    public function delete($id) {
        try {
            $sql = "DELETE FROM eventos WHERE id_event = $id";
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
        }
        if (!empty($resultSet)) return $this->mapear($resultSet);
        else return false;
    }
    /**
     * Transforma el listado de usuario en
     * objetos de la clase Usuario
     *
     * @param  Array $gente Listado de personas a transformar
     */
    protected function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function ($p) {
            //$category=$this->mapeoCategory($p['id_category']);
            $categorydb=new categoryDB();
            $category=$categorydb->read($p['id_category']);
            return new Event($p['title_event'], $p['photo'], $category,$p['id_event']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
    /*protected function mapeoCategory($id){
        $sql = "SELECT * FROM categorias where id_category=$id";
        try {
            $this->connection = Connection::getInstance();
            $value = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            throw $ex;
        }
        if (!empty($value)){
            $value = is_array($value) ? $value : [];
            $resp = array_map(function ($p) {
                return new Category($p['category_name'],$p['id_category']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
    }*/

    public function search($search) {
        try {
            $sql = "SELECT * FROM eventos WHERE title_event LIKE '%$search%'";
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
        }
        if (!empty($resultSet)) return $this->mapear($resultSet);
        else return false;
    }
    
}
