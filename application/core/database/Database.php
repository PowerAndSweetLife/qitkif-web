<?php

class Database{

    private static $instance;
    private $pdo;

    const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    public function __construct($config = null)
    {
        if($config === null)
        {
            $config = require "dbConfig.php";
        }
        $dns = 'mysql:host='. $config["db_host"] .';port='. $config["db_port"] .';dbname=' . $config["db_name"];
        try {
            $this->pdo = new PDO($dns, $config["db_user"], $config["db_password"],self::OPTIONS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            $config = require "dbConfig.php";
            self::$instance = new self($config);
        }
        return self::$instance;
    }
    public function getConnection()
    {
        return $this->pdo;
    }

}
