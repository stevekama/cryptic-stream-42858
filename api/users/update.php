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

if(!$current_user){
    echo json_encode(array('message'=>'errorUser'));
    die();
}
$user->id          = $current_user['id'];
$user->fullnames   = $current_user['fullnames'];
$user->phone       = $current_user['phone'];
$user->email       = $current_user['email'];
$user->username    = $_POST['username'];
$user->password    = $current_user['password'];
$user->customer_id = $current_user['customer_id'];
$user->profile     = $current_user['profile'];
//create user 
if($user->update()){
    echo json_encode(array('message'=>'success'));
}else{
    echo json_encode(array('message'=>'failed'));
}
