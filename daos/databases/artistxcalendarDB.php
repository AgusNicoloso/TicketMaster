<?php
namespace daos\databases;
use daos\daoList\idao as IDao;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use models\Artist as Artist;
class artistxcalendarDB extends SingletonDao implements IDao {
    public function __construct() {
    }
    public function create($param) {
     $sql = "INSERT INTO artistas_x_calendarios (id_calendar,id_artist)VALUES (:id_calendar,:id_artist)";
        $parameters['id_calendar'] = $param->getIdCalendar();
        $parameters['id_artist'] = $param->getIdArtist();
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }
    public function mapeoART($id) {
        $sql = "
        SELECT * FROM artistas_x_calendarios axc inner join artistas a on axc.id_artist = a.id_artist where axc.id_calendar=$id ";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $value = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            throw $ex;
        }
        if (!empty($value)) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function ($p) {
                return new Artist($p['artist_name']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
    }
    function delete($nombre) {
    }
    function update($dato, $datonuevo) { 
    }
}
