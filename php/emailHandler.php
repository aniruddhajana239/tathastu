<?php

$name = isset($_POST['name']) ? $_POST['name'] : false;
$email = isset($_POST['email']) ? $_POST['email'] : false;
$subject = isset($_POST['subject']) ? $_POST['subject'] : false;
$message = isset($_POST['message']) ? $_POST['message'] : false;

$toatl_messege = "Name=".$name."Email=".$email."Subject=".$subject."Message=".$message;

// $to_email = "";
// $to      = '';
// $subjects = 'the subject';
// $messages = 'hello';
// $headers = array(
//     'From' => ' aniruddha.jana@elrising.com',
//     'Reply-To' => ' aniruddha.jana@elrising.com',
//     'X-Mailer' => 'PHP/' . phpversion()
// );
// mail($to, $subjects, $messages, $headers);
// if($email != false)
// {
//     $yourEmail = "indranilshit420@gmail.com";
//     $subject = $subject;
//     $success = sendMail($to_email, $yourEmail, $subject, $toatl_messege);    
// }


function spamcheck($field)
{
    //filter_var() sanitizes the e-mail
    //address using FILTER_SANITIZE_EMAIL
    $field=filter_var($field, FILTER_SANITIZE_EMAIL);

    //filter_var() validates the e-mail
    //address using FILTER_VALIDATE_EMAIL
    if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
        return true;
    }
    else
    {
        return false;
    }
}

// function sendMail($toEmail, $fromEmail, $subject, $message)
// {
//     $validFromEmail = spamcheck($fromEmail);
//     if($validFromEmail)
//     {
//         mail($toEmail, $subject, $message, "From: $fromEmail");
//     }
// }
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    //Server settings
    $mail->SMTPDebug = 1;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'asmtp.mail.hostpoint.ch';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'aniruddha.jana@elrising.com';                     // SMTP username
    $mail->Password   = 'A.jana@1996';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('aniruddha.jana@elrising.com', 'Aniruddha');

    $mail->addAddress('Events@sheranisevents.in', 'Event');     // Add a recipient

    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    // $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject ;
    $mail->Body    = $toatl_messege;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $validFromEmail = spamcheck($email);
    if($validFromEmail)
     {
       $mail->send();
    header('location:../index.html');
    echo 'Message has been sent';
    }else{
        $message = " Please Enter a valid Email";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
   
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";    
}

?>