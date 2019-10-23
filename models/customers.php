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
    public $physical_address;
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
}