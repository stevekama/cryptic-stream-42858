<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

// 1. Obtain access token and shortcode
// - Get app in our db by app token 
$apps = new Apps();

$current_app = $apps->find_by_token($_POST['app_token']);

$consumerKey = $current_app['app_key']; //Fill with your app Consumer Key

$consumerSecret = $current_app['app_secret']; // Fill with your app Secret

// initialize mpesa auth class
$app = new Auth($consumerKey, $consumerSecret);

$access_token = $app->Access_Token();

echo $access_token;

// $shortCode = $_POST['shortcode']; // provide the short code obtained from your test credentials

// // 2. provide confirmation url and validation urls 
// $confirmationUrl = base_url().'api/m_api/confirmation.php?app_token='.$current_app['app_token']; // path to your confirmation url. can be IP address that is publicly accessible or a url
// $validationUrl = base_url().'api/m_api/validation.php?app_token='.$current_app['app_token']; // path to your validation url. can be IP address that is publicly accessible or a url

// // 3. call register url class
// $register_url = $app->register_url($access_token, $shortCode, $confirmationUrl, $validationUrl);

// // decode data
// $data = json_decode($register_url, true);
// if($data['ResponseDescription'] == 'success'){
//     // save in the data in db
//     // 1. initiate mpesa details class
//     $details = new MPESA_APPS_Details();

//     // put variables in placeholders 
//     $details->app_token       = $current_app['app_token'];
//     $details->shortcode       = $_POST['shortcode'];
//     $details->lipanampesacode = $_POST['lipanampesacode'];
//     $details->passkey         = $_POST['passkey'];
//     // response data
//     $response_data            = array();
//     // save data to db 
//     if($details->create()){
//         $response_data['message'] = 'success';
//     }else{
//         $response_data['message'] = 'failed';
//     }
//     echo json_encode($response_data);
// }else{
//     // has not registered url
//     echo $register_url;
// }