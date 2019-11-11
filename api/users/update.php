<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$user = new Users();

// find user by id 
$current_user = $user->find_user_by_id($_POST['user_id']);

echo json_encode($current_user);
// $user->fullnames   = $customer['first_name'].' '.$customer['other_names'];
// $user->phone       = $customer['phone_number'];
// $user->email       = $customer['email_address'];
// $user->username    = $_POST['username'];
// $user->password    = $_POST['password'];
// $user->customer_id = $customer['id'];
// $user->profile     = 'profile.png'; 
// ///create user 
// if($user->create()){
//     echo json_encode(array('message'=>'success'));
// }else{
//     echo json_encode(array('message'=>'failed'));
// }
