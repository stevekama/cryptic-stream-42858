<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$docs = new Customer_Docs();
$data = array();

$docs->customer_id = $_POST['customer_id'];
$docs->customer_identity_doc_type_id = $_POST['customer_identity_doc_type_id'];
$docs->identification_doc = $_POST['identification_doc'];
// fetch doc by identification doc
// $current_doc = $docs->fetch_by_idenfication_doc($docs->identification_doc);
echo $docs->identification_doc;
// if($current_doc){
//     echo json_encode(array('message'=>'errorDocs'));
//     die();
// }else{
//     echo json_encode(array('message'=>'docs'));
//     die();
// }

// $docs->created_user_id = $_POST['user_id'];

// $d = new DateTime();

// $docs->created_date = $d->format('Y-m-d');
// $docs->edited_date = $d->format('Y-m-d');
// $docs->edited_user_id = $_POST['user_id'];

// if($docs->create()){
//     $data['message'] = 'success';
// }else{
//     $data['message'] = 'failed';
// }
// echo json_encode($data);
?>