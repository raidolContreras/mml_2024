<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->Host = 'smtp.hostinger.com'; // Cambia esto al servidor SMTP que estés usando
    $mail->SMTPAuth = true;
    $mail->Username = 'unimontrer@contreras-flota.click'; // Cambia esto a tu dirección de correo electrónico
    $mail->Password = 'fjz6GG5l7ly{'; // Cambia esto a tu contraseña de correo electrónico
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Configuración del remitente y destinatario
    $mail->setFrom('noreply@jena.radixeducation.org', 'Radix Education');
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
