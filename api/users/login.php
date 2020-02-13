<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../models/initialization.php';

$email = $_POST['email'];
$password = $_POST['password'];

$user = new Users();

$usersD = $user->authenticate_user($email, $password);
if($usersD){
    $session->login($usersD);
    $user_type = $usersD['type_id'];
    $user_session = $session->user_id;
    echo json_encode(array('message'=>'success', 'user_session'=>$user_session, 'type_id'=>$user_type));
}else{
    echo json_encode(array('message'=>'failed'));
}

?>