<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

//find columns
$columns = array('app_name', 'transaction_id', 'payments_amount', 'payment_status', 'transaction_date');

//initiate transactions 
$trns = new PayPalTransactions();

$trns->user_id = $_POST['user_id'];

// filter values 
$count_trns = $trns->find_by_user_id();