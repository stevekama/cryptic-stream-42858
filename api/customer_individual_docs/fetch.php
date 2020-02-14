<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$docs = new Customer_Docs();

$customer_doc = new Customer_Identity_Doc_Types();

if($_POST['action'] == 'FETCH_ALL_FOR_CUSTOMER'){

    $docs->customer_id = $_POST['customer_id'];
    
    $customer_docs = $docs->fetch_by_customer_id();

    $num_cust_docs = $customer_docs->rowCount();

    $data = array();

    if($num_cust_docs > 0){

        while($customer_doc = $customer_docs->fetch(PDO::FETCH_ASSOC)){

            extract($customer_doc);
            $current_customer_doc = $customer_doc->find_by_id($customer_identity_doc_type_id);
            $customer_doc_item = array(
                'id'                            => $id,
                'customer_id'                   => $customer_id,
                'customer_identity_doc_type_id' => $$current_customer_doc['identification_doc_type'],
                'identification_doc'            => $identification_doc,
                'created_date'                  => $created_date,
                'created_user_id'               => $created_user_id,
                'edited_date'                   => $edited_date,
                'edited_user_id'                => $edited_user_id,
            );
    
            // push to array 
            array_push($data, $customer_doc_item);
        }

    }else{
        $data['message'] = 'empty';
    }
    
    echo json_encode($data);
}