<?php 
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('initialization.php');

// Instantiation and passing `true` enables exception
$mail = new PHPMailer(true);

class SendMail{
    
    public function mail(){
        global $mail;

        try{
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.mailtrap.io';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'f3bfa0269a5ef9';                     // SMTP username
            $mail->Password   = '8acbed906d4b44';                               // SMTP password
            $mail->SMTPSecure = 'TLS';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 25;                                    // TCP port to connect to

        }catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }

}