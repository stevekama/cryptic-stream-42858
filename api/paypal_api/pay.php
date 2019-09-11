<?php 
use \PayPal\Api\Payment;
use \PayPal\Api\PaymentExecution;

include_once '../../models/initialization.php';

$data = array();
if(!isset($_GET['success'], $_GET['app_token'], $_GET['paymentId'], $_GET['PayerID'])){
    $data['message'] = 'Could not get transactions details';
    echo json_encode($data);    
    die();
}

if((bool)$_GET['success'] == false){
    $data['message'] = 'could not make payments';
    echo json_encode($data);
    die();
} 

$app_token = $_GET['app_token'];

// 1. Initialize apps
$app = new Apps();

// 2. find app by token 
$current_app = $app->find_by_token($app_token);

//check if app exists
if(!$current_app){
    $data['message'] = 'App doesnot exists';
    echo json_encode($data);
    die();
}

// Paypal Auth 
$paypal_auth = new PayPalAuth($current_app['app_key'], $current_app['app_secret']);

// authenticate app
$paypal = $paypal_auth->auth();

// get payments id and payer ID
$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

// load payment info
$payment = Payment::get($paymentId, $paypal);

// payment execution
$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try{
    $result = $payment->execute($execute, $paypal);
} catch(Exception $e) {
    echo $e->getData();
    die();
}

//save to db    
//initialize paypal transation class
$trns = new PayPalTransactions();
$trns->app_token = $current_app['app_token'];
$trns->transaction_id = $payment->getId();
$trns->payment_amount = $payment->transactions[0]->amount->total;
$trns->payment_status = $payment->getState();
$trns->invoice_id = $payment->transactions[0]->invoice_number;
$trns->transaction_date = date('YmdHis');

$record_data = array();
$record_data['app_token'] = $current_app['app_token'];
$record_data['transaction_id'] = $payment->getId();
$record_data['payment_amount'] = $payment->transactions[0]->amount->total;
$record_data['payment_status'] = $payment->getState();
$record_data['invoice_id'] = $payment->transactions[0]->invoice_number;
$record_data['transaction_date'] = date('YmdHis');

echo json_encode($record_data);