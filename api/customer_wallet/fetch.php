<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$wallet = new Customer_Wallet();

if($_POST['action'] == 'FETCH_FOR_CUSTOMER'){

    $customer_wallet = $wallet->fetch_wallet_for_customer($_POST['customer_id']);

    if(!$customer_wallet){
        echo json_encode(array('message'=>'noWalletFound'));
        die();
    }
    echo json_encode($customer_wallet);
}