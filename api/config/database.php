<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'rest_api_DB';
    private $username = 'root';
    private $password = 'dev01';
    private $charset = 'utf8';
    public $conn;

    public function __construct() {
        $this->getConnection();
    }

    public function getConnection() {
        $this->conn = null;

        $dsn = 'mysql:host='.$this->host.';dbname='.$this->db_name.';charset='.$this->charset;

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            echo "Connection error " . $e->getMessage();
        }

        return $this->conn;
    }
}