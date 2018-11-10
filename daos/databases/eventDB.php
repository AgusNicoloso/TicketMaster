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
            $category=$this->mapeoCategory($p['id_category']);
            return new Event($p['title_event'], $p['photo'], $category,$p['id_event']);
        }, $value);
        return count($resp) > 1 ? $resp : $resp['0'];
    }
    protected function mapeoCategory($id){
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
    }
    function add($artist) {
        // TODO: Implement add() method.

    }
    function save() {
        // TODO: Implement save() method.

    }
}
