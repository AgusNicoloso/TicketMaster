<?php
namespace daos\databases;
use daos\daoList\Singleton as SingletonDao;
use daos\daoList\idao as idao;
use models\User as User;
class userDB extends SingletonDao implements idao {
    private $connection;
    function __construct() {
    }
    /**
     *
     */
    public function create($_user) {
        // Guardo como string la consulta sql utilizand o como values, marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada
        $sql = "INSERT INTO clientes (name,user,pass,rol)VALUES (:name, :user, :pass, :rol)";
        $parameters['name'] = $_user->getName();
        $parameters['user'] = $_user->getMail();
        $parameters['pass'] = $_user->getPass();
        $parameters['rol'] = $_user->getRol();
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
    /**
     *
     */
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
    /**
     *
     */
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
            return new User($p['user'], $p['pass'], $p['name'], $p['rol']);
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
