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

// find user by email 
// initialize user 
$data = array();
$user = new Users();

$user_email = $_POST['email'];

$current_user = $user->find_user_by_email($user_email);

if(!$current_user){
    $data['message'] = 'emailDoesnotExist';
    echo json_encode($data);
    die();
}
/// send code on the email
///generate random code 
$bytes = 6;
$results = bin2hex(random_bytes($bytes));
echo $results;
// enter the code to db 

// Instantiation and passing `true` enables exception
// $mail = new PHPMailer(true);
// // send email after signing up 
// $sendMail = new SendMail($mail);
// // define the mail values 
// $sendMail->from = 'stevekamahertz@gmail.com';
// $sendMail->from_username = 'Steve Kama';
// $sendMail->to = $current_user['email'];
// $sendMail->to_username = $current_user['username'];
// $sendMail->subject = 'Welcome To Iko Pay';
// $sendMail->message = '<p>Your request to change password has been received. </p>';
// $sendMail->message .= '<p>Please use the following code to continue 12345</p>';
// if($sendMail->send_mail()){
//     $data['message'] = 'success';
//     echo json_encode($data);
//     die();
// }
// $data['message'] = 'failed';
// $data['error'] = $sendMail->send_mail();
// echo json_encode($data);





/// change pass