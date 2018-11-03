<?php namespace daos\databases;
use daos\daoList\idao as IDao;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use models\Artist as Artist;

class ArtistDB extends SingletonDao implements IDao {
    public function __construct() {
    }
    /*public function add($artistName) {
        $query = 'INSERT INTO artistas (artist_name) VALUES (:name)';
        $pdo = new Connection();
        $connection = $pdo->connect();
        $command = $connection->prepare($query);
        $command->bindParam(':name', $artistName);
        $command->execute();
        //return $pdo->lastInsertId();
    }*/
    public function create($artistName) {
        // Guardo como string la consulta sql utilizand o como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
        $sql = 'INSERT INTO artistas (artist_name) VALUES (:artist_name)';
        $parameters['artist_name'] = $artistName;
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
       header("Location:" . URl);
    }
    public function delete($name) {
        $query = 'DELETE FROM artists WHERE artist_name = :name';
        $pdo = new Connection();
        $connection = $pdo->Connect();
        $command = $connection->prepare($query);
        $command->bindParam(':name', $name);
        $resultDelete = $command->execute();
        return $resultDelete;
    }
    public function update($dato, $datoNuevo) {
        $query = 'UPDATE artists SET name = $datoNuevo WHERE name = $dato';
        $pdo = new Connection();
        $connection = $pdo->Connect();
        $command = $connection->prepare($query);
        $resultUpdate = $command->execute();
        return $resultUpdate;
    }
    public function retride() {
        $artistList = array();
        $query = 'SELECT * FROM artists';
        $pdo = Connection::getInstance();
        $pdo= $pdo->Connect();
        $command = $pdo->prepare($query);
        $command->execute();
        while ($result = $command->fetch()) {
            array_push($artistList, $result['artist_name']);
            var_dump($artistList);
        }
        return $artistList;
    }
    public function readAll() {
        $sql = "SELECT * FROM artistas";
        try {
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
    protected function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function ($p) {
            return new Artist($p['artist_name'],$p['id_artist']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
    public function save() {
        // TODO: Implement save() method.

    }
}
