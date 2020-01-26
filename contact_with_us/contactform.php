<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "PHPMailer\PHPMailer.php";
require_once "PHPMailer\SMTP.php";
require_once "PHPMailer\Exception.php";

$mail = new PHPMailer();


if (isset($_POST['submit_contact'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sender = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    try {

        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'aaa.alnatour@gmail.com';                     // SMTP username
        $mail->Password   = 'abdo770421';                               // SMTP password
        $mail->SMTPSecure = "ssl";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 465;                   //587                 // TCP port to connect to

        //Recipients
        $mail->setFrom($sender, $lastname);
        $mail->addAddress('abdo.alnatoor@gmail.com', 'alnatoor');     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>This email contains Info about Contact $firstname!</p>
        <table style='width:100%; '>
            <tr>
                <td>
                    <table  width='600' align='center' style='background-color:#c7bfbf; font-size:16px'>
                        <tr>
                            <td>
                                Firstname:
                            </td>
                            <td>$firstname</td>
                        </tr>
                        <tr>
                            <td>
                                Lastname:
                            </td>
                             <td>$lastname</td>
                        </tr>
                        <tr>
                            <td>
                                E-Mail:
                            </td>
                            <td>$sender</td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Subject:</h3>
                            </td>
                            <td>$subject</td>
                        </tr>
                        <tr>
                            <td>
                                Message
                            </td>
                             <td>$message</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        </body>
        </html>
        ";

        $mail->send();
        echo 'Message has been sent';

    } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
}