<?php 
require_once('initialization.php');

class Utilities{
    //Decalare table name 
    private $conn;
    private $schema = 'api';
    private $table_name = 'utilities';
    
    //Declare class properties 
    public $id;
    public $utility;
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
            $query .= "INSERT INTO ".$this->schema.".".$this->table_name."(";
            $query .= "utility, created_date, created_user_id, ";
            $query .= "edited_date, edited_user_id";
            $query .= ")VALUES(";
            $query .= ":utility, :created_date, :created_user_id, ";
            $query .= ":edited_date, :edited_user_id";
            $query .= ")";
        }else{
            $query .= "UPDATE ".$this->schema.".".$this->table_name." SET ";
            $query .= "utility=:utility, created_date=:created_date, created_user_id=:created_user_id, ";
            $query .= "edited_date=:edited_date, edited_user_id=:edited_user_id ";
            $query .= "WHERE id=:id";
        }

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data 
        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->utility = htmlentities($this->utility);
        $this->created_date = htmlentities($this->created_date);
        $this->created_user_id = htmlentities($this->created_user_id);
        $this->edited_date = htmlentities($this->edited_date);
        $this->edited_user_id = htmlentities($this->edited_user_id);
        
        //Bind Data
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':utility', $this->utility);
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

    // find all utilities
    public function find_all(){
        $query = "SELECT * FROM ".$this->table_name." ORDER BY id DESC";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    /// find transactions by transaction id 
    public function find_by_utility_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('id'=>$id));
        $count = $stmt->rowCount();
        if($count > 0){
            $utility = $stmt->fetch(PDO::FETCH_ASSOC);
            return $utility;
        }else{
            return false;
        }
    }

    // Delete
    public function delete(){
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }
    }
}