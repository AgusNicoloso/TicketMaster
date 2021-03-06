<?php
namespace daos\databases;
use daos\daoList\idao as IDao;
use daos\daoList\Singleton as SingletonDao;
use daos\databases\Connection as Connection;
use models\Category as Category;
class categoryDB extends SingletonDao implements IDao {
    function __construct() {
    }
    public function create($calendar) {
        $sql = "INSERT INTO categorias (category_name)VALUES (:category_name)";
        $parameters['category_name'] = $calendar->getCategoryName();
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
    public function read($id_category) {
        $sql = "SELECT * FROM categorias where id_category = :id_category";
        $parameters['id_category'] = $id_category;
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
        $sql = "SELECT * FROM categorias";
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
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
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
            return new Category($p['category_name'], $p['id_category']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
}
