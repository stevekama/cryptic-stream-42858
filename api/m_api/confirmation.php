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

// Save Data In DB
// 1.initialize mpesa class
$trns = new MPESATransactions();
$trns->transaction_type   = '';
$trns->transaction_id     = '';
$trns->transaction_time   = '';
$trns->transaction_amount = '';
$trns->business_shortcode = '';
$trns->bill_refnumber     = '';
$trns->invoice_number     = '';
$trns->original_balance   = '';
$trns->third_party_transaction_id = '';
$trns->msisdn             = '';
$trns->first_name         = '';
$trns->middle_name        = '';
$trns->last_name          = '';

if($trns->create()){
    json_encode(array('message'=>'success'));
}

echo $response;