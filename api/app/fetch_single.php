<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

// instatiate apps 
$app = new Apps();

// declare id 
$app->id = $_POST['id'];

// find by id
$current_app = $app->find_by_id();

//create data array 
if(!$current_app){
    $data = array();
    $data['message'] = 'couldnot find the app';
    echo json_encode($data);
    die();
}

echo json_encode($current_app);