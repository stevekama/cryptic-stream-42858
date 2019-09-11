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
try{
    // initialize payments 
    $db_payment = Payment::get($paymentId, $paypal);
    
    //initialize paypal transation class
    $paypal_transactions = new PayPalTransactions();
    $paypal_transactions->app_token = $current_app['app_token'];
    $paypal_transactions->transaction_id = $db_payment->getId();
    $paypal_transactions->payment_amount = $db_payment->transactions[0]->amount->total;
    $paypal_transactions->payment_status = $db_payment->getState();
    $paypal_transactions->invoice_id = $db_payment->transactions[0]->invoice_number;
    $paypal_transactions->transaction_date = date('YmdHis');

    //save data in db 
    if($paypal_transactions->create()){
        // redirect to the users response url
        redirect_to($current_app['response_url']);
    }else{
        $data['message'] = 'Error in storing data';
        echo json_encode($data);
        die();
    }

}catch(Exception $e){
    echo $e->getData();
    die();
}