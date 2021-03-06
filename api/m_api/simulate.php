<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

// 1. Obtain access token and shortcode
// Get app using app token 
$apps = new Apps();

$current_app = $apps->find_by_token($_POST['app_token']);

$consumerKey = $current_app['app_key']; //Fill with your app Consumer Key

$consumerSecret = $current_app['app_secret']; // Fill with your app Secret

// initialize mpesa auth class
$app = new Auth($consumerKey, $consumerSecret);

// get details from mpesa details table
// initiate the mpesa details table 
$m_datails = new MPESA_APPS_Details();

$details = $m_datails->find_by_token($current_app['app_token']);

$ShortCode  = $details['shortcode']; // Shortcode. Same as the one on register_url.php
// This will be posted data
$amount     = $_POST['amount']; // amount the client/we are paying to the paybill
$msisdn     = '254708374149'; // phone number paying 
$billRef    = 'inv95'; // This is anything that helps identify the specific transaction. Can be a clients ID, Account Number, Invoice amount, cart no.. etc
$curl_response = $app->simulate_transactions($ShortCode, $amount, $msisdn, $billRef);
$data = json_decode($curl_response, true);
$response_url = $current_app['response_url'];
if($data['ResponseDescription'] != 'Accept the service request successfully.'){
       redirect_to($response_url.'?transaction_status=failed');
       die();
}
redirect_to($response_url.'?transaction_status=success');