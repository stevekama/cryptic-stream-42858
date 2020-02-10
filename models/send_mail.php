<?php 

require_once('initialization.php');

class SendMail{
    private $mail;
    
    // bring in the message from and to 
    public $from;
    public $from_username;
    public $to;
    public $to_username;
    public $subject;
    public $message;
    public $attachment;
 
    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    public function send_mail(){

        try{
            // Server settings
            $this->mail->SMTPDebug = 0;                      // Enable verbose debug output
            $this->mail->isSMTP();                                            // Send using SMTP
            $this->mail->Host       = 'smtp.mail.com';                       // Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = 'stevekama@mail.com';                     // SMTP username
            $this->mail->Password   = 'ci/05041/2013';                               // SMTP password
            $this->mail->SMTPSecure = 'TLS';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $this->mail->Port       = 25;            // TCP port to connect to

             //Recipients
            $this->mail->setFrom($this->from, $this->from_username);
            $this->mail->addAddress($this->to, $this->to_username);     // Add a recipient
            $this->mail->addAddress($this->to);                         // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            $this->mail->addCC('stevekamahertz@gmail.com');
            // $mail->addBCC('bcc@example   .com');

            // Attachments
            if(!empty($this->attachment)){
                 $this->mail->addAttachment($this->attachment);         // Add attachments
            }
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $this->subject;
            $this->mail->Body    = $this->message;
            $this->mail->AltBody = '<hr>';

            if($this->mail->send()){
                return true;
            }
        }catch (Exception $e) {
            return $this->mail->ErrorInfo;
        }
    }

}