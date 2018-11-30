<?php
namespace daos\databases;
use daos\daoList\idao as IDao;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use models\seat as Seat;
class seatDB extends SingletonDao implements IDao {
    function __construct() {
    }
    public function create($seat) {
        $sql = "INSERT INTO tipo_plaza (descript) VALUES (:descript)";
        $parameters['descript'] = $seat->getDescript();
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
        header("Location:" . URl);
    }
    public function seatbyid($id) {
        $sql = "SELECT * FROM tipo_plaza where id_tipo_plaza = $id";
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
    public function read($seat_descript) {
        $sql = "SELECT * FROM tipo_plaza where descript = :descript";
        $parameters['descript'] = $seat_descript;
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
    public function mapeoSeat($id)
    {
        $sql = "SELECT * FROM tipo_plaza t where t.id_tipo_plaza = $id ";
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
                return new Seat($p['descript'], $p['id_tipo_plaza']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
    }
    public function readAll() {
        $sql = "SELECT * FROM tipo_plaza";
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
    public function update($value, $valiue) {
    }
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
    protected function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function ($p) {
            return new Seat($p['descript'], $p['id_tipo_plaza']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
}
