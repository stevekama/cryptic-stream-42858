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

/* If we have any validation, we will do it here then change the $response if we reject the transaction */
// Your Validation
// $response = '{  "ResultCode": 1, "ResultDesc": "Transaction Rejected."  }';
/* Ofcourse we will be checking for amount, account number(incase of paybill), invoice number and inventory.
But we reserve this for future tutorials*/
// log the response
$logFile = "confirmationResponse.txt";

// will be used when we want to save the response to database for our reference
$jsonMpesaResponse = json_decode($mpesaResponse, true); 
// write the M-PESA Response to file
$log = fopen($logFile, "a");
fwrite($log, $mpesaResponse);
fclose($log);
echo $response;