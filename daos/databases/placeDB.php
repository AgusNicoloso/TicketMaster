<?php
namespace daos\databases;
use daos\daoList\idao as IDao;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use models\Place as Place;
class placeDB extends SingletonDao implements IDao {
    function __construct() {
    }
    /**
     *
     */
    public function create($place) {
        // Guardo como string la consulta sql utilizand o como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
        $sql = "INSERT INTO lugares_eventos (place_name,capacity) VALUES (:place_name,:capacity)";
        $parameters['place_name'] = $place->getPlace();
        $parameters['capacity'] = $place->getCapacity();
        try {
            // creo la instancia connection
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            // Ejecuto la sentencia.
            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
        // header("Location:" . URl);
        
    }
    public function readId($id) {
        $sql = "SELECT * FROM lugares_eventos where id_place=$id";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $resultSet = $this->connection->execute($sql);
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
    public function read($place_name) {
        $sql = "SELECT * FROM lugares_eventos where place_name = :place_name";
        $parameters['place_name'] = $place_name;
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
    public function readAll() {
        $sql = "SELECT * FROM lugares_eventos";
        try {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql);
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
   
    /**
     *
     */
    public function update($value, $valiue) {
    }
    /**
     *
     */
    public function delete($email) {
        /*$sql = "DELETE FROM usuarios WHERE email = :email";
        
        $obj_pdo = new Conexion();
        
        try {
             $conexion = $obj_pdo->conectar();
        
         // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
         $sentencia = $conexion->prepare($sql);
        
             $sentencia->bindParam(":email", $email);
        
             $sentencia->execute();
        
        
        } catch(PDOException $Exception) {
        
         throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        
        }*/
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
            return new Place($p['id_place'], $p['place_name'], $p['capacity']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
    function add($artist) {
        // TODO: Implement add() method.
        
    }
    function save() {
        // TODO: Implement save() method.
        
    }
}
