<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$docs = new Customer_Docs();

if($_POST['action'] == 'FETCH_ALL_FOR_CUSTOMER'){

    $docs->customer_id = $_POST['customer_id'];
    
    $customer_docs = $docs->fetch_by_customer_id();

    $num_cust_docs = $customer_docs->rowCount();

    $data = array();

    if($num_cust_docs > 0){

        while($customer_doc = $customer_docs->fetch(PDO::FETCH_ASSOC)){

            $customer_doc_item = array(
                'identification_doc_type'       => $customer_doc['identification_doc_type'],
                'customer_identity_doc_type_id' => $customer_doc['customer_identity_doc_type_id'],
                'identification_doc'            => $customer_doc['identification_doc']
            );
            // push to array 
            array_push($data, $customer_doc_item);
        }

    }else{
        $data['message'] = 'empty';
    }
    
    echo json_encode($data);
}