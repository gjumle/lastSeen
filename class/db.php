<?php

class DB {
    private $host = 'localhost';
    private $db = 'ls';
    private $user = 'lsa';
    private $pass = 'lsa';
    private $conn;
  
    public function __construct() {
      try {
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }
  
    public function connect() {
      return $this->conn;
    }
}
  