<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize
include_once '../../models/initialization.php';

$type_id = '2';

$connection = $database->connect();

// find total number of merchants registered with us
// call users class
$usr = new Users();

/// call the metod to find all merchants 
$merchants = $usr->find_user_by_type_id($type_id);

/// num of merchants 
$count_merchants = $merchants->rowCount();

// run the fetch query

$query = "";
$output = array();
$query .= "SELECT * FROM api.users WHERE type_id = '{$type_id}' ";
if(isset($_POST["search"]["value"])){
   $query .= "AND (";
   $query .= "fullnames LIKE '%".$_POST["search"]["value"]."%' ";
   $query .= "OR phone LIKE '%".$_POST["search"]["value"]."%' ";
   $query .= "OR email LIKE '%".$_POST["search"]["value"]."%'";
   $query.=") ";
}

if(isset($_POST["order"])){
   $query .= "ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
}else{
   $query .= "ORDER BY id DESC ";
}

if($_POST["length"] != -1){
   $query .= "LIMIT " . intval($_POST['length']) . " OFFSET " . intval($_POST['start']);
}

// prepare and execute statement
$statement = $connection->prepare($query);
$statement->execute();

// fetch num row
$filtered_rows = $statement->rowCount();

$data = array();
// loop through the array 
while($row = $statement->fetch(PDO::FETCH_ASSOC)){
   $profile = '';
   if($row["profile"] != ''){
      $profile = '<img src="'.base_url().'/public/dist/img/'.$row['profile'].'" class="profile-user-img img-responsive img-circle" width="35" height="35" />';
   }else{
      $profile = '';
   }
   $sub_array = array();
   $sub_array[] = $profile;
   $sub_array[] = $row["fullnames"];
   $sub_array[] = $row["phone"];
   $sub_array[] = $row["email"];
   $sub_array[] = '<button type="button" id="'.$row["id"].'" class="btn btn-info btn-xs pay">Pay</button>';
   $data[] = $sub_array;
}

$output = array(
   "draw"    => intval($_POST["draw"]),
   "recordsTotal"  =>  $filtered_rows,
   "recordsFiltered" => $count_merchants,
   "data"    => $data
);

echo json_encode($output);