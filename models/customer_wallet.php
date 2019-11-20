<?php 
require_once('initialization.php');

class Customer_Wallet{
    //Decalare table name 
    private $conn;
    private $table_name = 'customer_wallet';
    //Declare class properties 
    public $id;
    public $user_id;
    public $customer_id;
    public $amount;
    public $phone_number;
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

    public function fetch_wallet_for_customer($customer_id = ""){
        $query = "SELECT * FROM api.".$this->table_name." WHERE customer_id = :customer_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array('customer_id'=>$customer_id))){
            // count row 
            $count = $stmt->rowCount();
            if($count > 0){
                $wallet = $stmt->fetch(PDO::FETCH_ASSOC);
                return $wallet;
            }else{
                return false;
            }

        }
    }

    public function create()
    {
        $query = "INSERT INTO api.".$this->table_name."(";
        $query .= "user_id, customer_id, amount, phone_number, ";
        $query .= "created_date, created_user_id, edited_date, edited_user_id";
        $query .= ")VALUES(";
        $query .= ":user_id, :customer_id, :amount, :phone_number, ";
        $query .= ":created_date, :created_user_id, :edited_date, :edited_user_id";
        $query .= ")";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->user_id = htmlentities($this->user_id);
        $this->customer_id = htmlentities($this->customer_id);
        $this->amount = htmlentities($this->amount);
        $this->phone_number = htmlentities($this->phone_number);
        $this->created_date = htmlentities($this->created_date);
        $this->created_user_id = htmlentities($this->created_user_id);
        $this->edited_date = htmlentities($this->edited_date);
        $this->edited_user_id = htmlentities($this->edited_user_id);

        // Bind Data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':phone_number', $this->phone_number);
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
        $query = "SELECT * FROM api.".$this->table_name." WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('id'=>$id));
        $count = $stmt->rowCount();
        if($count > 0){
            $wallet = $stmt->fetch(PDO::FETCH_ASSOC);
            return $wallet;
        }else{
            return false;
        }
    }

}