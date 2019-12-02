<?php 

require_once('initialization.php');

class SendMail{
    private $mail;

    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    public function send_mail(){
        
        try{
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $this->mail->isSMTP();                                            // Send using SMTP
            $this->mail->Host       = 'smtp.mailtrap.io';                       // Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = 'f3bfa0269a5ef9';                     // SMTP username
            $this->mail->Password   = '8acbed906d4b44';                               // SMTP password
            $this->mail->SMTPSecure = 'TLS';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $this->mail->Port       = 25;                                    // TCP port to connect to

        }catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }

}