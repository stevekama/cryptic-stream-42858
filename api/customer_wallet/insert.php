<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$wallet = new Customer_Wallet();

$data = array();

$wallet->user_id = $_POST['user_id'];
$wallet->customer_id = $_POST['customer_id'];
$wallet->phone_number = $_POST['phone_number'];
$d = new DateTime();
$wallet->created_date = $d->format('Y-m-d');
$wallet->created_user_id = $_POST['user_id'];
$wallet->edited_date = $d->format('Y-m-d');
$wallet->edited_user_id = $_POST['user_id'];
if($wallet->create()){
    $data['message'] = 'success';
}else{
    $data['message'] = 'failed';
}
echo json_encode($data);
?>