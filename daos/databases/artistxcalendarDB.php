<?php
/**
 * Created by PhpStorm.
 * User: maxuu
 * Date: 2/11/2018
 * Time: 11:32
 */

namespace daos\databases;
use daos\daoList\idao as IDao;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use models\Artist as Artist;

class artistxcalendarDB extends SingletonDao implements IDao
{

    /**
     * artistxcalendarDB constructor.
     */
    public function __construct()
    {
    }
    public function create($param) {
        // Guardo como string la consulta sql utilizand o como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
        $sql = "INSERT INTO artistas_x_calendarios (id_calendar,id_artist)VALUES (:id_calendar,:id_artist)";
        $parameters['id_calendar'] = $param->getIdCalendar();
        $parameters['id_artist'] = $param->getIdArtist();
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
    public function mapeoART($id)
    {
        $sql = "
		SELECT * FROM artistas_x_calendarios axc inner join artistas a on axc.id_artist = a.id_artist where axc.id_calendar=$id ";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $value = $this->connection->execute($sql);
        } catch (Exception $ex) {
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
    function add($artist)
    {
        // TODO: Implement add() method.
    }

    function delete($nombre)
    {
        // TODO: Implement delete() method.
    }

    function update($dato, $datonuevo)
    {
        // TODO: Implement update() method.
    }

    function save()
    {
        // TODO: Implement save() method.
    }

}