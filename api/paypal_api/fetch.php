<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

//initiate transactions 
$trns = new PayPalTransactions();

$trns->user_id = $_POST['user_id'];

// filter values 
$paypal_transactions = $trns->find_by_user_id($user_id);

$num_trns = $paypal_transactions->rowCount();

$data = array();
if($num_trns > 0){
    
    while($paypal_transaction = $paypal_transactions->fetch(PDO::FETCH_ASSOC)){
        extract($paypal_transactions);
        $transactions_item = array(
            'app_name'         => $app_name,
            'transaction_id'   => $transaction_id,
            'payment_amount'   => $payment_amount,
            'payment_status'   => $payment_status,
            'invoice_id'       => $invoice_id,
            'transaction_date' => $transaction_date
        );

        // push to array 
        array_push($data, $transactions_item);
    }
}else{
    $data['message'] = 'No transactions found';
}
echo json_encode($data);