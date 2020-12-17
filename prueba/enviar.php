<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                               // Enable verbose debug output
    $mail->isSMTP();                                    // Send using SMTP
    $mail->Host = 'smtp.gmail.com';                     // Set the SMTP server to send through
    $mail->SMTPAuth = true;                             // Enable SMTP authentication
    $mail->Username = 'fdelaidaw@gmail.com';            // SMTP username
    $mail->Password = 'fernandoDAW123';                 // SMTP password
    $mail->SMTPSecure = 'tls';                          // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587;                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($_POST['email'], 'Empresa');
    $mail->addAddress($_POST['emailEnvio'], 'Fernando');     // Add a recipient


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $_POST['nombre'];
    $mail->Body = $_POST['error'];
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    header("Location: formulario.php?enviado");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}