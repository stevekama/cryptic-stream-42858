<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$customer = new Customers();

$customer->first_name = $_POST['first_name'];
$customer->other_names = $_POST['other_names'];
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
$customer->gender_id = $_POST['gender_id'];
$customer->email_address = $_POST['email_address'];
$customer->dob = $_POST['dob'];
$d = new DateTime();
$customer->date_of_registration = $d->format('Y-m-d H:i:s');
$customer->postal_address = $_POST['postal_address'];
$customer->physical_address = $_POST['physical_address'];
$customer->country_id = $_POST['country_id'];
$customer->phone_number = $_POST['phone_number'];
$customer->alt_phone_number = $_POST['alt_phone_number'];
$customer->created_date = $d->format('Y-m-d H:i:s');
$customer->created_user_id = 0;
$customer->edited_date = $d->format('Y-m-d H:i:s');
$customer->edited_user_id = 0;
$data = array();

if($customer->create()){
    $data['message'] = 'success';
    $data['customer_id'] = $customer->id;
}else{
    $data['message'] = 'failed';
}
echo json_encode($data);
?>