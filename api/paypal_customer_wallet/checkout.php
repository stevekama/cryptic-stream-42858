<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

use \PayPal\Api\Payer;
use \PayPal\Api\Item;
use \PayPal\Api\ItemList;
use \PayPal\Api\Details;
use \PayPal\Api\Amount;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payment;

include_once '../../models/initialization.php';

$app_key = "AeBUA_Q-Gvpwlxt6IdlM7tG1V67JL1kpx4vZc549OOmmUAfMJWoDE65YJFLpU5n-tk2V1AHovAYLq9PT";
$app_secret = "EKvnUNlZI4sAiLmPoQHqCbGv0PPZCvL67bPfcBZZawEbE4xW7uNjacAw__VOeiQCMNlEcgD8OdhLXFoy";

// Paypal Auth 
$paypal_auth = new PayPalAuth($app_key, $app_secret);

// get paypal details 
$paypal = $paypal_auth->auth();

if(!$paypal){
    echo json_encode(array('message'=>'errorAuth'));
    die();
}

// process payments
// get post data
$product = 'Customer wallet';
$price = $_POST['price'];
$shipping = 0.00;
$currency = $_POST['currency'];
$quantity = 1;
$total = $price + $shipping;

// define user payment method 
$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item->setName($product)
    ->setCurrency($currency)
    ->setQuantity($quantity)
    ->setPrice($price);

//create item List 
$itemList = new ItemList();
$itemList->setItems([$item]);

//create details 
$details = new Details();
$details->setShipping($shipping)
        ->setSubtotal($price);

//create amount details 
$amount = new Amount();
$amount->setCurrency($currency)
        ->setTotal($total)
        ->setDetails($details);

//set Transaction
$transaction = new Transaction();
$transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Paypal payments test')
            ->setInvoiceNumber(uniqid());   

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(base_url() . 'api/paypal_customer_wallet/pay.php?success=true')
            ->setCancelUrl(base_url() . 'api/paypal_customer_wallet/pay.php?success=false');

$payment = new Payment();
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);
try {
    $payment->create($paypal);
    
} catch(PayPal\Exception\PayPalConnectionException $ex){
    $error_data = array();
    $error_data['code'] = $ex->getCode(); // Prints the Error Code
    $error_data['data'] = array($ex->getData()); // Prints the detailed error message 

    echo json_encode($error_data);
    die();
} catch (Exception $e) {
    die($e);
}

$approvalUrl = $payment->getApprovalLink();
//header("Location: {$approvalUrl}"); 
redirect_to($approvalUrl);