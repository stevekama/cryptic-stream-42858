<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$types = new Customer_Type();

if($_POST['action'] == 'FETCH_ALL'){

    $customer_types = $types->fetch_all();

    $num_cust_types = $customer_types->rowCount();

    $data = array();

    if($num_cust_types > 0){

        while($customer_type = $customer_types->fetch(PDO::FETCH_ASSOC)){

            extract($customer_type);

            $customer_type_item = array(
                'cust_type'             => $cust_type,
                'created_date'          => $created_date,
                'created_user_id'       => $created_user_id,
                'edited_date'           => $edited_date,
                'edited_user_id'        => $edited_user_id,
            );
    
            // push to array 
            array_push($data, $customer_type_item);
        }

    }else{
        $data['message'] = 'empty';
    }
    
    echo json_encode($data);
}