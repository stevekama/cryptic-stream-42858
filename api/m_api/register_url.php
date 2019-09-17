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

$access_token = $app->Access_Token();

$shortCode = '600589'; // provide the short code obtained from your test credentials

// 2. provide confirmation url and validation urls 
$confirmationUrl = base_url().'api/m_api/confirmation.php'; // path to your confirmation url. can be IP address that is publicly accessible or a url
$validationUrl = base_url().'api/m_api/validation.php'; // path to your validation url. can be IP address that is publicly accessible or a url

// 3. call register url class
$register_url = $app->register_url($access_token, $shortCode, $confirmationUrl, $validationUrl);

// decode data
$data = json_decode($register_url, true);

var_dump($data);