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
$query .= 'SELECT * FROM users WHERE type_id = 2 ';

if(isset($_POST["search"]["value"])){
   $query .= 'AND (fullnames LIKE "%'.$_POST["search"]["value"].'%" ';
   $query .= 'OR phone LIKE "%'.$_POST["search"]["value"].'%"';
   $query .= 'OR email LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"])){
   $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}else{
   $query .= 'ORDER BY id DESC ';
}

if($_POST["length"] != -1){
   $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

foreach($result as $row){
   $profile = '';
   if($row["profile"] != ''){
      $profile = '<img src="'.base_url().'/public/dist/img/'.$row['profile'].'" class="profile-user-img img-responsive img-circle" width="50" height="35" />';
   }else{
      $profile = '';
   }
   $sub_array = array();
   $sub_array[] = $profile;
   $sub_array[] = $row["fullnames"];
   $sub_array[] = $row["phone"];
   $sub_array[] = $row["email"];
   $sub_array[] = '<button type="button" id="'.$row["id"].'" class="btn btn-warning btn-xs pay">Pay</button>';
   $data[] = $sub_array;
}

$output = array(
   "draw"    => intval($_POST["draw"]),
   "recordsTotal"  =>  $filtered_rows,
   "recordsFiltered" => get_total_all_records(),
   "data"    => $data
);

echo json_encode($output);