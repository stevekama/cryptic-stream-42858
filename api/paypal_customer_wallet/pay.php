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
    $wallet = new Customer_Wallet();
    // current wallet 
    $current_wallet = $wallet->fetch_wallet_for_customer($current_user['customer_id']);
    if(!$current_wallet){
        $data['message'] = 'wrongCustomerWallet';
        echo json_encode($data);
        die();
    }
    // enter customer wallet paypal 
    $paypal = new CustomerWalletPayPal();
    $paypal->user_id = $current_user['id'];
    $paypal->customer_id = $current_user['customer_id'];
    $paypal->transaction_id = $payment->getId();
    $paypal->payment_amount = $payment->transactions[0]->amount->total;
    $paypal->payment_status = $payment->getState();
    $paypal->invoice_id = $payment->transactions[0]->invoice_number;
    $paypal->transaction_date = date('YmdHis');
    // save data in db
    if($paypal->create()){
        $data['message'] = 'success';
    }
} catch(Exception $e) {
    $data['message'] = 'errorInTransaction';
    $data['error'] = $e->getData();
    echo json_encode($data);
    die();
}

redirect_to($url.'?message=success');