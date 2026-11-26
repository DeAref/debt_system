<?php

class Database {
    private $host = 'localhost';
    private $user = 'ipir_debt';
    private $password = 'nqg[M0=g}Sr(';  
    private $db_name = 'ipir_debt';
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        if ($this->connection->connect_error) {
            die('Connection failed: ' . $this->connection->connect_error);
        }
        $this->connection->set_charset('utf8');
    }

    public function getConnection() {
        return $this->connection;
    }
}

?>