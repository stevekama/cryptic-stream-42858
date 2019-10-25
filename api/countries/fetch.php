<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$countries = new Countries();

if($_POST['action'] == 'FETCH_ALL'){

    $customer_countries = $countries->fetch_all();

    $num_cust_countries = $customer_countries->rowCount();

    $data = array();

    if($num_cust_countries > 0){

        while($customer_country = $customer_countries->fetch(PDO::FETCH_ASSOC)){

            extract($customer_country);

            $customer_country_item = array(
                'id'              => $id,
                'country'         => $country,
                'country_code'    => $country_code
            );
    
            // push to array 
            array_push($data, $customer_country_item);
        }

    }else{
        $data['message'] = 'empty';
    }
    
    echo json_encode($data);
}