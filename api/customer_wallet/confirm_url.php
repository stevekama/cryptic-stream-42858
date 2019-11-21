<?php 
header("Content-Type: application/json");

include_once '../../models/initialization.php';

$response = '{
    "ResultCode": 0, 
    "ResultDesc": "Confirmation Received Successfully"
}';

// find logged in user 
// initialize the user class 
$user = new Users();

// get current user
$current_user = $user->find_user_by_id($_GET['user']);

if(!$current_user){
    echo json_encode(array('message'=>'user not found'));
    die();
}

// DATA
$mpesaResponse = file_get_contents('php://input');
$jsonMpesaResponse = json_decode($mpesaResponse, true);

// Save Data In DB
// 1.initialize mpesa class
$trns = new Customer_Wallet_Transactions();

$trns->user_id            = $current_user['id'];
$trns->customer_id        = $current_user['customer_id'];
$trns->transaction_type   = $jsonMpesaResponse['TransactionType'];
$trns->transaction_id     = $jsonMpesaResponse['TransID'];
$trns->transaction_time   = $jsonMpesaResponse['TransTime'];
$trns->transaction_amount = $jsonMpesaResponse['TransAmount'];
$trns->business_shortcode = $jsonMpesaResponse['BusinessShortCode'];
$trns->bill_refnumber     = $jsonMpesaResponse['BillRefNumber'];
$trns->invoice_number     = $jsonMpesaResponse['InvoiceNumber'];
$trns->original_balance   = $jsonMpesaResponse['OrgAccountBalance'];
$trns->third_party_transaction_id = $jsonMpesaResponse['ThirdPartyTransID'];
$trns->msisdn             = $jsonMpesaResponse['MSISDN'];
$trns->first_name         = $jsonMpesaResponse['FirstName'];
$trns->middle_name        = $jsonMpesaResponse['MiddleName'];
$trns->last_name          = $jsonMpesaResponse['LastName'];

// save transaction
if($trns->create()){
    echo $response;
}