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
    public $gender_id;
    public $postal_address;
    public $physical_address;
    public $country_id;
    public $phone_number;
    public $alt_phone_number;
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
        $query = "INSERT INTO usr.".$this->table_name."(";
        $query .= "first_name, other_names, cust_type_id, ";
        $query .= "customer_identity_doc_type_id1, identification_doc1, customer_identity_doc_type_id2, identification_doc2, ";
        $query .= "customer_identity_doc_type_id3, identification_doc3, customer_identity_doc_type_id4, identification_doc4, ";
        $query .= "customer_identity_doc_type_id5, identification_doc5, email_address, dob, ";
        $query .= "date_of_registration, gender_id, postal_address, physical_address, country_id, phone_number, alt_phone_number, created_date, created_user_id, edited_date, edited_user_id";
        $query .= ")VALUES(";
        $query .= ":first_name, :other_names, :cust_type_id, ";
        $query .= ":customer_identity_doc_type_id1, :identification_doc1, :customer_identity_doc_type_id2, :identification_doc2, ";
        $query .= ":customer_identity_doc_type_id3, :identification_doc3, :customer_identity_doc_type_id4, :identification_doc4, ";
        $query .= ":customer_identity_doc_type_id5, :identification_doc5, :email_address, :dob, ";
        $query .= ":date_of_registration, :gender_id, :postal_address, :physical_address, :country_id, :phone_number, :alt_phone_number, :created_date, :created_user_id, :edited_date, :edited_user_id";
        $query .= ")";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->first_name = htmlentities($this->first_name);
        $this->other_names = htmlentities($this->other_names);
        $this->cust_type_id = htmlentities($this->cust_type_id);
        $this->customer_identity_doc_type_id1 = htmlentities($this->customer_identity_doc_type_id1);
        $this->identification_doc1 = htmlentities($this->identification_doc1);
        $this->customer_identity_doc_type_id2 = htmlentities($this->customer_identity_doc_type_id2);
        $this->identification_doc2 = htmlentities($this->identification_doc2);
        $this->customer_identity_doc_type_id3 = htmlentities($this->customer_identity_doc_type_id3);
        $this->identification_doc3 = htmlentities($this->identification_doc3);
        $this->customer_identity_doc_type_id4 = htmlentities($this->customer_identity_doc_type_id4);
        $this->identification_doc4 = htmlentities($this->identification_doc4);
        $this->customer_identity_doc_type_id5 = htmlentities($this->customer_identity_doc_type_id5);
        $this->identification_doc5 = htmlentities($this->identification_doc5);
        $this->email_address = htmlentities($this->email_address);
        $this->dob = htmlentities($this->dob);
        $this->date_of_registration = htmlentities($this->date_of_registration);
        $this->gender_id = htmlentities($this->gender_id);
        $this->postal_address = htmlentities($this->postal_address);
        $this->physical_address = htmlentities($this->physical_address);
        $this->country_id = htmlentities($this->country_id);
        $this->phone_number = htmlentities($this->phone_number);
        $this->alt_phone_number = htmlentities($this->alt_phone_number);
        $this->created_date = htmlentities($this->created_date);
        $this->created_user_id = htmlentities($this->created_user_id);
        $this->edited_date = htmlentities($this->edited_date);
        $this->edited_user_id = htmlentities($this->edited_user_id); 

        // Bind Data
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':other_names', $this->other_names);
        $stmt->bindParam(':cust_type_id', $this->cust_type_id);
        $stmt->bindParam(':customer_identity_doc_type_id1', $this->customer_identity_doc_type_id1);
        $stmt->bindParam(':identification_doc1', $this->identification_doc1);
        $stmt->bindParam(':customer_identity_doc_type_id2', $this->customer_identity_doc_type_id2);
        $stmt->bindParam(':identification_doc2', $this->identification_doc2);
        $stmt->bindParam(':customer_identity_doc_type_id3', $this->customer_identity_doc_type_id3);
        $stmt->bindParam(':identification_doc3', $this->identification_doc3);
        $stmt->bindParam(':customer_identity_doc_type_id4', $this->customer_identity_doc_type_id4);
        $stmt->bindParam(':identification_doc4', $this->identification_doc4);
        $stmt->bindParam(':customer_identity_doc_type_id5', $this->customer_identity_doc_type_id5);
        $stmt->bindParam(':identification_doc5', $this->identification_doc5);
        $stmt->bindParam(':email_address', $this->email_address);
        $stmt->bindParam(':dob', $this->dob);
        $stmt->bindParam(':date_of_registration', $this->date_of_registration); 
        $stmt->bindParam(':gender_id', $this->gender_id);
        $stmt->bindParam(':postal_address', $this->postal_address);
        $stmt->bindParam(':physical_address', $this->physical_address);
        $stmt->bindParam(':country_id', $this->country_id);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':alt_phone_number', $this->alt_phone_number);
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

    public function find_by_id($id = "")
    {
        $query = "SELECT * FROM usr.".$this->table_name." WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('id'=>$id));
        $count = $stmt->rowCount();
        if($count > 0){
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);
            return $customer;
        }else{
            return false;
        }
    }

    // find customers by email
    public function find_by_email($email_address = ''){
        $query = "SELECT * FROM usr.".$this->table_name." WHERE email_address = :email_address LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('email_address'=>$email_address));
        $count = $stmt->rowCount();
        if($count > 0){
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);
            return $customer;
        }else{
            return false;
        }
    }

}