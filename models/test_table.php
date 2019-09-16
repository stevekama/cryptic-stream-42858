<?php 
require_once('initialization.php');

class TestTable{
    //Decalare table name 
    private $conn;
    private $table_name = 'test_table';
    //Declare class properties 
    public $id;
    public $json_data;

    //connect to db 
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function create()
    {
       $query = 'INSERT INTO '.$this->table_name.'(json_data)VALUES(:json_data)';  

       //Prepare statement
       $stmt = $this->conn->prepare($query);

       //clean data 
       $this->json_data = htmlentities($this->json_data);

       //Bind Data
       $stmt->bindParam(':json_data', $this->json_data);
       
       //Execute query 
       if($stmt->execute()){
           return true;
       }
       //print error 
       $error = new ErrorLogs();
       $error->errors = $stmt->error;
       $error->description = $stmt->error;
       if($error->create()){
            return false;
       }
    }

}