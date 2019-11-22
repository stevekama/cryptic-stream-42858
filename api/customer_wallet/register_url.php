<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

// register url's on mpesa 
// get app keys and secret
$key = 'P0jSGSSzPDQjY6TXE9CzKA5G8UY8iPGr';
$secret = 'S9TlOILseXCfzw9l';

// initialize auth class 
$app_auth = new Auth($key, $secret);

// get shortcode 
$shortcode = '600290';

$user_id = $_POST['user_id'];

// provide confirmation and validation urls
$confirmationUrl = base_url().'api/customer_wallet/confirm_url.php?user='.$user_id; // path to your confirmation url. can be IP address that is publicly accessible or a url
$validationUrl = base_url().'api/customer_wallet/validation.php?user='.$user_id; // path to your validation url. can be IP address that is publicly accessible or a url

 // register url 
 $register_url = $app_auth->register_url($shortcode, $confirmationUrl, $validationUrl);
 echo $register_url;