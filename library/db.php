<?php
class Database {
    private $host = "localhost";
    private $username = "ipir_debt";
    private $password = "nqg[M0=g}Sr(";
    private $dbname = "ipir_debt";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
            
            // Set charset to UTF-8
            $this->conn->set_charset("utf8");
        } catch (Exception $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function close() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>