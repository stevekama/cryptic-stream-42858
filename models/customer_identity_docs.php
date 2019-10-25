<?php 
require_once('initialization.php');

class Customer_Identity_Doc_Types{
    //Decalare table name 
    private $conn;
    private $table_name = 'customer_identity_doc_types';
    //Declare class properties 
    public $id;
    public $identification_doc_type;
    public $created_date;
    public $created_user_id;
    public $edited_date;
    public $edited_user_id;
    
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
        $query .= "identification_doc_type, created_date, created_user_id, ";
        $query .= "edited_date, edited_user_id";
        $query .= ")VALUES(";
        $query .= ":cust_type, :created_date, :created_user_id, ";
        $query .= ":edited_date, :edited_user_id";
        $query .= ")";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->identification_doc_type = htmlentities($this->identification_doc_type);
        $this->created_date = htmlentities($this->created_date);
        $this->created_user_id = htmlentities($this->created_user_id);
        $this->edited_date = htmlentities($this->edited_date);
        $this->edited_user_id = htmlentities($this->edited_user_id);
        
        // Bind Data
        $stmt->bindParam(':identification_doc_type', $this->identification_doc_type);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':created_user_id', $this->created_user_id);
        $stmt->bindParam(':edited_date', $this->edited_date);
        $stmt->bindParam(':edited_user_id', $this->edited_user_id);
        
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

}