<?php 
require_once('initialization.php');

class Transactions{
    //Decalare table name 
    private $conn;
    private $table_name = 'transactions';
    
    //Declare class properties 
    public $id;
    public $app_token;
    public $transaction_id;
    public $transaction_time;
    public $product;
    public $transaction_amount;
    public $transaction_currency;
    public $transaction_method;
    public $transaction_status;
    public $user_id;

    //connect to db 
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function create()
    {
       $query = 'INSERT INTO '.$this->table_name.'(app_token, transaction_id, transaction_time, product, transaction_amount, transaction_currency, transaction_method, transaction_status, user_id)VALUES(:app_token, :transaction_id, :transaction_time, :product, :transaction_amount, :transaction_currency, :transaction_method, :transaction_status, :user_id)';

       //Prepare statement
       $stmt = $this->conn->prepare($query);

       //clean data 
       $this->app_token = htmlentities($this->app_token);
       $this->transaction_id = htmlentities($this->transaction_id);
       $this->transaction_time = htmlentities($this->transaction_time);
       $this->product = htmlentities($this->product);
       $this->transaction_amount = htmlentities($this->transaction_amount);
       $this->transaction_currency = htmlentities($this->transaction_currency);
       $this->transaction_method = htmlentities($this->transaction_method);
       $this->transaction_status = htmlentities($this->transaction_status);
       $this->transaction_status = htmlentities($this->transaction_status);
       $this->user_id = htmlentities($this->user_id);
       //Bind Data
       
       $stmt->bindParam(':app_token', $this->app_token);
       $stmt->bindParam(':transaction_id', $this->transaction_id);
       $stmt->bindParam(':transaction_time', $this->transaction_time);
       $stmt->bindParam(':product', $this->product);
       $stmt->bindParam(':transaction_amount', $this->transaction_amount);
       $stmt->bindParam(':transaction_currency', $this->transaction_currency);
       $stmt->bindParam(':transaction_method', $this->transaction_method);
       $stmt->bindParam(':transaction_status', $this->transaction_status);
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

    public function find_all()
    {
        $query = "SELECT * FROM ".$this->table_name." ORDER BY id DESC";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    //find transactions by app token 
    public function find_all_by_user_id($user_id = 0    )
    {
        $query = "SELECT * FROM ".$this->table_name." INNER JOIN apps ON transactions.app_token = apps.app_token WHERE transactions.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('user_id'=>$user_id));
        return $stmt;
    }
    

    /// find transactions by transaction id 
    public function find_by_transaction_id($transaction_id = '')
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE transaction_id = :transaction_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('transaction_id'=>$transaction_id));
        $count = $stmt->rowCount();
        if($count > 0){
            $app = $stmt->fetch(PDO::FETCH_ASSOC);
            return $app;
        }else{
            return false;
        }
    }
    // update with transaction id 
    public function update()
    {
        $query = "UPDATE ".$this->table_name." SET app_token = :app_token, transaction_time = :transaction_time, product = :product, transaction_amount = :transaction_amount, transaction_currency = :transaction_currency, transaction_method = :transaction_method, transaction_status = :transaction_status, user_id=:user_id WHERE transaction_id = :transaction_id";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data 
        $this->app_token = htmlentities($this->app_token);
        $this->transaction_id = htmlentities($this->transaction_id);
        $this->transaction_time = htmlentities($this->transaction_time);
        $this->product = htmlentities($this->product);
        $this->transaction_amount = htmlentities($this->transaction_amount);
        $this->transaction_currency = htmlentities($this->transaction_currency);
        $this->transaction_method = htmlentities($this->transaction_method);
        $this->transaction_status = htmlentities($this->transaction_status);
        $this->user_id = htmlentities($this->user_id);

        //Bind Data
        $stmt->bindParam(':app_token', $this->app_token);
        $stmt->bindParam(':transaction_id', $this->transaction_id);
        $stmt->bindParam(':transaction_time', $this->transaction_time);
        $stmt->bindParam(':product', $this->product);
        $stmt->bindParam(':transaction_amount', $this->transaction_amount);
        $stmt->bindParam(':transaction_currency', $this->transaction_currency);
        $stmt->bindParam(':transaction_method', $this->transaction_method);
        $stmt->bindParam(':transaction_status', $this->transaction_status);
        $stmt->bindParam(':user_id', $this->user_id);

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