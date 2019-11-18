<?php 
require_once('initialization.php');

class Customer_Docs{
    //Decalare table name 
    private $conn;
    private $table_name = 'customer_docs';
    //Declare class properties 
    public $id;
    public $customer_id;
    public $customer_identity_doc_type_id;
    public $identification_doc;
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

    public function fetch_by_customer_id(){
        $query = "SELECT * FROM usr.".$this->table_name." WHERE customer_id = :customer_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        // clean statement
        $this->customer_id = htmlentities($this->customer_id);

        //bind statement
        $stmt->bindParam(':customer_id', $this->customer_id);

        if($stmt->execute()){
            return $stmt;
        }
    }

    public function create()
    {
        
    }

    public function fetch_by_id($id = ""){
        $query = "SELECT * FROM usr.".$this->table_name." WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('id'=>$id));
        $count = $stmt->rowCount();
        if($count > 0){
            $customer_doc = $stmt->fetch(PDO::FETCH_ASSOC);
            return $customer_doccustomer_doc;
        }else{
            return false;
        }
    }

}