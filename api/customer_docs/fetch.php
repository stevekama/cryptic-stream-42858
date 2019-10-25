<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$docs = new Customer_Identity_Doc_Types();

if($_POST['action'] == 'FETCH_ALL'){

    $customer_docs = $docs->fetch_all();

    $num_cust_docs = $customer_docs->rowCount();

    $data = array();

    if($num_cust_docs > 0){

        while($customer_doc = $customer_docs->fetch(PDO::FETCH_ASSOC)){

            extract($customer_doc);

            $customer_doc_item = array(
                'id'                        => $id,
                'identification_doc_type'   => $identification_doc_type,
                'created_date'              => $created_date,
                'created_user_id'           => $created_user_id,
                'edited_date'               => $edited_date,
                'edited_user_id'            => $edited_user_id,
            );
    
            // push to array 
            array_push($data, $customer_doc_item);
        }

    }else{
        $data['message'] = 'empty';
    }
    
    echo json_encode($data);
}