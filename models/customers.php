<?php 
require_once('initialization.php');

class Customers{
    //Decalare table name 
    private $conn;
    private $table_name = 'customers';
    //Declare class properties 
    public $id;
    public $first_name;
    public $other_names;
    public $cust_type_id;
    public $customer_identity_doc_type_id1;
    public $identification_doc1;
    public $customer_identity_doc_type_id2;
    public $identification_doc2;
    public $customer_identity_doc_type_id3;
    public $identification_doc3;
    public $customer_identity_doc_type_id4;
    public $identification_doc4;
    public $customer_identity_doc_type_id5;
    public $identification_doc5;
    public $email_address;
    public $dob;
    public $date_of_registration;
    public $postal_address;
    public $pysical_address;
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

    public function create()
    {
       $query = 'INSERT INTO '.$this->table_name.'(first_name, other_name, cust_type_id, customer_identity_doc_type_id1, identification_doc1, customer_identity_doc_type_id2, identification_doc2, customer_identity_doc_type_id3, identification_doc3, customer_identity_doc_type_id4, identification_doc4, customer_identity_doc_type_id5, identification_doc5, email_address, dob, date_of_registration, postal_address, physical_address, created_date, created_user_id, edited_date, edited_user_id)VALUES(:first_name, :other_name, :cust_type_id, :customer_identity_doc_type_id1, :identification_doc1, :customer_identity_doc_type_id2, :identification_doc2, :customer_identity_doc_type_id3, :identification_doc3, :customer_identity_doc_type_id4, :identification_doc4, :customer_identity_doc_type_id5, :identification_doc5, :email_address, :dob, :date_of_registration, :postal_address, :physical_address, :created_date, :created_user_id, :edited_date, :edited_user_id)'; 
       
       //Prepare statement
       $stmt = $this->conn->prepare($query);

       //clean data 
       $this->first_name = htmlentities($this->first_name);
       $this->app_key = htmlentities($this->app_key);
       $this->app_secret = htmlentities($this->app_secret);
       $this->app_token = htmlentities($this->app_token);
       $this->shortcode = htmlentities($this->shortcode);
       $this->confirmation = htmlentities($this->confirmation);
       $this->validation = htmlentities($this->validation);
       

       //Bind Data
       $stmt->bindParam(':app_name', $this->app_name);
       $stmt->bindParam(':app_key', $this->app_key);
       $stmt->bindParam(':app_secret', $this->app_secret);
       $stmt->bindParam(':app_token', $this->app_token);
       $stmt->bindParam(':shortcode', $this->shortcode);
       $stmt->bindParam(':confirmation', $this->confirmation);
       $stmt->bindParam(':validation', $this->validation);

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

}