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

// look if file has been uploaded 
if(isset($_FILES["profile"]["type"])){
    $user->attach_file($_FILES['profile']);
    if($user->save_photo()){
        echo json_encode(array('message'=>'success'));
    }
}