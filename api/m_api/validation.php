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
$trns = new Transactions();

$trns->app_token            = $current_app['app_token'];
$trns->transaction_id       = $jsonMpesaResponse['TransID'];
$trns->transaction_time     = $jsonMpesaResponse['TransTime'];
$trns->product              = '';
$trns->transaction_amount   = $jsonMpesaResponse['TransAmount'];
$trns->transaction_currency = 'KSH';
$trns->transaction_method   = 'MPESA';
$trns->transaction_status   = '';
$trns->user_id              = $current_app['user_id'];

// save transaction
if($trns->create()){
    echo $response;
}