<?php

$to = 'oscarcontrerasf91@gmail.com';
$subject = 'Correo de prueba';
$message = 'Este es un correo de prueba.';

// Encabezados del correo
$headers = "From: noreply@radixeducation.org\r\n";
$headers .= "Reply-To: noreply@radixeducation.org\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Enviar el correo
if (mail($to, $subject, $message, $headers)) {
    echo 'Correo enviado exitosamente';
} else {
    echo 'Fallo en el envío del correo';
}

?>
