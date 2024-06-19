<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/../vendor/PHPMailer/src/Exception.php';
require '/../vendor/PHPMailer/src/PHPMailer.php';
require '/../vendor/PHPMailer/src/SMTP.php';

require '/../config.php';

class Mailer {
    private $CI;

    function __construct()
	{
		$this->CI =& get_instance(); // This allows you to call models or other CI objects with $this->CI->... 
	}

    function send()
	{
		$mail = new PHPMailer(true);

        try {
            $recipientName = $_POST["name"];
            $recipientEmail = $_POST["email"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];
            $txt = "You have received a message from <b>".$recipientName."</b><br/><br/>".$message."<br/><br/>"."<br/><br/><b>Client-Email:</b>".$recipientEmail.
            

            //Server settings
            $mail->SMTPDebug = 2; 
            $mail->isSMTP();                                            
            
            $mail->Host       = getenv('EMAIL_HOST');                    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = getenv('EMAIL_USERNAME');
            $mail->Password   = getenv('EMAIL_PASSWORD');                                                         
            $mail->SMTPSecure = 'tls'; 
            $mail->Port = 587;
        
            //Recipients
            $mail->setFrom('flourishinternationalmgt@gmail.com', 'FIMSLTD');
            $mail->addAddress('flourishinternationalmgt@gmail.com', 'FIMSLTD'); 
            $mail->addReplyTo($recipientEmail, $subject);
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = $subject;
            $mail->Body    = $txt;
        
            $mail->send();
        
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
	}

}

?>