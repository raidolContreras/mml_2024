<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // Servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'user@example.com'; // Usuario SMTP
    $mail->Password = 'password'; // Contraseña SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom('no-reply@radixeducation.org', 'Radix Education');
    $mail->addAddress('oscarcontrerasf91@gmail.com');

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Correo de prueba';
    $mail->Body    = 'Este es un correo de prueba.';

    $mail->send();
    echo 'Correo enviado exitosamente';
} catch (Exception $e) {
    echo "Fallo en el envío del correo. Error: {$mail->ErrorInfo}";
}
