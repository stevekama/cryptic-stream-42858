<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$customer = new Customers();
$data = array();

$customer->first_name = $_POST['first_name'];
$customer->other_names = $_POST['other_names'];
$customer->cust_type_id = $_POST['cust_type_id'];
$customer->email_address = $_POST['email_address'];
// check if the email exists
$current_customer_email = $customer->find_by_email($customer->email_address);
if($current_customer_email){
    $data['message'] = 'duplicatedEmail';
    echo json_encode($data);
    die();
}
$customer->dob = $_POST['dob'];
// registratin date
$d = new DateTime();

$customer->date_of_registration = $d->format('Y-m-d H:i:s');

$customer->gender_id = $_POST['gender_id'];
$customer->postal_address = $_POST['postal_address'];
$customer->physical_address = $_POST['physical_address'];
$customer->country_id = $_POST['country_id'];
$customer->phone_number = $_POST['phone_number'];
$customer->alt_phone_number = $_POST['alt_phone_number'];
$customer->created_date = $d->format('Y-m-d H:i:s');
$customer->created_user_id = 0;
$customer->edited_date = $d->format('Y-m-d H:i:s');
$customer->edited_user_id = 0;
if($customer->create()){
    $data['message'] = 'success';
    $data['customer_id'] = $customer->id;
}else{
    $data['message'] = 'failed';
}
echo json_encode($data);
?>