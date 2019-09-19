<?php 
header("Content-Type: application/json");

include_once '../../models/initialization.php';

$response = '{
    "ResultCode": 0, 
    "ResultDesc": "Confirmation Received Successfully"
}';

// DATA
$mpesaResponse = file_get_contents('php://input');
$jsonMpesaResponse = json_decode($mpesaResponse, true);

// find app by app token by trns apptoken 
// initiate apps 
$apps = new Apps();
$app_token = $_GET['app_token'];

// find app by app token
$current_app = $apps->find_by_token($app_token);

if(!$current_app){
    echo json_encode(array('message'=>'no app found'));
    die();
}

// Save Data In DB
// 1.initialize mpesa class
$trns = new MPESATransactions();

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
$trns->app_token          = $current_app['app_token'];
$trns->user_id            = $current_app['user_id'];

// save transaction
if($trns->create()){
    echo $response;
}