<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';


/// Bring in customer 
$customer = new Customers();

// get customer id 
$customer_id = $_POST['customer_id'];

// current customer
$current_customer = $customer->find_by_id($customer_id);

if(!$current_customer){
    echo json_encode(array('message'=>'error_customer'));
    die();
}

echo json_encode($current_customer);