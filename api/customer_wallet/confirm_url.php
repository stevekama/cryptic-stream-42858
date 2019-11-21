<?php 
header("Content-Type: application/json");

include_once '../../models/initialization.php';

$response = '{
    "ResultCode": 0, 
    "ResultDesc": "Confirmation Received Successfully"
}';

// find logged in user 
// initialize the user class 
$user = new Users();

// get current user
$current_user = $user->find_user_by_id($_GET['user']);

if(!$current_user){
    echo json_encode(array('message'=>'user not found'));
    die();
}

// DATA
$mpesaResponse = file_get_contents('php://input');
$jsonMpesaResponse = json_decode($mpesaResponse, true);

// Save Data In DB
echo $response;