<?php 
require_once('initialization.php');

class CustomerWalletPayPal{
    //Decalare table name 
    private $conn;
    private $table_name = 'customer_wallet_paypal';
    //Declare class properties 
    public $id;
    public $user_id;
    public $customer_id;
    public $transaction_id;
    public $payment_amount;
    public $payment_status;
    public $invoice_id;
    public $transaction_date;

    //connect to db 
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function create()
    {
       $query = "INSERT INTO api.".$this->table_name."(";
       $query .= "user_id, customer_id, transaction_id, payment_amount, ";
       $query .= "payment_status, invoice_id, transaction_date";
       $query .= ")VALUES(";
       $query .= ":user_id, :customer_id, :transaction_id, :payment_amount, ";
       $query .= ":payment_status, :invoice_id, :transaction_date";
       $query .= ")";

       //Prepare statement
       $stmt = $this->conn->prepare($query);

       //clean data 
       $this->user_id = htmlentities($this->user_id);
       $this->customer_id = htmlentities($this->customer_id);
       $this->transaction_id = htmlentities($this->transaction_id);
       $this->payment_amount = htmlentities($this->payment_amount);
       $this->payment_status = htmlentities($this->payment_status);
       $this->invoice_id = htmlentities($this->invoice_id);
       $this->transaction_date = htmlentities($this->transaction_date);

       //Bind Data
       $stmt->bindParam(':user_id', $this->user_id);
       $stmt->bindParam(':customer_id', $this->customer_id);
       $stmt->bindParam(':transaction_id', $this->transaction_id);
       $stmt->bindParam(':payment_amount', $this->payment_amount);
       $stmt->bindParam(':payment_status', $this->payment_status);
       $stmt->bindParam(':invoice_id', $this->invoice_id);
       $stmt->bindParam(':transaction_date', $this->transaction_date);
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

    public function find_all_by_customer_id($customer_id = 0)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE customer_id = :customer_id ORDER BY id DESC";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute(array('customer_id'=>$customer_id));

        return $stmt;
    }
    
}