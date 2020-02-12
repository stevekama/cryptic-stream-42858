<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../models/initialization.php';

$email = $_POST['email'];
$password = $_POST['password'];
$project_id = $_POST['project_id'];
$user = new Users();

$usersD = $user->authenticate_user($email, $password);
if($usersD){
    $session->login($usersD);
    $project = new Projects();
    $current_project = $project->fetch_by_id($project_id);
    if(!$current_project){
        $data['message'] = "errorProject";
        echo json_encode($data);
        die();
    }
    echo json_encode(array('message'=>'success', 'url'=>$current_project['url'], 'user_session'=>$session->user_id));
}else{
    echo json_encode(array('message'=>'failed'));
}

?>