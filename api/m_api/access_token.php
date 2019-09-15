<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$consumerKey = $_POST['key']; //Fill with your app Consumer Key

$consumerSecret = $_POST['secret']; // Fill with your app Secret

$app = new Auth($consumerKey, $consumerSecret);

$access_token = $app->Access_Token();

echo $access_token;