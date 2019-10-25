<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$gender = new Customer_Gender();

if($_POST['action'] == 'FETCH_ALL'){

    $customer_genders = $gender->fetch_all();

    $num_cust_genders = $customer_genders->rowCount();

    $data = array();

    if($num_cust_genders > 0){

        while($customer_gender = $customer_genders->fetch(PDO::FETCH_ASSOC)){

            //extract($customer_gender);

            $customer_gender_item = array(
                'id'              => $customer_gender['id']
                // 'gender'          => $customer_gender['gender'],
                // 'created_date'    => $customer_gender['created_date'],
                // 'created_user_id' => $customer_gender['created_user_id'],
                // 'edited_date'     => $customer_gender['edited_date'],
                // 'edited_user_id'  => $customer_gender['edited_user_id'],
            );
    
            // push to array 
            array_push($data, $customer_doc_item);
        }

    }else{
        $data['message'] = 'empty';
    }
    
    echo json_encode($data);
}