<?php

class Database{

 	private $dbHost;

    private $dbUser;

    private $dbPass;

    private $dbName;

    public $connection;

    public static $db_obj;

    public function __construct() {

        $this->dbHost = DB_HOST;

        $this->dbUser = DB_USER;

        $this->dbPass = DB_PASSWORD;

        $this->dbName = DB_NAME;

        $dsn = "mysql:host=$this->dbHost;dbname=$this->dbName;charset=utf8mb4";


        if(empty(self::$db_obj)){
            self::$db_obj = new PDO($dsn, $this->dbUser, $this->dbPass);
        }
        $this->connection = self::$db_obj;
        //return $this->connection = new PDO($dsn, $this->dbUser, $this->dbPass);

        return $this->connection;

    }

}



?>