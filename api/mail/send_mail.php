<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

// Instantiation and passing `true` enables exception

$mail = new PHPMailer(true);
// send email after signing up 
$sendMail = new SendMail($mail);
// define the mail values 
$sendMail->from = 'stevekama@mail.com';
$sendMail->from_username = 'Steve Kama';
$sendMail->to = $_POST['email'];
$sendMail->to_username = $_POST['username'];
$sendMail->subject = 'Welcome To Iko Pay';
$sendMail->message = '<p>Thank you for creating an account with us. </p>';
$sendMail->message .= '<p>Your wallet has been successfully created and assigned to the number</p>';
$sendMail->message .= '<p>You can now login into your account and continue...</p>';
if($sendMail->send_mail()){
    $data['message'] = 'success';
}
$data['message'] = 'failed';
$data['error'] = $sendMail->send_mail();