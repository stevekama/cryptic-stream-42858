<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$user = new Users();

// find user by id 
$current_user = $user->find_user_by_id($session->user_id);

if(!$current_user){
    echo json_encode(array('message'=>'errorUser'));
    die();
}

$user_id          = $current_user['id'];
$password         = $_POST['password'];
$new_password     = $_POST['new_password'];
$confirm_pass     = $_POST['confirm_pass'];
// send password and confirm password 
if($new_password !== $confirm_pass){
    echo json_encode(array('message'=>'passwordDoNotMatch'));
    die();
}
// check the old pass and update
$update_pass = $user->update_password($user_id, $password, $new_password);

if(!$update_pass){
    echo json_encode(array('message'=>'wrongPass'));
    die();
}

echo json_encode(array('message'=>'success'));