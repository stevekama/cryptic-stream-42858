<?php 
require_once('initialization.php');

class Customer_Wallet_Balance_Movement{
    //Decalare table name 
    private $conn;
    private $table_name = 'customer_wallet_balance_movement';
    //Declare class properties 
    public $id;
    public $user_id;
    public $customer_id;
    public $initial_balance;
    public $updated_amount;
    public $current_balance;
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
        $query = "SELECT * FROM api.".$this->table_name." WHERE customer_id = :customer_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $customer_id = htmlentities($customer_id);
        if($stmt->execute(array('customer_id'=>$customer_id))){
            return $stmt;
        }
    }

    public function create()
    {
        $query = "INSERT INTO api.".$this->table_name."(";
        $query .= "user_id, customer_id, initial_balance, updated_amount, current_balance, ";
        $query .= "created_date, created_user_id, edited_date, edited_user_id";
        $query .= ")VALUES(";
        $query .= ":user_id, :customer_id, :initial_balance, :updated_amount, :current_balance, ";
        $query .= ":created_date, :created_user_id, :edited_date, :edited_user_id";
        $query .= ")";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->user_id = htmlentities($this->user_id);
        $this->customer_id = htmlentities($this->customer_id);
        $this->initial_balance = htmlentities($this->initial_balance);
        $this->updated_amount = htmlentities($this->updated_amount);
        $this->current_balance = htmlentities($this->current_balance);
        $this->created_date = htmlentities($this->created_date);
        $this->created_user_id = htmlentities($this->created_user_id);
        $this->edited_date = htmlentities($this->edited_date);
        $this->edited_user_id = htmlentities($this->edited_user_id);

        // Bind Data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':initial_balance', $this->initial_balance);
        $stmt->bindParam(':updated_amount', $this->updated_amount);
        $stmt->bindParam(':current_balance', $this->current_balance);
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