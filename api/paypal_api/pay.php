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
$paypal_trns = new PayPalTransactions();
$paypal_trns->app_token = $current_app['app_token'];
$paypal_trns->transaction_id = $payment->getId();
$paypal_trns->payment_amount = $payment->transactions[0]->amount->total;
$paypal_trns->payment_status = $payment->getState();
$paypal_trns->invoice_id = $payment->transactions[0]->invoice_number;
$paypal_trns->transaction_date = date('YmdHis');

if($paypal_trns->create()){
    // update transactions 
    $trns = new Transactions();

    // find transaction by id 
    $current_transaction = $trns->find_by_transaction_id($payment->getId());

    if(!$current_transaction){
        $data['message'] = 'Transaction doesnot exists';
        echo json_encode($data);
        die();
    }
    // populate transactions 
    $trns->app_token = $current_app['app_token'];
    $trns->transaction_id = $payment->getId();
    $trns->transaction_time = date('YmdHis');
    $trns->product = $current_transaction['product'];
    $trns->transaction_amount = $payment->transactions[0]->amount->total;
    $trns->transaction_currency = $current_transaction['transaction_currency'];
    $trns->transaction_method = $current_transaction['transaction_method'];
    $trns->transaction_status = $payment->getState();

    // save data 
    if($trns->update()){
        // redirect to the users response url
        redirect_to($current_app['response_url']);
    }
}else{
    $data['message'] = 'Error in storing data';
    echo json_encode($data);
    die();
}