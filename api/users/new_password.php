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
/// change pass
if($_POST['action'] == 'CHANGE_USER_PASSS'){
    if($_POST['new_pass'] !== $_POST['confirm_pass']){
        $data['message'] = 'passDoNotMatch';
        echo json_encode($data);
        die();
    }
    // find user by id 
    $current_user = $user->find_user_by_id($_POST['user_id']);
    if(!$current_user){
        $data['message'] = 'wrongUser';
        echo json_encode($data);
        die();
    }
    $user->id = $current_user['id'];
    $user->password = $_POST['new_pass'];
    if($user->update_new_password){
        /// destroy token
        $user->fullnames = $current_user['fullnames'];
        $user->phone = $current_user['pone'];
        $user->email = $current_user['email'];
        $user->username = $current_user['username'];
        $user->password = $current_user['password'];
        $user->customer_id = $current_user['customer_id'];
        $user->profile = $current_user['profile'];
        $user->forgot_code = '';
        if($user->update()){
            $data['message'] = 'success';
            echo json_encode($data);
            die();
        }


    }
}