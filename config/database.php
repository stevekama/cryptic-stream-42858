<?php 
class Database{
     private $host = 'us-cdbr-iron-east-02.cleardb.net';
     private $username = 'b23c5653b9b54b';
     private $password = 'e4b03cf3';
     private $dbname = 'heroku_bf3db7c0a0aaab6';
     private $conn;

     public function connect()
     {
          $this->conn = null;
          try{
               $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
               $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          }catch(PDOException $e){
               echo 'Connection Error: ' . $e->getMessage();
          }
          return $this->conn;
     }
}

$database = new Database();