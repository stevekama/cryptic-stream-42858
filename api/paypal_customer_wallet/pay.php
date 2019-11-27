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