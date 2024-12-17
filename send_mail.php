<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ahmadi.sakina@gmail.com';
        $mail->Password = 'eajj ohnl lnrb cqws'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Absender und Empfänger konfigurieren
        $mail->setFrom($email, $name);
        $mail->addAddress('ahmadi.sakina@gmail.com'); // Admin-E-Mail-Adresse
        $mail->Subject = 'Neue Nachricht vom Kontaktformular';
        $mail->Body = $message;

        $mail->send();
        echo "Nachricht wurde erfolgreich gesendet.";
    } catch (Exception $e) {
        echo "Nachricht konnte nicht gesendet werden. Fehler: {$mail->ErrorInfo}";
    }
} else {
    echo "Ungültige Anfrage.";
}
