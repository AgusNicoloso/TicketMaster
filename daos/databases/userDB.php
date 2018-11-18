<?php
namespace daos\databases;
use daos\daoList\Singleton as SingletonDao;
use daos\daoList\idao as idao;
use models\User as User;
class userDB extends SingletonDao implements idao {
    private $connection;
    function __construct() {
    }
    public function create($_user) {
        $sql = "INSERT INTO clientes (name,user,pass,rol)VALUES (:name, :user, :pass, :rol)";
        $parameters['name'] = $_user->getName();
        $parameters['user'] = $_user->getMail();
        $parameters['pass'] = $_user->getPass();
        $parameters['rol'] = $_user->getRol();
        try {
            $this->connection = Connection::getInstance();
            $this->connection->connect();
            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }
    public function read($user) {
        $sql = "SELECT * FROM clientes where user = :user";
        $parameters['user'] = $user;
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
    public function readBYID($id_client) {
        $sql = "SELECT * FROM clientes where id_client = :id_client";
        $parameters['id_client'] = $id_client;
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
    public function readAll() {
        $sql = "SELECT * FROM users";
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
    protected function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function ($p) {
            return new User($p['user'], $p['pass'], $p['name'], $p['rol'], $p['id_client']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
}
