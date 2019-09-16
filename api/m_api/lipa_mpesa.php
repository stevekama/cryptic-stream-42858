<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// 1. obtain access token 

$consumerKey = $_POST['key']; //Fill with your app Consumer Key

$consumerSecret = $_POST['secret']; // Fill with your app Secret

// initialize mpesa auth class
$app = new Auth($consumerKey, $consumerSecret);

// 2. declare lipa na mpesa variables
// bring in php date class function 
$d = new DateTime();
 
$access_token      = $app->Access_Token();
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

// 3. run lipa na mpesa code 
$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
  
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'BusinessShortCode' => $BusinessShortCode,
  'Password' => $Password,
  'Timestamp' => $Timestamp,
  'TransactionType' => 'CustomerPayBillOnline',
  'Amount"' => $Amount,
  'PartyA' => $PartyA,
  'PartyB' => $PartyB,
  'PhoneNumber' => $PhoneNumber,
  'CallBackURL' => $CallBackURL,
  'AccountReference' => $AccountReference,
  'TransactionDesc' => $TransactionDesc
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;