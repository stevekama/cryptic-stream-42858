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

/* If we have any validation, we will do it here then change the $response if we reject the transaction */
// Your Validation
// $response = '{  "ResultCode": 1, "ResultDesc": "Transaction Rejected."  }';
/* Ofcourse we will be checking for amount, account number(incase of paybill), invoice number and inventory.
But we reserve this for future tutorials*/
// log the response
$logFile = "validation.txt";
 
// write the M-PESA Response to file
$log = fopen($logFile, "a");
fwrite($log, $jsonMpesaResponse);
fclose($log);
echo $response;