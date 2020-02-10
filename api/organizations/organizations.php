<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize
include_once '../../models/initialization.php';

$user = new Users();

$data = array();

if($_POST['action'] == 'FETCH_USER_BY_ID'){
    $user_id = $_POST['user_id'];
    // find current user by id
    $current_user = $user->find_user_by_id($user_id);
    if(!$current_user){
        $data['message'] = "errorUser";
        echo json_encode($data);
        die();
    }
    $data['user'] = $current_user;
    echo json_encode($data);
}