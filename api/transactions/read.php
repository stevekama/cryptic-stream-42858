<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../models/initialization.php';

$transactions = new Transactions();

$user_id = $_POST['user_id'];
// Read Transactions 
$results = $transactions->find_all_by_user_id($user_id);

// count transactions
$count = $results->rowCount();

$data =array();
if($count > 0){
    $transactions_arr['data'] = array();

    // fetch transactions
    while($result = $results->fetch(PDO::FETCH_ASSOC)){
        extract($result);

        $transactions_item = array(
            'id'                   => $id,
            'app'                  => $app_name,
            'transaction_id'       => $transaction_id,
            'product'              => $product,
            'transaction_amount'   => $transaction_amount,
            'transaction_currency' => $transaction_currency,
            'transaction_method'   => $transaction_method,
            'transaction_status'   => $transaction_status
        );

        // Push to "data"
        array_push($data, $transactions_item);

    }
}else{
    // No Posts
    $data['message'] = 'No Transactions Found';
}
echo json_encode($data);