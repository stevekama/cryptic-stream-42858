<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$user = new Users();
$cust = new Customers();
$data = array();
$d = new DateTime();
if($_POST['password'] === $_POST['confirm']){
    // find customer by customer is 
    $customer = $cust->find_by_id($_POST['customer_id']);
    //echo json_encode($customer);
    $user->fullnames   = $customer['first_name'].' '.$customer['other_names'];
    $user->phone       = $customer['phone_number'];
    $user->email       = $customer['email_address'];
    $user->username    = $_POST['username'];
    $user->password    = $_POST['password'];
    $user->customer_id = $customer['id'];
    $user->profile     = 'profile.png'; 
    ///create user 
    if($user->create()){
        // initialize customer wallet.
        $wallet = new Customer_Wallet();
        $wallet->user_id = $user->id;
        $wallet->customer_id = $user->customer_id;
        // check if the customer has a wallet 
        $current_customer_wallet = $wallet->fetch_wallet_for_customer($wallet->customer_id);
        // check if this wallet exists 
        if($current_customer_wallet){
            echo json_encode(array('message'=>'existingCusomerWallet'));
            die();
        }
        // initialize customer
        $customer = new Customers();
        // find customer by id 
        $current_customer = $customer->find_by_id($wallet->customer_id);
        if(!$current_customer){
            echo json_encode(array('message'=>'errorCustomer'));
            die();
        }
        $wallet->amount = 0;
        $wallet->phone_number = $current_customer['phone_number'];
        $wallet->created_date = $d->format('Y-m-d');
        $wallet->created_user_id = $user->id;
        $wallet->edited_date = $d->format('Y-m-d');
        $wallet->edited_user_id = $user->id;
        if($wallet->create()){
            $data['message'] = 'success';
        }else{
            $data['message'] = 'failed';
        }
    }else{
        $data['message'] = 'failed';
    }
}else{
    $data['message'] = 'errorPass';
}
echo json_encode($data);