<?php 
header("Content-Type: application/json");

include_once '../../models/initialization.php';

$response = '{
    "ResultCode": 0, 
    "ResultDesc": "Confirmation Received Successfully"
}';

// DATA
$mpesaResponse = file_get_contents('php://input');
$jsonMpesaResponse = json_decode($mpesaResponse, true);

// find app by app token by trns apptoken 
// initiate users 
$users = new Users();

// find user by id
$current_user = $users->find_user_by_id($_GET['user_id']);

if(!$current_user){
    echo json_encode(array('message'=>'user not found'));
    die();
}

// Save Data In DB
// 1.initialize wallet
$wallet = new Customer_Wallet();

// wallet for customer 
$customer_wallet = $wallet->fetch_wallet_for_customer($current_user['customer_id']);

if(!$customer_wallet){
    echo json_encode(array('message'=>'wallet not found'));
    die();
}

// wallet amout 
$amount = $customer_wallet['amount'] + $jsonMpesaResponse['TransAmount'];

$d = new DateTime();

// update wallet 
$wallet->id              = $customer_wallet['id'];
$wallet->user_id         = $current_user['id'];
$wallet->customer_id     = $customer_wallet['customer_id'];
$wallet->amount          = $amount;
$wallet->phone_number    = $customer_wallet['phone_number'];
$wallet->created_date    = $customer_wallet['created_date'];
$wallet->created_user_id = $customer_wallet['created_user_id'];
$wallet->edited_date     = $d->format('Y-m-d H:i:s');
$wallet->edited_user_id  = $current_user['id'];

if($wallet->update()){
    echo $response;
}