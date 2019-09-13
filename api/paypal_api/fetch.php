<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

// create connection 
$connection = $database->connect();

//find columns
$columns = array('app_name', 'transaction_id', 'payments_amount', 'payment_status', 'transaction_date');

// filter values 
$user_id = $session->user_id;

echo $user_id;