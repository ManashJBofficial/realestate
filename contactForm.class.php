<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.PHP';

class contactForm extends Dbh {
    public function contact_form($post_token,$name,$mobile,$email,$subject,$msg){
        $csrf_token = $_SESSION['csrf_token'];
        $post_token = $_POST['csrf_token'];
        if(hash_equals($csrf_token,$post_token))
        {
            if((!empty($_POST['c_name']) && !empty( $_POST['c_mobile']) && !empty($_POST['c_email']) && !empty($_POST['c_subject']) && !empty($_POST['c_msg']) ) )
            {  
                $name =$_POST['c_name'];
                $mobile = $_POST['c_mobile'];
                $email = $_POST['c_email'];
                $subject = $_POST['c_subject'];
                $msg = $_POST['c_msg'];

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
                    $mail->addAddress('emailid');     //Add a recipient
                    $mail->addReplyTo($email,$name);

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = "Message Received from $name, Subject : $subject";
                    $mail->Body    = "<h3>Name : $name</h3><h3>Mobile No : $mobile</h3><h3>Email : $email</h3><h3>Subject : $subject</h3><h3>Message Description : $msg</h3>";
                    $mail->AltBody = "Name : $name\nMobile No : $mobile\nEmail : $email\nSubject : $subject\nMessage Description : $msg";
                    $result=$mail->send();
                    if($result)
                    {
                        echo 'ok';
                    }
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                
            }
            else{
                echo "Something Went Wrong !";
            }
        }
        else
        {
            unset($csrf_token);
            echo "csrf_mismatch";          
        }
    }
}