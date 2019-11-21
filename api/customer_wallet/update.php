<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$data = array();

$consumerKey = "P0jSGSSzPDQjY6TXE9CzKA5G8UY8iPGr";
$consumerSecret = "S9TlOILseXCfzw9l";
// initialize mpesa auth class
$app_auth = new Auth($consumerKey, $consumerSecret);

// get app shortcode 
$ShortCode = '600290';
// This will be posted data
$amount     = $_POST['amount']; // amount the client/we are paying to the paybill
$msisdn     = '254708374149'; // phone number paying 
$billRef    = 'inv95'; // This is anything that helps identify the specific transaction. Can be a clients ID, Account Number, Invoice amount, cart no.. etc
$curl_response = $app_auth->simulate_transactions($ShortCode, $amount, $msisdn, $billRef);
$data = json_decode($curl_response, true);
$response_url = $current_app['response_url'];
if($data['ResponseDescription'] != 'Accept the service request successfully.'){
       $data['message'] = 'Failed';
       die();
}
$data['message'] = 'Success';

echo json_encode($data);