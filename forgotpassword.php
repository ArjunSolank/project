<?php
include './connection/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if($_POST)
{
    $ue=$_POST['User_email'];
    $q=mysqli_query($con,"select * from user where User_email='$ue'");
    $count=mysqli_num_rows($q);
    if($count==1)
    {
       $notp=rand(123456,789654);
       mysqli_query($con,"update user set User_password='$notp' where User_email='$ue'");
        $msg="Hello, <br/> your password is:".$notp;

        //Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'socvisa07@gmail.com';                     //SMTP username
    $mail->Password   = 'swvflzxitsolxfsw';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients*/
    $mail->setFrom('socvisa07@gmail.com ', 'socvisa.com');
    $mail->addAddress($ue, 'socvisa.com');     //Add a recipient


    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Forgot password';
    $mail->Body    = $msg;
    $mail->AltBody = $msg;

    $mail->send();
    echo "<script>alert('Password sent on your email');</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    }
    else
    {
        echo "<script>alert('Email not found')</script>";
    }
}
?>
<html>
<body>
    <form method="post">
     Email:<input type="email" name="User_email"/> <br>
     <input type="submit"/>
</body>
</html>