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

// initialize user 
$user = new Users();
$data = array();
/// change pass
if($_POST['action'] == 'CHANGE_USER_PASS'){
    if($_POST['new_pass'] !== $_POST['confirm_pass']){
        $data['message'] = 'passDoNotMatch';
        echo json_encode($data);
        die();
    }
    // find user by id 
    $current_user = $user->find_user_by_id($_POST['user_id']);
    if(!$current_user){
        $data['message'] = 'wrongUser';
        echo json_encode($data);
        die();
    }
    $user->id = $current_user['id'];
    $user->password = $_POST['new_pass'];
    if($user->update_new_password()){
        /// destroy token
        $user->fullnames = $current_user['fullnames'];
        $user->phone = $current_user['pone'];
        $user->email = $current_user['email'];
        $user->username = $current_user['username'];
        $user->password = $current_user['password'];
        $user->customer_id = $current_user['customer_id'];
        $user->profile = $current_user['profile'];
        $user->forgot_code = '';
        if($user->update()){
            // send mail
            // Instantiation and passing `true` enables exception
            $mail = new PHPMailer(true);
            // send email after signing up 
            $sendMail = new SendMail($mail);
            // define the mail values 
            $sendMail->from = 'stevekamahertz@gmail.com';
            $sendMail->from_username = 'Steve Kama';
            $sendMail->to = $current_user['email'];
            $sendMail->to_username = $current_user['username'];
            $sendMail->subject = 'Welcome To Iko Pay';
            $sendMail->message = '<p>Your password has been successfully changed. </p>';
            $sendMail->message .= '<p>Thank you for using Iko Pay.</p>';
            if($sendMail->send_mail()){
                redirect_to(base_url().'index.php');
                die();
            }
            redirect_to(base_url().'index.php');
        }
    }else{
        $data['message'] = 'Failed to update password';
        echo json_encode($data);
        die();
    }
}