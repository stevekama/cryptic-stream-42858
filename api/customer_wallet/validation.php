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
echo $response;