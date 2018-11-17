<?php
namespace daos\databases;
use daos\daoList\idao as IDao;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use models\EventPlace as EventPlace;
use models\Seat;
class eventplaceDB extends SingletonDao implements IDao {
    private $connection;
    function __construct() {
    }
    /**
     *
     */
    public function create($eventplace, $idSeat, $idcalendar) {
        // Guardo como string la consulta sql utilizand o como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
        $sql = "INSERT INTO plaza_eventos (quantity,available,price,id_tipo_plaza,id_calendar) VALUES (:quantity,:available,:price,:id_tipo_plaza,:id_calendar)";
        $parameters['quantity'] = $eventplace->getQuantity();
        $parameters['available'] = $eventplace->getQuantity();
        $parameters['price'] = $eventplace->getPrice();
        $parameters['id_tipo_plaza'] = $idSeat;
        $parameters['id_calendar'] = $idcalendar;
        print_r($parameters);
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
        // header("Location:" . URl);
        
    }
    /**
     *
     */
    public function read($id_plaza_evento) {
        $sql = "SELECT * FROM plaza_eventos where id_plaza_evento = $id_plaza_evento";

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
    public function readAll() {
        $sql = "SELECT * FROM plaza_eventos";
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
    public function lastId() {
        $sql = "SELECT MAX(id_plaza_evento) FROM plaza_eventos";
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
    /**
     *
     */
    public function edit($_user) {
        $sql = "UPDATE users SET name = :name, surname = :surname, nationality = :nationality, state = :state, city = :city, birthdate = :birthdate, email = :email, password = :password, avatar = :avatar, role = :role";
        $parameters['name'] = $_user->getName();
        $parameters['surname'] = $_user->getSurname();
        $parameters['nationality'] = $_user->getNationality();
        $parameters['state'] = $_user->getState();
        $parameters['city'] = $_user->getCity();
        $parameters['birthdate'] = $_user->getBirthdate();
        $parameters['email'] = $_user->getEmail();
        $parameters['pass'] = $_user->getPass();
        $parameters['avatar'] = $_user->getAvatar() ['avatar']['name'];
        $parameters['role'] = $_user->getRole();
        try {
            // creo la instancia connection
            $this->connection = Connection::getInstance();
            // Ejecuto la sentencia.
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }
    /**
     *
     */
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
            //$seat=$this->mapeoSeat($p['id_tipo_plaza']);
            $seatdb = new seatDB();
            $seat = $seatdb->seatbyid($p['id_tipo_plaza']);
            return new EventPlace($p['quantity'], $p['price'], $seat, $p['available'], $p['id_plaza_evento']);
            // return new EventPlace($p['id_lugar_evento'],$p['quantity'],$p['available'],$p['price'],$p['id_tipo_plaza']);
            
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
    public function mapeoPlacetype($id)
    {
        $sql = "select * from plaza_eventos p where p.id_calendar=$id";
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
                $d_seat=new seatDB();
                $seat=$d_seat->mapeoSeat($p['id_tipo_plaza']);
                return new EventPlace($p['quantity'],$p['price'],$seat,$p['available'],$p['id_plaza_evento']);
            }, $value);
            return count($resp) > 1 ? $resp : $resp['0'];
        }
    }

    public function issetSeat() {
        $sql = "SELECT * FROM tipo_plaza";
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $value = $this->connection->execute($sql);
        }
        catch(Exception $ex) {
            echo $ex->getMessage();
        }
        if (!empty($value)) {
            return true;
        } else {
            return false;
        }
    }
}
