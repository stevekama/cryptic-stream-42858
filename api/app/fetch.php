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
            'id'=>$user_app['id'],
            'app_name'=>$user_app['app_name'],
            'app_method'=>$user_app['app_method'],
            'app_key'=>$user_app['app_key'],
            'app_secret'=>$user_app['app_secret'],
            'app_token'=>$user_app['app_token'],
            'response_url'=>$user_app['response_url'],
            'user_id'=>$user_app['user_id']
        );
        // push data 
        array_push($data, $apps_array);
    }
}else{
    $data['message'] = "empty";
}

echo json_encode($data);