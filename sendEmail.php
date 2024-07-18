<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->SMTPDebug = 2; // Habilita el debug del SMTP (usar 3 para más detalle)
    $mail->isSMTP(); // Asegúrate de que se usa el SMTP
    $mail->Host = 'smtp-relay.gmail.com'; // Cambia esto al servidor SMTP que estés usando
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@radixeducation.org'; // Cambia esto a tu dirección de correo electrónico
    $mail->Password = 'L8HWQnHeRq9jT%'; // Usa aquí la contraseña de aplicación generada
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Configuración del remitente y destinatario
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
