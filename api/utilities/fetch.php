<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// bring in intialization file 
require_once('../../models/initialization.php');

// Database Connect
$connection = $database->connect();

$utilities = new Utilities();

$all_utilities = $utilities->find_all();

$num_utilities = $all_utilities->rowCount();

// start on the query
$query = '';

// output array
$output = array();

$query .= "SELECT * FROM api.utilities ";

// Bring  in search query
if(isset($_POST["search"]["value"])){
	$query .= "WHERE utility LIKE '%{$_POST["search"]["value"]}%' ";
}

// order query
if(isset($_POST["order"])){
	$query .= "ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
}else{
	$query .= "ORDER BY id DESC ";
}

// Pagging
if($_POST["length"] != -1){
	$query .= 'LIMIT '.intval($_POST["length"]).' OFFSET '.intval($_POST["start"]);
}

$statement = $connection->prepare($query);
$statement->execute();
$filtered_rows = $statement->rowCount();

// data array
$data = array();

while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    $sub_array = array();
    $sub_array[] = $row["utility"];
    $sub_array[] = '<button type="button" name="user" id="'.$row["id"].'" class="btn btn-success btn-xs user">Buy</button>';
    $data[] = $sub_array;
}

// store results in output array
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$num_utilities,
	"data"				=>	$data
);
echo json_encode($output);
