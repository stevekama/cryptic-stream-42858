<?php 
require_once('initialization.php');

class Lipa{
    private $conn;
    private $access_token;
    private $bussiness_code;
    private $timestamp;
    
    // table name and schema 
    private $schema = 'app';
    private $table_name = 'lipa_mpesa';
    private $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
    private $password;

    // Users properties 
    public $id;
    public $user_id;
    public $property_id;
    public $house_id;
    public $tenants_id;
    public $structure_id;
    public $phone_number;
    public $amount;
    public $merchant_request_id;
    public $checkout_request_id;
    public $response_code;
    public $result_desc;
    public $response_desc;
    public $result_code;
    public $time_paid;
    public $created_date;
    public $edited_date;



    //db connect
    public function __construct($access_token, $bussiness_code, $timestamp){
        global $database;
        $this->conn = $database->connect();
        $this->access_token = $access_token;
        $this->bussiness_code = $bussiness_code;
        $this->timestamp = $timestamp;
        $this->password = base64_encode($this->bussiness_code.$this->passkey.$this->timestamp);
    }

    // create
    public function create(){
        $query = "INSERT INTO ".$this->schema.".".$this->table_name."(";
        $query .= "user_id, property_id, house_id, "; 
        $query .= "tenants_id, structure_id, phone_number, amount, "; 
        $query .= "merchant_request_id, checkout_request_id, response_code, "; 
        $query .= "result_desc, response_desc, result_code, "; 
        $query .= "time_paid, created_date, edited_date"; 
        $query .= ")VALUES(";
        $query .= ":user_id, :property_id, :house_id, "; 
        $query .= ":tenants_id, :structure_id, :phone_number, :amount, "; 
        $query .= ":merchant_request_id, :checkout_request_id, :response_code, "; 
        $query .= ":result_desc, :response_desc, :result_code, "; 
        $query .= ":time_paid, :created_date, :edited_date"; 
        $query .= ")";

        //propare statement 
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->user_id = htmlentities($this->user_id);
        $this->property_id = htmlentities($this->property_id);
        $this->house_id = htmlentities($this->house_id);
        $this->tenants_id = htmlentities($this->tenants_id);
        $this->structure_id = htmlentities($this->structure_id);
        $this->phone_number = htmlentities($this->phone_number);
        $this->amount = htmlentities($this->amount);
        $this->merchant_request_id = htmlentities($this->merchant_request_id);
        $this->checkout_request_id = htmlentities($this->checkout_request_id);
        $this->response_code = htmlentities($this->response_code);
        $this->result_desc = htmlentities($this->result_desc);
        $this->response_desc = htmlentities($this->response_desc);
        $this->result_code = htmlentities($this->result_code);
        $this->time_paid = htmlentities($this->time_paid);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);


        //Bind Data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':property_id', $this->property_id);
        $stmt->bindParam(':house_id', $this->house_id);
        $stmt->bindParam(':tenants_id', $this->tenants_id);
        $stmt->bindParam(':structure_id', $this->structure_id);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':merchant_request_id', $this->merchant_request_id);
        $stmt->bindParam(':checkout_request_id', $this->checkout_request_id);
        $stmt->bindParam(':response_code', $this->response_code);
        $stmt->bindParam(':result_desc', $this->result_desc);
        $stmt->bindParam(':response_desc', $this->response_desc);
        $stmt->bindParam(':result_code', $this->result_code);
        $stmt->bindParam(':time_paid', $this->time_paid);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        //Execute Query 
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        } 
    }

    // create
    public function update(){
        $query = "UPDATE ".$this->schema.".".$this->table_name." SET ";
        $query .= "user_id = :user_id, property_id = :property_id, house_id = :house_id, "; 
        $query .= "tenants_id = :tenants_id, structure_id = :structure_id, phone_number = :phone_number, amount = :amount, "; 
        $query .= "merchant_request_id = :merchant_request_id, checkout_request_id = :checkout_request_id, response_code = :response_code, "; 
        $query .= "result_desc = :result_desc, response_desc = :response_desc, result_code = :result_code, "; 
        $query .= "time_paid = :time_paid, created_date = :created_date, edited_date = :edited_date ";
        $query .= "WHERE id = :id ";

        //propare statement 
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlentities($this->id);
        $this->user_id = htmlentities($this->user_id);
        $this->property_id = htmlentities($this->property_id);
        $this->house_id = htmlentities($this->house_id);
        $this->tenants_id = htmlentities($this->tenants_id);
        $this->structure_id = htmlentities($this->structure_id);
        $this->phone_number = htmlentities($this->phone_number);
        $this->amount = htmlentities($this->amount);
        $this->merchant_request_id = htmlentities($this->merchant_request_id);
        $this->checkout_request_id = htmlentities($this->checkout_request_id);
        $this->response_code = htmlentities($this->response_code);
        $this->result_desc = htmlentities($this->result_desc);
        $this->response_desc = htmlentities($this->response_desc);
        $this->result_code = htmlentities($this->result_code);
        $this->time_paid = htmlentities($this->time_paid);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);


        //Bind Data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':property_id', $this->property_id);
        $stmt->bindParam(':house_id', $this->house_id);
        $stmt->bindParam(':tenants_id', $this->tenants_id);
        $stmt->bindParam(':structure_id', $this->structure_id);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':merchant_request_id', $this->merchant_request_id);
        $stmt->bindParam(':checkout_request_id', $this->checkout_request_id);
        $stmt->bindParam(':response_code', $this->response_code);
        $stmt->bindParam(':result_desc', $this->result_desc);
        $stmt->bindParam(':response_desc', $this->response_desc);
        $stmt->bindParam(':result_code', $this->result_code);
        $stmt->bindParam(':time_paid', $this->time_paid);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        //Execute Query 
        if($stmt->execute()){
            return true;
        } 
    }

    // find by id 
    public function find_payment_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->schema.".".$this->table_name." WHERE id = :id LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute(array('id'=>$id));

        $payment = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        return $payment;
    }

    // lipa na mpesa 
    public function make_payments($phone_number, $amount){
       
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->access_token)); 

        $bussiness_code = $this->bussiness_code;
        $timestamp = $this->timestamp;
        $partyA = $phone_number;
        $partyB = $this->bussiness_code;
        $phone_number = $phone_number;
        $callbackurl = base_url()."/api/lipa_api/callback.php";
        $accountReference = $phone_number;
        $TransactionDesc = "Transactions";
        $Amount = $amount;
        $password = $this->password;

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $bussiness_code,
            'Password' =>  $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $Amount,
            'PartyA' => $partyA,
            'PartyB' => $partyB,
            'PhoneNumber' => $phone_number,
            'CallBackURL' => $callbackurl,
            'AccountReference' => $accountReference,
            'TransactionDesc' => $TransactionDesc
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        return $curl_response;
        
    }

    // check transaction
    public function confirm_transaction($CheckoutRequestID)
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
  
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->access_token)); //setting custom header

        $BusinessShortCode = $this->bussiness_code;
        $Timestamp = $this->timestamp;
        $Password = $this->password;
        
        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp,
            'CheckoutRequestID' => $CheckoutRequestID
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        return $curl_response;
    }


}