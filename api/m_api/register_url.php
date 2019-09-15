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

$app = new Auth($consumerKey, $consumerSecret);

$access_token = $app->Access_Token();

$shortCode = '600589'; // provide the short code obtained from your test credentials

// 2. provide confirmation url and validation urls 
$confirmationUrl = base_url().'api/m_api/confirmation.php'; // path to your confirmation url. can be IP address that is publicly accessible or a url
$validationUrl = base_url().'api/m_api/validation.php'; // path to your validation url. can be IP address that is publicly accessible or a url

//register url 
$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

//call the safaricom servers
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
$curl_post_data = array(
    //Fill in the request parameters with valid values
    'ShortCode' => $shortCode,
    'ResponseType' => 'Confirmed',
    'ConfirmationURL' => $confirmationUrl,
    'ValidationURL' => $validationUrl
);
$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
// print_r($curl_response);
echo $curl_response;