<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$consumerKey = 'P0jSGSSzPDQjY6TXE9CzKA5G8UY8iPGr';
$consumerSecret = 'S9TlOILseXCfzw9l';

$app_auth = new Auth($consumerKey, $consumerSecret);

$access_token = $app_auth->Access_Token();

echo $access_token;