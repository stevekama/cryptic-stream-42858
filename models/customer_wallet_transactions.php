<?php 
require_once('initialization.php');

class Customer_Wallet_Transactions{
    //Decalare table name 
    private $conn;
    private $table_name = 'customer_wallet_transactions';
    
    //Declare class properties 
    public $id;
    public $user_id;
    public $customer_id;
    public $transaction_type;
    public $transaction_id;
    public $transaction_time;
    public $transaction_amount;
    public $business_shortcode;
    public $bill_refnumber;
    public $invoice_number;
    public $original_balance;
    public $third_party_transaction_id;
    public $msisdn;
    public $first_name;
    public $middle_name;
    public $last_name;

    //connect to db 
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function create()
    {
       $query = 'INSERT INTO '.$this->table_name.'(user_id, customer_id, transaction_type, transaction_id, transaction_time, transaction_amount, business_shortcode, bill_refnumber, invoice_number, original_balance, third_party_transaction_id, msisdn, first_name, middle_name, last_name)VALUES(:user_id, :customer_id, :transaction_type, :transaction_id, :transaction_time, :transaction_amount, :business_shortcode, :bill_refnumber, :invoice_number, :original_balance, :third_party_transaction_id, :msisdn, :first_name, :middle_name, :last_name)';  

       //Prepare statement
       $stmt = $this->conn->prepare($query);

       //clean data 
       $this->user_id = htmlentities($this->user_id);
       $this->customer_id = htmlentities($this->customer_id);
       $this->transaction_type = htmlentities($this->transaction_type);
       $this->transaction_id = htmlentities($this->transaction_id);
       $this->transaction_time = htmlentities($this->transaction_time);
       $this->transaction_amount = htmlentities($this->transaction_amount);
       $this->business_shortcode = htmlentities($this->business_shortcode);
       $this->bill_refnumber = htmlentities($this->bill_refnumber);
       $this->invoice_number = htmlentities($this->invoice_number);
       $this->original_balance = htmlentities($this->original_balance);
       $this->third_party_transaction_id = htmlentities($this->third_party_transaction_id);
       $this->msisdn = htmlentities($this->msisdn);
       $this->first_name = htmlentities($this->first_name);
       $this->middle_name = htmlentities($this->middle_name);
       $this->last_name = htmlentities($this->last_name);
       
       //Bind Data
       $stmt->bindParam(':user_id', $this->user_id);
       $stmt->bindParam(':customer_id', $this->customer_id);
       $stmt->bindParam(':transaction_type', $this->transaction_type);
       $stmt->bindParam(':transaction_id', $this->transaction_id);
       $stmt->bindParam(':transaction_time', $this->transaction_time);
       $stmt->bindParam(':transaction_amount', $this->transaction_amount);
       $stmt->bindParam(':business_shortcode', $this->business_shortcode);
       $stmt->bindParam(':bill_refnumber', $this->bill_refnumber);
       $stmt->bindParam(':invoice_number', $this->invoice_number);
       $stmt->bindParam(':original_balance', $this->original_balance);
       $stmt->bindParam(':third_party_transaction_id', $this->third_party_transaction_id);
       $stmt->bindParam(':msisdn', $this->msisdn);
       $stmt->bindParam(':first_name', $this->first_name);
       $stmt->bindParam(':middle_name', $this->middle_name);
       $stmt->bindParam(':last_name', $this->last_name);

       //Execute query 
       if($stmt->execute()){
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