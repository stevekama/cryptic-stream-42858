<?php 
class Database{
     private $host = '34.215.237.227';
     private $username = 'api';
     private $password = '12345';
     private $dbname = 'cubes';
     private $driver;
     private $conn;

     public function connect()
     {
          $this->conn = null;
          try{
               $this->conn = new PDO('pgsql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
               $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          }catch(PDOException $e){
               echo 'Connection Error: ' . $e->getMessage();
          }
          return $this->conn;
     }
}

$database = new Database();