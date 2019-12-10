<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

// initiializa data array
$data = array();
/// fetch all organization 
if($_POST['action']== 'FETCH_ALL'){

}
/// fetch organization by user id 
if($_POST['action'] == 'FETCH_BY_USER_ID'){

}
/// fetch organization by id
if($_POST['action'] == 'FETCH_BY_ID'){

}