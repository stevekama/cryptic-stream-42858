<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

// 1. Obtain access token and shortcode

$consumerKey = $_POST['key']; //Fill with your app Consumer Key

$consumerSecret = $_POST['secret']; // Fill with your app Secret

// initialize mpesa auth class
$app = new Auth($consumerKey, $consumerSecret);

// 2. simulate data
$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';

$access_token = $app->Access_Token();
$ShortCode  = '600589'; // Shortcode. Same as the one on register_url.php
$amount     = '100'; // amount the client/we are paying to the paybill
$msisdn     = '254708374149'; // phone number paying 
$billRef    = 'inv95'; // This is anything that helps identify the specific transaction. Can be a clients ID, Account Number, Invoice amount, cart no.. etc
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token));
$curl_post_data = array(
       'ShortCode' => $ShortCode,
       'CommandID' => 'CustomerPayBillOnline',
       'Amount' => $amount,
       'Msisdn' => $msisdn,
       'BillRefNumber' => $billRef
);
$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
print_r($curl_response);
echo $curl_response;