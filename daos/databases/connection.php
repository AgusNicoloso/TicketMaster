<?php namespace daos\databases;
class Connection {
    private $pdo = null;
    private $pdoStatement = null;
    private static $instance = null;
    function __construct() {
    }
    public function connect() {
        try {
            $this->pdo = new \PDO("mysql:host=" . HOST . "; dbname=" . DB, USER, PASS);
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            throw $e;
        }
    }
    public static function getInstance() {
        if (self::$instance == null) self::$instance = new Connection();
        return self::$instance;
    }
    public function execute($query, $parameters = array()) {
        try {
            $this->pdoStatement = $this->pdo->prepare($query);
            foreach ($parameters as $parameterName => $value) {
                $this->pdoStatement->bindParam(":" . $parameterName, $value);
            }
            $this->pdoStatement->execute();
            return $this->pdoStatement->fetchAll();
        }
        catch(Exception $ex) {
            throw $ex;
        }
    }
    public function executeNonQuery($query, $parameters = array()) {
        try {
            $this->pdoStatement = $this->pdo->prepare($query);
            foreach ($parameters as $parameterName => $value) {
                $this->pdoStatement->bindParam(":$parameterName", $parameters[$parameterName]);
            }
            $this->pdoStatement->execute();
            return $this->pdoStatement->rowCount();
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }
}
?>
