<?php 
use \PayPal\Api\Payment;
use \PayPal\Api\PaymentExecution;

include_once '../../models/initialization.php';

$data = array();

$d = new DateTime();

// find logged in user
$user = new Users();

$current_user = $user->find_user_by_id($session->user_id);

if(!$current_user){
    $data['message'] = 'errorUser';
    echo json_encode($data);    
    die();
}

echo json_encode($current_user);