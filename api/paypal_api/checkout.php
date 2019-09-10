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

// authenticate user 
// get key and secret 
$app = new Apps();

// get app details 
$current_app = $app->find_by_token($_POST['token']);

if(!$current_app){
    echo json_encode(array('message'=>'errorApp'));
    die();
}

// Paypal Auth 
$paypal_auth = new PayPalAuth($current_app['key'], $current_app['secret']);

// // get paypal details 
// $paypal = $paypal_auth->auth();
// // process payments
// // get post data
// $product = $_POST['product'];
// $price = $_POST['price'];
// $shipping = 2.00;
// $currency = $_POST['currency'];

// $total = $price + $shipping;

// // define user payment method 
// $payer = new Payer();
// $payer->setPaymentMethod('paypal');

// $item = new Item();
// $item->setName($product)
//     ->setCurrency($currency)
//     ->setQuantity(1)
//     ->setPrice($price);

// //create item List 
// $itemList = new ItemList();
// $itemList->setItems([$item]);

// //create details 
// $details = new Details();
// $details->setShipping($shipping)
//         ->setSubtotal($price);

// //create amount details 
// $amount = new Amount();
// $amount->setCurrency('USD')
//         ->setTotal($total)
//         ->setDetails($details);

// //set Transaction 
// $transaction = new Transaction();
// $transaction->setAmount($amount)
//             ->setItemList($itemList)
//             ->setDescription('Paypal payments test')
//             ->setInvoiceNumber(uniqid());   

// $redirectUrls = new RedirectUrls();
// $redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true')
//             ->setCancelUrl(SITE_URL . '/pay.php?success=false');

// $payment = new Payment();
// $payment->setIntent('sale')
//         ->setPayer($payer)
//         ->setRedirectUrls($redirectUrls)
//         ->setTransactions([$transaction]);


// try {

//     $payment->create($paypal);

// } catch(PayPal\Exception\PayPalConnectionException $ex){
//     echo $ex->getCode(); // Prints the Error Code
//     echo $ex->getData(); // Prints the detailed error message 
//     die($ex);
// } catch (Exception $e) {
//     die($e);
// }

// $approvalUrl = $payment->getApprovalLink();

// echo $approvalUrl;
// //header("Location: {$approvalUrl}"); 