<?php 
use \PayPal\Api\Payment;
use \PayPal\Api\PaymentExecution;

include_once '../../models/initialization.php';

$data = array();

$d = new DateTime();

$url = base_url().'public/index.php';

// find logged in user
$user = new Users();

$current_user = $user->find_user_by_id($session->user_id);

if(!$current_user){
    redirect_to($url.'?message=errorUser');
    die();
}

if(!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])){
    redirect_to($url.'?message=errorTransactions');   
    die();
}

// get payments id and payer ID
$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

if((bool)$_GET['success'] == false){
    redirect_to($url.'?message=cancelledTransactions');
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
    $data['message'] = 'errorInTransaction';
    $data['error'] = $e->getData();
    echo json_encode($data);
    die();
}

redirect_to($url.'?message=success');