<?php 
require_once('initialization.php');

class Payment_Methods{
    //Decalare table name 
    private $conn;
    private $table_name = 'payment_methods';
    private $schemma = 'api';
    //Declare class properties 
    public $id;
    public $method;
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


    public function save()
    {
        $query = "";
        if(empty($this->id)){
            $query .= "INSERT INTO ".$this->schemma.".".$this->table_name."(";
            $query .= "method, created_date, ";
            $query .= "created_date_user_id, edited_date, ";
            $query .= "edited_user_id";
            $query .= ")VALUES(";
            $query .= ":method, :created_date, ";
            $query .= ":created_date_user_id, :edited_date, ";
            $query .= ":edited_user_id";
            $query .= ")";  
        }else{
            $query .= "UPDATE ".$this->schemma.".".$this->table_name." SET ";
            $query .= "method=:method, created_date=:created_date, ";
            $query .= "created_date_user_id=:created_date_user_id, edited_date=:edited_date, ";
            $query .= "edited_user_id=:edited_user_id ";
            $query .= "WHERE id=:id";
        }

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data 
        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->method = htmlentities($this->method);
        $this->created_date = htmlentities($this->created_date);
        $this->created_user_id = htmlentities($this->created_user_id);
        $this->edited_date = htmlentities($this->edited_date);
        $this->edited_user_id = htmlentities($this->edited_user_id);
    
        //Bind Data
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':method', $this->method);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':created_user_id', $this->created_user_id);
        $stmt->bindParam(':edited_date', $this->edited_date);
        $stmt->bindParam(':edited_user_id', $this->edited_user_id);

        //Execute query 
        if($stmt->execute()){
            if(empty($this->id)){
                $this->id = $this->conn->lastInsertId();
            }
            return true;
        }
      
    }
    
    public function find_all_methods()
    {
        $query = "SELECT * FROM ".$this->schemma.".".$this->table_name." ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return $stmt;
        }else{
            return false;
        }

    }
}