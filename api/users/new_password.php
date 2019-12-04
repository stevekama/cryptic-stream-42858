<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize user 
$user = new Users();
$data = array();
/// find user by token 
if($_POST['action'] == 'FETCH_USER_BY_TOKEN'){
    $forgot_code = $_POST['code'];
    $current_user = $user->find_user_by_forgot_code($forgot_code);
    if(!$current_user){
        $data['message'] = 'wrongToken';
        echo json_encode($data);
        die();
    }
    // send json user data 
    echo json_encode($current_user);
}