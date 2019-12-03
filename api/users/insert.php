<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
        // user wallet 
        // initialize customer wallet.
        $wallet = new Customer_Wallet();
        $wallet->user_id = $user->id;
        $wallet->customer_id = $user->customer_id;
        // check if the customer as a wallet 
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
            // initial customer balance movement account 
            $balance_movement = new Customer_Wallet_Balance_Movement();
            $balance_movement->user_id = $user->id;
            $balance_movement->customer_id = $user->customer_id;
            $balance_movement->initial_balance = $wallet->amount;
            $balance_movement->updated_amount = $wallet->amount;
            $balance_movement->current_balance = $wallet->amount;
            $balance_movement->created_date = $d->format('Y-m-d');
            $balance_movement->created_user_id = $user->id;
            $balance_movement->edited_date = $d->format('Y-m-d');
            $balance_movement->edited_user_id = $user->id;
            if($balance_movement->create()){
                // Instantiation and passing `true` enables exception
                $mail = new PHPMailer(true);
                // send email after signing up 
                $sendMail = new SendMail($mail);
                // define the mail values 
                $sendMail->from = 'stevekamahertz@gmail.com';
                $sendMail->from_username = 'Steve Kama';
                $sendMail->to = $user->email;
                $sendMail->to_username = $user->username;
                $sendMail->subject = 'Welcome To Iko Pay';
                $sendMail->message = '<p>Thank you for creating an account with us. </p>';
                $sendMail->message .= '<p>Your wallet has been successfully created and assigned to the number '.$user->phone.'</p>';
                $sendMail->message .= '<p>You can now login into your account and continue...</p>';
                if($sendMail->send_mail()){
                    $data['message'] = 'success';
                    echo json_encode($data);
                    die();
                }
                $data['message'] = 'failed';
                $data['error'] = $sendMail->send_mail();
               
            }
        }else{
            $data['message'] = 'failed';
        }

     }

}else{
    $data['message'] = 'errorPass';
}
echo json_encode($data);