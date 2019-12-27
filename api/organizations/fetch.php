<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize
include_once '../../models/initialization.php';

$conn = $database->connect();

$query = '';
$output = array();
$query .= 'SELECT * FROM api.users WHERE type_id = 2 ';