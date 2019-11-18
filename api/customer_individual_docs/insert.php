<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$docs = new Customer_Docs();
$data = array();

$docs->customer_id = $_POST['customer_id'];
$docs->customer_identity_doc_type_id = $_POST['customer_identity_doc_type_id'];
$docs->identification_doc = $_POST['identification_doc'];
$docs->created_user_id = $_POST['user_id'];

$d = new DateTime();

$docs->created_date = $d->format('Y-m-d H:s:i');
$docs->edited_user_id = $_POST['user_id'];

if($docs->create()){
    $data['message'] = 'success';
}else{
    $data['message'] = 'failed';
}
echo json_encode($data);
?>