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
$user = new Users();

$user_email = $_POST['eamail'];

$current_user = $user->find_user_by_email($user_email);

echo json_encode($current_user);
/// send code on the email 


/// enter the code 


/// change pass