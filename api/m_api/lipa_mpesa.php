<?php 

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

// 1. obtain access token 

$consumerKey = $_POST['key']; //Fill with your app Consumer Key

$consumerSecret = $_POST['secret']; // Fill with your app Secret

// initialize mpesa auth class
$app = new Auth($consumerKey, $consumerSecret);

// 2. declare lipa na mpesa variables
$access_token      = $app->Access_Token();

// bring in php date class function 
$d = new DateTime();

$BusinessShortCode = "174379";
$Timestamp         = $d->format('Ymdhis');
$Passkey           = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
$Password          = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
$Amount            = "1";
$PartyA            = "254715356718";
$PartyB            = $BusinessShortCode;
$PhoneNumber       = "254715356718";
$CallBackURL       = base_url()."api/m_api/callback_url.php";
$AccountReference  = "CART098";
$TransactionDesc   = "Buying a shoe";

echo $access_token;