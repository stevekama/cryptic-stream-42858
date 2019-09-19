<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

//initiate transactions 
$trns = new MPESATransactions();

$user_id = $session->user_id;

// filter values 
$mpesa_transactions = $trns->find_all_transactions_by_user_id($user_id);

$num_trns = $mpesa_transactions->rowCount();

$data = array();
if($num_trns > 0){
    
    while($mpesa_transaction = $mpesa_transactions->fetch(PDO::FETCH_ASSOC)){
        extract($mpesa_transaction);
        $mpesa_item = array(
            'app_name'             => $app_name,
            'transaction_type'     => $transaction_type,
            'business_code'        => $business_shortcode,
            'transaction_id'       => $transaction_id,
            'transaction_date'     => $transaction_time,
            'transaction_amount'   => $transaction_amount
        );

        // push to array 
        array_push($data, $mpesa_item);
    }
}else{
    $data['message'] = 'No transactions found';
}
echo json_encode($data);