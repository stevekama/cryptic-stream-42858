<?php 
require_once('initialization.php');

class PayPalTransactions{
    //Decalare table name 
    private $conn;
    private $table_name = 'paypal_transactions';
    //Declare class properties 
    public $id;
    public $app_token;
    public $transaction_id;
    public $payment_amount;
    public $payment_status;
    public $invoice_id;
    public $transaction_date;
    public $user_id;

    //connect to db 
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function create()
    {
       $query = 'INSERT INTO '.$this->table_name.'(app_token, transaction_id, payment_amount, payment_status, invoice_id, transaction_date, user_id)VALUES(:app_token, :transaction_id, :payment_amount, :payment_status, :invoice_id, :transaction_date, :user_id)';

       //Prepare statement
       $stmt = $this->conn->prepare($query);

       //clean data 
       $this->app_token = htmlentities($this->app_token);
       $this->transaction_id = htmlentities($this->transaction_id);
       $this->payment_amount = htmlentities($this->payment_amount);
       $this->payment_status = htmlentities($this->payment_status);
       $this->invoice_id = htmlentities($this->invoice_id);
       $this->transaction_date = htmlentities($this->transaction_date);
       $this->user_id = htmlentities($this->user_id);
       
       //Bind Data
       $stmt->bindParam(':app_token', $this->app_token);
       $stmt->bindParam(':transaction_id', $this->transaction_id);
       $stmt->bindParam(':payment_amount', $this->payment_amount);
       $stmt->bindParam(':payment_status', $this->payment_status);
       $stmt->bindParam(':invoice_id', $this->invoice_id);
       $stmt->bindParam(':transaction_date', $this->transaction_date);
       $stmt->bindParam(':user_id', $this->user_id);
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

    // find transactions by user id 
    public function find_by_user_id($user_id = 0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE user_id = :user_id";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        //execute statement
        $stmt->execute(array('user_id'=>$user_id));
        
        //return statement 
        return $stmt;
    }

    // public function find_all()
    // {
    //     $query = "SELECT * FROM ".$this->table_name." ORDER BY id DESC";
        
    //     // Prepare statement
    //     $stmt = $this->conn->prepare($query);

    //     // Execute query
    //     $stmt->execute();

    //     return $stmt;
    // }
    
    // Delete
    public function delete() 
    {
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

        //print error 
        $error = new ErrorLogs();
        $error->errors = 'Error';
        $error->description = $stmt->error;
        if($error->create()){
            return false;
        }
    }
}