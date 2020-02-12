<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// bring in intialization file 
require_once('../../models/initialization.php');

$project = new Projects();
$data = array();
$d = new DateTime();
// find project by id

if($_POST['action'] == 'FETCH_PROJECT'){
    $project_id = $_POST['project_id'];
    $current_project = $project->fetch_by_id($project_id);
    if(!$current_project){
        $data['message'] = "errorProject";
        echo json_encode($data);
        die();
    }
    $data['project'] = $current_project;
    echo json_encode($data);
}
