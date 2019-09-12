<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

// instatiate apps 
$app = new Apps();

$user_id = $_POST['user_id'];
// read user apps 

$user_apps = $app->find_by_user_id($user_id);

// count results 
$count = $user_apps->rowCount();

// check if the user has apps
$data = array();
if($count > 0){
    $data['data'] = array();
    // fetch data
    while($user_app = $user_apps->fetch(PDO::FETCH_ASSOC)){

        $apps_array = array(
            'id'=>$id,
            'app_name'=>$app_name,
            'app_method'=>$app_method,
            'app_key'=>$app_key,
            'app_secret'=>$app_secret,
            'app_token'=>$app_token,
            'response_url'=>$response_url,
            'user_id'=>$user_id
        );
        // push data 
        array_push($data, $apps_array);
    }
}else{
    $data['message'] = "empty";
}

echo json_encode($data);