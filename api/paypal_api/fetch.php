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

$trns->user_id = $session->user_id;

// filter values 
$count_trns = $trns->find_by_user_id($user_id);
$totalFilter = $count_trns->rowCount();

// create connection 
$connection = $database->connect();

// Search 
$sql = "SELECT * FROM paypal_transactions INNER JOIN apps ON paypal_transactions.app_token = apps.app_token WHERE paypal_transactions.user_id = '{$user_id}' ";
if($_POST['search']['value']){
    $sql .= "AND (";
    $sql .= "paypal_transactions.app_name LIKE '%{$_POST['search']['value']}%' ";
    $sql .= "OR paypal_transactions.transaction_id LIKE '%{$_POST['search']['value']}%' ";
    $sql .= "OR paypal_transactions.payments_amount LIKE '%{$_POST['search']['value']}%' ";
    $sql .= "OR paypal_transactions.payment_status LIKE '%{$_POST['search']['value']}%' ";
    $sql .= "OR paypal_transactions.transaction_date LIKE '%{$_POST['search']['value']}%'";
    $sql .= ")";
}

// order
if(isset($_POST['order'])){
    $sql .= " ORDER BY '{$columns[$_POST['order']['0']['column']]}' '{$_POST['order']['0']['dir']}' ";
}else{
    $sql .= " ORDER BY paypal_transactions.id DESC ";
}

// limit 
// if($_POST['length'] != -1){
//     $sql .= "LIMIT {$_POST['start']}, {$_POST['length']} ";
// }

$stmt = $connection->prepare($sql);
$results = $stmt->execute();

$data = array();
while($row = $results->fetch(PDO::FETCH_ASSOC)){
    $sub_array = array();
    $sub_array[] = $row["app_name"];
    $sub_array[] = $row["transaction_id"];
    $sub_array[] = $row["payments_amount"];
    $sub_array[] = $row["payments_status"];
    $sub_array[] = $row["transaction_date"];
    $data[] = $sub_array;
}
$output = array(
    "draw"            => intval($_POST["draw"]),
    "recordsTotal"    => intval(count($count_trns)),
    "recordsFiltered" => intval($totalFilter),
    "data" => $data
);
echo json_encode($output);