<?php
// Header einbinden
include 'header.php'; 
?>
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

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kontakt</title>
<link href="kontakt.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<style>
    #map {
        height: 400px;
        width: 90%;
    }
</style>
</head>
<body>

    <div class="header-bild">
        <img src="kontakt.jpg" alt="haup-container">
    </div>

    <div class="gelb">
        <h1>Kontakt</h1>
    </div>
<?php
$locations = [
    ["lat" => 52.356093, "lng" => 9.767851, "title" => "Standort Hannover", "address" => "Bismarckstraße 2, 30173 Hannover", "email" => "Hannover@semikolon.de"],
    ["lat" => 52.371875, "lng" => 9.979254, "title" => "Standort Lehrte", "address" => "Mühlengasse 1, 31275 Lehrte", "email" => "Lehrte@semikolon.de"],
    ["lat" => 52.436680, "lng" => 9.731579, "title" => "Standort Langenhagen", "address" => "Eickenhof 15, 30851 Langenhagen", "email" => "Langenhagen@semikolon.de"]
];
?>

<div class="form">
    <div class="separator"></div>
    <h1>Kontaktformular</h1>

    <form action="send_mail.php" method="post">
        <input name="security" type="hidden" value="secure">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="SelectGender">Anrede</label>
                <select name="gender" class="form-control" id="SelectGender">
                    <option value="Herr">Herr</option>
                    <option value="Frau">Frau</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="InputName">Name</label>
                <input name="name" type="text" class="form-control" id="InputName">
            </div>
            <div class="form-group col-md-6">
                <label for="InputEmail">E-Mail-Adresse <span class="red">*</span></label>
                <input name="email" type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" required>
            </div>
        </div>
        <div class="form-group">
            <label for="TextareaMessage">Nachricht <span class="red">*</span></label>
            <textarea name="message" class="form-control" id="TextareaMessage" rows="3" required></textarea>
        </div>
        <div class="form-check">
            <input type="checkbox" id="opt-in" name="optin" value="1" class="form-check" required>
            <label for="opt-in">
                <strong>HINWEIS</strong> <span class="red">*</span><br>Ich habe die Hinweise in der <a href="#">Datenschutzerklärung</a> verstanden und stimme diesen hiermit zu.
            </label>
        </div>
        <button type="submit" name="sendform" class="btn btn-dark">Absenden</button>
    </form>
    <div class="separator"></div>
</div>

<div class="separator"></div>

<div class="container">
    <div class="row">
        <!-- Text-Abschnitt -->
        <div class="col-md-4">
            <h2>Unsere Standorte</h2>
            <?php foreach ($locations as $location): ?>
                <h3><?= htmlspecialchars($location['title']) ?></h3>
                <p>Adresse: <?= htmlspecialchars($location['address']) ?></p>
                <p>E-Mail: <a href="mailto:<?= htmlspecialchars($location['email']) ?>"><?= htmlspecialchars($location['email']) ?></a></p>
                <p>Telefon: +49 511 123456</p>
            <?php endforeach; ?>
        </div>

        <!-- Kartenabschnitt -->
        <div class="col-md-8">
            <div id="map"></div>
        </div>
    </div>
</div>

<script>
    // Karte initialisieren
    const map = L.map('map').setView([52.3759, 9.7320], 11);

    // Tile-Layer von OpenStreetMap hinzufügen
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // PHP-Standorte als JavaScript-Objekt
    const locations = <?php echo json_encode($locations); ?>;

    // Marker für jeden Standort hinzufügen
    locations.forEach((location) => {
        L.marker([location.lat, location.lng]).addTo(map)
        .bindPopup(`
            <h3>${location.title}</h3>
            <p>Adresse: ${location.address || "N/A"}</p>
            <p><a href="mailto:${location.email}">${location.email || "N/A"}</a></p>`);
    });
</script>
<?php
// Footer einbinden
include 'footer.php';
?>
</body>
</html>
