<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$customer = new Customers();

$customer->app_name = $_POST['name'];
$app->app_method = $_POST['method'];
$app->app_key = $_POST['key'];
$app->app_secret = $_POST['secret'];
$app->response_url = $_POST['url'];
$app->user_id = $session->user_id;

$customer->first_name = $_POST['first_name'];
$customer->other_names = $_POST['other_name'];
$customer->cust_type_id = $_POST['cust_type_id'];
$customer->customer_identity_doc_type_id1 = $_POST['customer_identity_doc_type_id1'];
$customer->identification_doc1 = $_POST['identification_doc1'];
$customer->customer_identity_doc_type_id2 = $_POST['customer_identity_doc_type_id2'];
$customer->identification_doc2 = $_POST['identification_doc2'];
$customer->customer_identity_doc_type_id3 = $_POST['customer_identity_doc_type_id3'];
$customer->identification_doc3 = $_POST['identification_doc3'];
$customer->customer_identity_doc_type_id4 = $_POST['customer_identity_doc_type_id4'];
$customer->identification_doc4 = $_POST['identification_doc4'];
$customer->customer_identity_doc_type_id5 = $_POST['customer_identity_doc_type_id5'];
$customer->identification_doc5 = $_POST['identification_doc5'];
$customer->email_address = $_POST['email_address'];
$customer->dob = $_POST['dob'];
$customer->date_of_registration = $_POST['date_of_registration'];
$customer->postal_address = $_POST['postal_address'];
$customer->pysical_address = $_POST['pysical_address'];
$customer->created_date = $_POST['created_date'];
$customer->created_user_id = $_POST['created_user_id'];
$customer->edited_date = $_POST['edited_date'];
$customer->edited_user_id = $_POST['edited_user_id'];

$data = array();
if($customer->create()){
    $data['message'] = 'success';
}else{
    $data['message'] = 'failed';
}
echo json_encode($data);
?>