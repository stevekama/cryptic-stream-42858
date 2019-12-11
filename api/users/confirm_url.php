<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$error_url = base_url().'forgot.php';

$success_url = base_url().'new_password.php';

if(isset($_GET['code'])){
    $forgot_code = $_GET['code'];
    echo $forgot_code;
    // $current_user = $user->find_user_by_forgot_code($forgot_code);
    // if(!$current_user){
    //     redirect_to($error_url.'?error=wrongToken');
    //     die();
    // }
    // redirect_to($success_url.'?user_id='.$current_user['id']);
}