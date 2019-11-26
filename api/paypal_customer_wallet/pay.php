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

// get payments id and payer ID
$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

$url = base_url().'api/paypal_customer_wallet/response.php';

if((bool)$_GET['success'] == false){
    redirect_to($url.'?transaction=canceled');
    die();
} 

$app_key = "AeBUA_Q-Gvpwlxt6IdlM7tG1V67JL1kpx4vZc549OOmmUAfMJWoDE65YJFLpU5n-tk2V1AHovAYLq9PT";
$app_secret = "EKvnUNlZI4sAiLmPoQHqCbGv0PPZCvL67bPfcBZZawEbE4xW7uNjacAw__VOeiQCMNlEcgD8OdhLXFoy";

// Paypal Auth 
$paypal_auth = new PayPalAuth($app_key, $app_secret);

// authenticate app
$paypal = $paypal_auth->auth();

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
// redirect to the users response url
redirect_to($url);