<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host = '212.227.237.41'; // Cambia esto al servidor SMTP que estés usando
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@jena.radixeducation.org'; // Cambia esto a tu dirección de correo electrónico
    $mail->Password = 'FWVcp3hCY:KG8gp'; // Cambia esto a tu contraseña de correo electrónico
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Remitente y destinatario
    $mail->setFrom('noreply@radixeducation.org', 'Radix Education');
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
