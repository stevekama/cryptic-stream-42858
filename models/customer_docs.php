<?php 
require_once('initialization.php');

class Customer_Docs{
    //Decalare table name 
    private $conn;
    private $table_name = 'customer_docs';
    //Declare class properties 
    public $id;
    public $customer_id;
    public $customer_identity_doc_type_id;
    public $identification_doc;
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

    public function fetch_by_customer_id(){
        $query = "SELECT * FROM usr.".$this->table_name." WHERE customer_id = :customer_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        // clean statement
        $this->customer_id = htmlentities($this->customer_id);

        //bind statement
        $stmt->bindParam(':customer_id', $this->customer_id);

        if($stmt->execute()){
            return $stmt;
        }
    }

    public function create()
    {
        $query = "INSERT INTO usr.".$this->table_name."(";
        $query .= "customer_id, customer_identity_doc_type_id, identification_doc, ";
        $query .= "created_date, created_user_id, edited_date, edited_user_id";
        $query .= ")VALUES(";
        $query .= ":customer_id, :customer_identity_doc_type_id, :identification_doc, ";
        $query .= ":created_date, :created_user_id, :edited_date, :edited_user_id";
        $query .= ")";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->customer_id = htmlentities($this->customer_id);
        $this->customer_identity_doc_type_id = htmlentities($this->customer_identity_doc_type_id);
        $this->identification_doc = htmlentities($this->identification_doc);
        $this->created_date = htmlentities($this->created_date);
        $this->created_user_id = htmlentities($this->created_user_id);
        $this->edited_date = htmlentities($this->edited_date);
        $this->edited_user_id = htmlentities($this->edited_user_id);

        // Bind Data
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':customer_identity_doc_type_id', $this->customer_identity_doc_type_id);
        $stmt->bindParam(':identification_doc', $this->identification_doc);
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

    public function fetch_by_id($id = ""){
        $query = "SELECT * FROM usr.".$this->table_name." WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('id'=>$id));
        $count = $stmt->rowCount();
        if($count > 0){
            $customer_doc = $stmt->fetch(PDO::FETCH_ASSOC);
            return $customer_doccustomer_doc;
        }else{
            return false;
        }
    }

}