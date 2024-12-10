<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Falls mit Composer installiert

if (isset($_POST['sendform']) && ($_POST['security'] == 'secure')) {
    if (!empty($_POST['email'])) {
        if (!empty($_POST['optin'])) {

            $gender = htmlspecialchars($_POST['gender']);
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $messageContent = htmlspecialchars($_POST['message']);

            // E-Mail-Einstellungen
            $adminEmail = 'ahmadi.sakina@gmail.com'; // Zieladresse
            $adminSubject = 'Neue Kontaktformularanfrage';
            $userSubject = 'Ihre Anfrage bei DeinName';
            
            // Instanziierung von PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Servereinstellungen
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // SMTP-Server
                $mail->SMTPAuth = true;
                $mail->Username = 'ahmadi.sakina@gmail.com'; // SMTP-Benutzername
                $mail->Password = 'eajj ohnl lnrb cqws'; // SMTP-Passwort
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Verschlüsselung
                $mail->Port = 587; // SMTP-Port

                // E-Mail an den Admin
                $mail->setFrom($email, $name); // Absender
                $mail->addAddress($adminEmail); // Empfänger
                $mail->isHTML(true);
                $mail->Subject = $adminSubject;
                $mail->Body = "
                    <p>Eine neue Anfrage von <strong>$gender $name</strong> ist eingegangen.</p>
                    <p>E-Mail-Adresse: $email</p>
                    <p><strong>Nachricht:</strong><br>$messageContent</p>
                ";
                $mail->send();

                // Bestätigungsmail an den Benutzer
                $mail->clearAddresses();
                $mail->addAddress($email);
                $mail->Subject = $userSubject;
                $mail->Body = "
                    <p>Vielen Dank, $gender $name, für Ihre Anfrage!</p>
                    <p>Wir werden uns so schnell wie möglich bei Ihnen melden.</p>
                ";
                $mail->send();

                echo '
                    <div class="container">
                        <div class="alert alert-success" role="alert">
                            Anfrage erfolgreich versendet!
                        </div>
                    </div>
                ';

            } catch (Exception $e) {
                echo '
                    <div class="container">
                        <div class="alert alert-danger" role="alert">
                            Fehler beim Senden der Nachricht: ' . $mail->ErrorInfo . '
                        </div>
                    </div>
                ';
            }

        } else {
            echo '
                <div class="container">
                    <div class="alert alert-danger" role="alert">
                        Bitte stimmen Sie der Datenschutzerklärung zu.
                    </div>
                </div>
            ';
        }
    } else {
        echo '
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    Bitte eine gültige E-Mail-Adresse eingeben.
                </div>
            </div>
        ';
    }
}
?>
