<?php
// Headers
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once '../../models/initialization.php';

// Instantiation and passing `true` enables exception
$mail = new PHPMailer(true);

$sendMail = new SendMail($mail);

// define the mail values 
$sendMail->from = 'stevekamahertz@gmail.com';
$sendMail->from_username = 'Steve Kama';
$sendMail->to = 'bizstevekama@gmail.com';
$sendMail->to_username = 'Biz steve';
$sendMail->subject = 'Hello World';
$sendMail->message = 'This is a test mail of hello world';

if($sendMail->send_mail()){
    echo "Message Sent";
    die();
}

echo $sendMail->send_mail();