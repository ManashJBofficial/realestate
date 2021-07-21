<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.PHP';

    error_reporting(0);
    
class reqReset extends Dbh {
    public function req_reset(){
        if(isset($_POST["email"])){  
            $emailTo=$_POST["email"];
            $code = uniqid(true);
            $rol=1;
        
            $sth = $this->connect()->prepare("SELECT email,`role` FROM google_users Where email=:em && role=:rol ");
            $sth->bindParam(':em',$emailTo);
            $sth->bindValue(':rol',$rol,PDO::PARAM_INT);
            $sth->execute();
        
            $result = $sth->fetch(PDO::FETCH_OBJ);
            $mail_result =$result->email;
            
            if($emailTo == $mail_result){
        
                $stmt =$this->connect()->prepare("INSERT INTO reset_password (code, emailid) VALUES (:code, :emailTo)");
                $stmt->bindParam(':code', $code);
                $stmt->bindParam(':emailTo', $emailTo);
                $stmt->execute();
        
                
            //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
        
            try {
                //Server settings
                
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'emailid';                     //SMTP username
                $mail->Password   = 'password';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
                //Recipients
                $mail->setFrom('emailid', 'Parlay India');
                $mail->addAddress($emailTo);     //Add a recipient
                $mail->addReplyTo('no-reply@gmail.com', 'No Reply');
        
                //Content
                $url="http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/reset-password.php?code=$code";
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Your Password reset link';
                $mail->Body    = "<h1>You requested a password reset</h1>
                                Click <a href='$url'>this link</a> to reset password";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
                $mail->send();
                echo 'Reset Password Link has been sent to your email';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
            else{
                echo "<script>alert('Email does not match with the registered email !')</script>";
                ?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=../forgot-password">
<?php 
        }
    }
    
    }
}
?>