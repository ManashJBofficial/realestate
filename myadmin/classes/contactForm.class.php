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
                    $mail->Body    = "
                    <!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta name='x-apple-disable-message-reformatting'>
 <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title></title>
  
    <style type='text/css'>
      table, td { color: #000000; } @media only screen and (min-width: 620px) {
  .u-row {
    width: 600px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-100 {
    width: 600px !important;
  }

}

@media (max-width: 620px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: calc(100% - 40px) !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors='true'] {
  color: inherit !important;
  text-decoration: none !important;
}

</style>
  
  

<link href='https://fonts.googleapis.com/css?family=Lato:400,700&display=swap' rel='stylesheet' type='text/css'>

</head>

<body class='clean-body' style='margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #f9f9f9;color: #000000'>
  <table style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #f9f9f9;width:100%' cellpadding='0' cellspacing='0'>
  <tbody>
  <tr style='vertical-align: top'>
    <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
    

<div class='u-row-container' style='padding: 0px;background-color: #f9f9f9'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f9f9f9;'>
    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
      
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='width: 100% !important;'>
<div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'>
  
<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td style='overflow-wrap:break-word;word-break:break-word;padding:15px;font-family:'Lato',sans-serif;' align='left'>
        
  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #f9f9f9;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
    <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

  </div>
</div>
    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: transparent'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;'>
    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
      
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='width: 100% !important;'>
  <div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'>
  
<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td style='overflow-wrap:break-word;word-break:break-word;padding:25px 10px;font-family:'Lato',sans-serif;' align='left'>
        
<table width='100%' cellpadding='0' cellspacing='0' border='0'>
  <tr>
    <td style='padding-right: 0px;padding-left: 0px;' align='center'>
      
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>

  </div>
  </div>
</div>
    </div>
  </div>
</div>


<div class='u-row-container' style='padding: 0px;background-color: transparent'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #161a39;'>
    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='width: 100% !important;'>
  <div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
  
<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td style='overflow-wrap:break-word;word-break:break-word;padding:0px 10px 30px;font-family:'Lato',sans-serif;' align='left'>
        
  <div style='line-height: 140%; text-align: center; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%; text-align: center;'>&nbsp;</p>
<p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-size: 28px; line-height: 39.2px; color: #ffffff; font-family: Lato, sans-serif;'>SENDER DETAILS</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>
    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: transparent'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;'>
    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
      
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='width: 100% !important;'>
  <div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'>
  
<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td style='overflow-wrap:break-word;word-break:break-word;padding:40px 40px 30px;font-family:'Lato',sans-serif;' align='left'>
        
  <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>

<p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; line-height: 25.2px; color: #666666;'>Name:    $name</span></p>
<p style='font-size: 14px; line-height: 140%;'>&nbsp;</p>
<p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; line-height: 25.2px; color: #666666;'>Email:   $email</span></p>
<p style='font-size: 14px; line-height: 140%;'>&nbsp;</p>
<p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; line-height: 25.2px; color: #666666;'>Mobile No:   $mobile</span></p>
<p style='font-size: 14px; line-height: 140%;'>&nbsp;</p>
<p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; line-height: 25.2px; color: #666666;'>Subject:     $subject</span></p>
<p style='font-size: 14px; line-height: 140%;'>&nbsp;</p>
<p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; line-height: 25.2px; color: #666666;'>Message:     $msg</span></p>
<p style='font-size: 14px; line-height: 140%;'>&nbsp;</p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

  </div>
  </div>
</div>
    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: #f9f9f9'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #1c103b;'>
    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
      
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='width: 100% !important;'>
  <div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'>
  
<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Lato',sans-serif;' align='left'>
        
  <div style='color: #ffffff; line-height: 140%; text-align: justify; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ced5d8; font-size: 14px; line-height: 19.6px;'>Maniram Dewan Road, Bamunimaidan</span></p>
<p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ced5d8; font-size: 14px; line-height: 19.6px;'>Guwahati - 781021, Assam, India.</span></p>
<p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ced5d8; font-size: 14px; line-height: 19.6px;'>House No 201, Opp Cpwd Office</span></p>
<p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ced5d8; font-size: 14px; line-height: 19.6px;'>+91 9678085035 / +91 9678085037</span></p>
<p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ced5d8; font-size: 14px; line-height: 19.6px;'>parlayindia1@gmail.com</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td style='overflow-wrap:break-word;word-break:break-word;padding:5px 10px 10px;font-family:'Lato',sans-serif;' align='left'>
        
  <div style='color: #7e8c8d; line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='line-height: 140%; font-size: 14px; text-align: center;'><span style='font-size: 14px; line-height: 19.6px; color: #95a5a6;'><strong><span style='font-size: 14px; line-height: 19.6px;'><span style='font-size: 14px; line-height: 19.6px;'><span style='line-height: 19.6px; font-size: 14px;'>Parlay India&copy;&nbsp; All Rights Reserved</span></span></span></strong></span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

  </div>
  </div>
</div>
    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: transparent'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f9f9f9;'>
    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
      
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='width: 100% !important;'>
  <div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
  
<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td style='overflow-wrap:break-word;word-break:break-word;padding:0px 40px 30px 20px;font-family:'Lato',sans-serif;' align='left'>
        
  <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
    
  </div>

      </td>
    </tr>
  </tbody>
</table>

  </div>
  </div>
</div>
    </div>
  </div>
</div>


    </td>
  </tr>
  </tbody>
  </table>
</body>

</html>

                    ";
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