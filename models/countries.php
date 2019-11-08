<?php 
require_once('initialization.php');

class Countries{
    //Decalare table name 
    private $conn;
    private $table_name = 'countries';
    //Declare class properties 
    public $id;
    public $country;
    public $country_code;
    
    //connect to db 
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function fetch_all(){
        $query = "SELECT * FROM usr.".$this->table_name." ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO usr.".$this->table_name."(";
        $query .= "country, country_code";
        $query .= ")VALUES(";
        $query .= ":country, :country_code";
        $query .= ")";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->country = htmlentities($this->country);
        $this->country_code = htmlentities($this->country_code);

        // Bind Data
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':country_code', $this->country_code);
        
        //Execute query 
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
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

    public function fetch_by_id($id = ""){
        $query = "SELECT * FROM usr.".$this->table_name." WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('id'=>$id));
        $count = $stmt->rowCount();
        if($count > 0){
            $country = $stmt->fetch(PDO::FETCH_ASSOC);
            return $country;
        }else{
            return false;
        }
    }
}